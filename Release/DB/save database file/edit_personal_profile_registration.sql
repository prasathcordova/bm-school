SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- =============================================
-- Author		:	RAHUL
-- Create date	:   31-Oct-2017
-- Description	:	To edit new students from phase 1 registration
-- =============================================
ALTER PROCEDURE [docme_registration].[edit_personal_profile_registration]
	@apikey VARCHAR(250),
	@student_data_xml XML,
	@student_image VARCHAR(MAX),
	@language_data_xml XML,
	@student_id INT
AS
BEGIN
	SET NOCOUNT ON;
	DECLARE @USERID VARCHAR(250),@flag INT, @Inst_id INT;
	DECLARE @precheck int;	
	SET	@precheck = 0;
	SELECT @precheck = COUNT(id) FROM Auth.rest_keys WHERE Auth.rest_keys.api_key = @apikey AND Auth.rest_keys.isactive = 1 and Auth.rest_keys.api_key != '525-777-777';
	IF @precheck = 0
    BEGIN
		SELECT 0 AS id, 1 AS ErrorStatus, 'Invalid / Expired API KEY' AS ErrorMessage
		RETURN
    END
	DECLARE @IMG_FLAG INT =0, @ADMN_NO VARCHAR(50)
	SELECT @USERID = USERID FROM Auth.rest_keys WHERE Auth.rest_keys.api_key = @apikey AND Auth.rest_keys.isactive = 1;
	SELECT TOP 1 @Inst_id = inst_id from auth.tbl_login where [USER_ID] = @USERID
	SELECT @ADMN_NO = ADMN_NO FROM DBO.Student_Master WHERE student_id = @student_id AND Inst_ID = @Inst_id
	
	BEGIN TRANSACTION;
		SAVE TRANSACTION MySavePointRegistration;
		BEGIN TRY
			DECLARE @firstname VARCHAR(MAX),
				@middlename VARCHAR(MAX)
				,@lastname VARCHAR(MAX)
				,@gender VARCHAR(10)
				,@country_selected INT
				,@nationality VARCHAR(MAX)
				,@state_selected INT
				,@district_selected INT
				,@dob VARCHAR(MAX)
				,@age INT
				,@religion_select INT
				,@caste_select INT
				,@community_select INT
				,@mother_tongue INT
				,@unique_identity VARCHAR(MAX)				
				,@student_id_new INT
                ,@blood_group VARCHAR(10);;
			SET @flag= 0;

			DECLARE Registration_Cursor CURSOR LOCAL FOR 
			SELECT  XCol.value('(firstname)[1]','varchar(200)') as firstname,
			  XCol.value('(middlename)[1]','varchar(200)') as middlename,
			  XCol.value('(lastname)[1]','varchar(200)') as lastname,
			  XCol.value('(gender)[1]','varchar') as gender,
			  XCol.value('(country_selected)[1]','int') as country_selected,
			  XCol.value('(nationality)[1]','varchar(200)') as nationality,
			  XCol.value('(state_selected)[1]','int') as state_selected,
			  XCol.value('(district_selected)[1]','int') as district_selected,
			  XCol.value('(dob)[1]','date') as dob,
			  XCol.value('(age)[1]','int') as age,
			  XCol.value('(religion_select)[1]','int') as religion_select,
			  XCol.value('(caste_select)[1]','int') as caste_select,
			   XCol.value('(community_select)[1]','int') as community_select,
			  XCol.value('(mother_tongue)[1]','int') as mother_tongue,
			  XCol.value('(unique_identity)[1]','varchar(50)') as unique_identity,
              XCol.value('(blood_group)[1]','varchar(10)') as blood_group
			FROM @student_data_xml.nodes('/table/row') AS XTbl(XCol)
			OPEN Registration_Cursor 
			FETCH NEXT FROM Registration_Cursor INTO @firstname
				,@middlename
				,@lastname
				,@gender
				,@country_selected
				,@nationality
				,@state_selected
				,@district_selected				
				,@dob
				,@age
				,@religion_select
				,@caste_select
				,@community_select
				,@mother_tongue
				,@unique_identity
                ,@blood_group
			WHILE @@FETCH_STATUS = 0
			BEGIN	
				SET @flag= 1;
				BEGIN


				UPDATE dbo.student_master
				SET
				[FIRST_NAME]= @firstname,
				[MIDDLE_NAME]=@middlename,
				[Last_Name] = @lastname,
				[DOB]=@dob,
				[Age]=@age,
				[SEX]=@gender,
				[Nationality]=@country_selected,
				[state]=@state_selected,
				[district]=@district_selected,
				[Religion]=@religion_select,
				[Caste]=@caste_select,
				[Community]=@community_select,
				[MotherTongue]=@mother_tongue,
				[Adhar_No] = @unique_identity,
				[modifiedby]=@USERID,
				[modifiedon]=SYSDATETIME(),
                [BloodGroup]=@blood_group
				WHERE [student_id]=@student_id AND [Inst_ID]=@Inst_id
	
					IF LEN(@student_image) > 1
					BEGIN
						SELECT @IMG_FLAG =1 FROM DBO.STUD_REG_IMAGES  WHERE student_id = @student_id AND ISACTIVE =1 AND inst_ID = @Inst_id
						IF @IMG_FLAG = 1
						BEGIN
							UPDATE DBO.STUD_REG_IMAGES 
							SET [image_data]=@student_image,
								[Modi_By]=@USERID,
								[Modi_Date]=SYSDATETIME()
							WHERE [student_id]=@student_id AND [inst_ID]=@Inst_id
						END
						ELSE 
						BEGIN
							INSERT INTO DBO.STUD_REG_IMAGES (
								inst_ID,
								Admn_No,
								student_id,
								image_data,
								Entry_by,
								Entry_Date,
								ISACTIVE
							) VALUES (
								@Inst_id
								, @ADMN_NO
								, @student_id
								, @student_image
								, @USERID
								, SYSDATETIME()
								, 1
							)
						END
					END



					UPDATE [settings].[Birth_Place_Details]
					SET [Country_ID]=@country_selected,
						[State_ID]=@state_selected,
						[modifiedby]=@USERID,
						[modifiedon]=SYSDATETIME()
					WHERE [Student_Id]=@student_id AND [Inst_ID]=@Inst_id
						

				END
			FETCH NEXT FROM Registration_Cursor  INTO @firstname
				,@middlename
				,@lastname
				,@gender
				,@country_selected
				,@nationality
				,@state_selected
				,@district_selected				
				,@dob
				,@age
				,@religion_select
				,@caste_select
				,@community_select
				,@mother_tongue
				,@unique_identity
                ,@blood_group
			END
			CLOSE Registration_Cursor ;
			DEALLOCATE Registration_Cursor ;		


			DECLARE @language_select INT		

			DELETE FROM dbo.tbl_student_known_languages
				WHERE student_id = @student_id AND inst_id = @Inst_id

			DECLARE Language_Cursor CURSOR LOCAL FOR 
			SELECT  XCol.value('(language_select)[1]','int') as language_select
			FROM @language_data_xml.nodes('/table/row') AS XTbl(XCol)
			OPEN Language_Cursor 
			FETCH NEXT FROM Language_Cursor INTO @language_select
			WHILE @@FETCH_STATUS = 0
			BEGIN			

				INSERT INTO dbo.tbl_student_known_languages(
							inst_id
							,student_id
							,language_id
							,created_by
							,created_on
						
						) VALUES (	
							@Inst_id
							,@student_id
							,@language_select
							,@USERID
							,SYSDATETIME()
						)		

			FETCH NEXT FROM Language_Cursor INTO @language_select
			END
			CLOSE Language_Cursor ;
			DEALLOCATE Language_Cursor ;

			SET @precheck =0;
			select @precheck= count(studentid) from [docme_registration].[registration_status]  where studentid=@student_id
			IF @precheck=0
			BEGIN
			DECLARE @PERCENT_SHARE INT ;
					SELECT @PERCENT_SHARE = PERCENT_SHARE FROM [docme_registration].[reg_percent_share] WHERE keyword = 'Personal_profile'
					INSERT INTO [docme_registration].[registration_status] (
						inst_id
						,studentid						
						,reg_percent
						,personal_details
						,createdby
						,createdon
					) VALUES (
						@Inst_id
						,@student_id						
						,@PERCENT_SHARE
						,1
						,@USERID
						,SYSDATETIME()
					)
			END 




		END TRY		
		BEGIN CATCH
			IF @@TRANCOUNT > 0
			BEGIN			
			SELECT 0 AS status, 1 AS error_status,'Rollbacked data updation' as error_messages,ERROR_MESSAGE() AS MSG
				ROLLBACK TRANSACTION MySavePointRegistration; -- rollback to MySavePointRegistration
				
					
			END
		END CATCH
	COMMIT TRANSACTION 
	IF @flag > 0 
		SELECT 1 AS status, 0 AS error_status, 'STUDENT UPDATED SUCCESSFULLY' AS error_messages,'' AS MSG, @student_id AS student_id
	
END
GO
