SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- =============================================
-- Author		:	AJU S ARAVIND
-- Create date	:   02-Oct-2017
-- Description	:	To create new students from phase 1 registration
-- =============================================
ALTER PROCEDURE [docme_registration].[save_personal_profile_registration]
	@apikey VARCHAR(250),
	@student_data_xml XML,
	@student_image VARCHAR(MAX),
	@language_data_xml XML,
	@temp_stud_id int
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
	SELECT @USERID = USERID FROM Auth.rest_keys WHERE Auth.rest_keys.api_key = @apikey AND Auth.rest_keys.isactive = 1;
	--SELECT @Inst_id = Code_Value FROM SYSTEM_PARAMETERS WHERE Code='INSTID'		
	SELECT TOP 1 @Inst_id = inst_id from auth.tbl_login where [USER_ID] = @userid
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
                ,@blood_group VARCHAR(10);
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
				SELECT @flag = 1 FROM dbo.student_master WHERE Adhar_No = @unique_identity OR GrNo = @unique_identity
				IF @flag = 0 
				BEGIN
					INSERT INTO dbo.student_master (
						Inst_ID
						,FIRST_NAME
						,MIDDLE_NAME
						,LAST_NAME
						,DOB
						,SEX
						,AGE
						,NATIONALITY
						,state
						,district
						,RELIGION
						,CASTE
						,Community
						,MOTHERTONGUE
						,ISAADHARNO
						,ADHAR_NO
						,CREATEDBY
						,CREATEDON
                        ,BloodGroup
					) VALUES (	
						@Inst_id
						,@firstname
						,@middlename
						,@lastname
						,@dob
						,@gender
						,@age
						,@country_selected
						,@state_selected
						,@district_selected	
						,@religion_select
						,@caste_select
						,@community_select
						,@mother_tongue
						,1
						,@unique_identity
						,@USERID
						,SYSDATETIME()
                        ,@blood_group
					)
					SET @student_id_new = @@IDENTITY
					IF LEN(@student_image) > 1
					BEGIN
						INSERT INTO DBO.STUD_REG_IMAGES (
							inst_ID
							,student_id
							,image_data
							,Entry_by
							,Entry_Date
						) VALUES (
							@Inst_id
							,@student_id_new
							,@student_image
							,@USERID
							,SYSDATETIME()
						)
					END
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
						,@student_id_new						
						,@PERCENT_SHARE
						,1
						,@USERID
						,SYSDATETIME()
					)

					INSERT INTO [settings].[Birth_Place_Details] (
						Inst_ID
						,Student_id
						,Country_ID
						,State_ID						
						,Entry_By
						,Entry_Date
					) VALUES (
						@Inst_id
						,@student_id_new
						,@country_selected
						,@state_selected
						,@USERID
						,SYSDATETIME()
					)

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
				WHERE student_id = @student_id_new AND inst_id = @Inst_id

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
							,@student_id_new
							,@language_select
							,@USERID
							,SYSDATETIME()
						)			

				
			FETCH NEXT FROM Language_Cursor INTO @language_select
			END
			CLOSE Language_Cursor ;
			DEALLOCATE Language_Cursor ;

			IF @temp_stud_id <> -1
			BEGIN
				UPDATE dbo.STUDENT_TEMP_REGISTRATION SET ispermanent=1, isactive=0 where TempReg_ID=@temp_stud_id
			END

		END TRY		
		BEGIN CATCH
			IF @@TRANCOUNT > 0
			BEGIN			
				ROLLBACK TRANSACTION MySavePointRegistration; -- rollback to MySavePointRegistration
				SELECT 0 AS status, 1 AS error_status,'Rollbacked data updation' as error_messages,ERROR_MESSAGE() AS MSG
					
			END
		END CATCH
	COMMIT TRANSACTION 
	IF @student_id_new > 0 
		SELECT 1 AS status, 0 AS error_status, 'STUDENT SUCCESSFULLY SAVED' AS error_messages,'' AS MSG, @student_id_new AS student_id
	IF @flag = 1
		SELECT 0 AS status, 1 AS error_status,'Data updation failed' as error_messages,'Duplicate Unique ID Key' AS MSG
END
GO
