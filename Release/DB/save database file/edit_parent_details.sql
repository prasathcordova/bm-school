SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author      : Rahul
-- Create date : 31-Oct-2017
-- Description : To update family details of student while registering
-- @TRANS_TYPE = 1 (FOR INSERTING NEW PARENT) =2 FOR UPDATING EXISTING PARENT
-- VERSION     : 1.0.0.2(JAN 9, 2019)
-- =============================================
ALTER PROCEDURE [docme_registration].[edit_parent_details]
@apikey varchar(100),
@studentid INT,
@family_details XML,
@trans_type INT,
@sibiling_student_id INT =0,
@father_id INT,
@mother_id INT,
@guardian_id INT,
	@emp_id INT,
	@emp_inst_id INT,
	@who_worked VARCHAR(10)
AS
BEGIN	
	SET NOCOUNT ON;	
	DECLARE @precheck int;
	SET	@precheck = 0;
	SELECT @precheck = COUNT(id) FROM Auth.rest_keys WHERE Auth.rest_keys.api_key = @apikey AND Auth.rest_keys.isactive = 1 and Auth.rest_keys.api_key != '525-777-777';
	IF @precheck = 0
	BEGIN
		SELECT 0 AS religion_id, 1 AS ErrorStatus, 'Invalid / Expired API KEY' AS ErrorMessage
		RETURN
	END
	Declare @Inst_id int
	--SELECT @Inst_id = Code_Value FROM SYSTEM_PARAMETERS WHERE Code='INSTID'
	Declare @id INT,@acd_year INT,
	@userid INT;
	SET @id = 0;
	DECLARE @precheck_status int, @admn_no VARCHAR(50);
	SELECT @admn_no =admn_no , @acd_year =Cur_AcadYr FROM dbo.Student_master where student_id = @studentid;
	SELECT @userid = Auth.rest_keys.userid FROM Auth.rest_keys WHERE Auth.rest_keys.api_key = @apikey AND Auth.rest_keys.isactive = 1;
	SELECT TOP 1 @Inst_id = inst_id from auth.tbl_login where [USER_ID] = @userid
	--SELECT @Inst_id = Code_Value FROM SYSTEM_PARAMETERS WHERE Code='INSTID'	
	
	--Declaring variables
	DECLARE 
		@name VARCHAR(MAX),
		@uuid VARCHAR(MAX),
		@profession INT,		
		@relation VARCHAR(10),
		@gender VARCHAR(MAX),
		--communication
		@cadd1 VARCHAR(MAX),
		@cadd2 VARCHAR(MAX),
		@cadd3 VARCHAR(MAX),
		@czip VARCHAR(50),
		@cphone VARCHAR(50),
		@cmobile VARCHAR(50),
		@cmail VARCHAR(200),
		--offcial
		@oadd1 VARCHAR(MAX),
		@oadd2 VARCHAR(MAX),
		@oadd3 VARCHAR(MAX),
		@ozip VARCHAR(50),
		@ophone VARCHAR(50),
		@omobile VARCHAR(50),
		@omail VARCHAR(200),
		--permanent
		@padd1 VARCHAR(MAX),
		@padd2 VARCHAR(MAX),
		@padd3 VARCHAR(MAX),
		@pzip VARCHAR(50),
		@pphone VARCHAR(50),
		@pmobile VARCHAR(50),
		@pmail VARCHAR(200),
			
	
		@final_status INT = 1,

		@parent_id INT =0,
		@flag_relation INT =0
	DECLARE @PARENT_ID_UPDATE INT, @FAMILY_ID INT,@flag INT;
	SET @flag=0;
		
	BEGIN TRANSACTION;
	SAVE TRANSACTION MySavePointRegistration;
	BEGIN TRY

		DECLARE Registration_Cursor CURSOR LOCAL FOR 
		SELECT  
			XCol.value('(name)[1]','varchar(200)') as name,
			XCol.value('(uuid)[1]','varchar(50)') as uuid,
			XCol.value('(profession)[1]','varchar(200)') as profession,
			XCol.value('(relation)[1]','varchar(20)') as relation,
			XCol.value('(gender)[1]','varchar(200)') as gender,
			XCol.value('(cadd1)[1]','varchar(200)') as cadd1,
			XCol.value('(cadd2)[1]','varchar(200)') as cadd2,
			XCol.value('(cadd3)[1]','varchar(200)') as cadd3,
			XCol.value('(czip)[1]','varchar(200)') as czip,
			XCol.value('(cphone)[1]','varchar(200)') as cphone,
			XCol.value('(cmobile)[1]','varchar(200)') as cmobile,
			XCol.value('(cmail)[1]','varchar(200)') as cmail,
			XCol.value('(oadd1)[1]','varchar(200)') as oadd1,
			XCol.value('(oadd2)[1]','varchar(200)') as oadd2,
			XCol.value('(oadd3)[1]','varchar(200)') as oadd3,
			XCol.value('(ozip)[1]','varchar(200)') as ozip,
			XCol.value('(ophone)[1]','varchar(200)') as ophone,
			XCol.value('(omobile)[1]','varchar(200)') as omobile,
			XCol.value('(omail)[1]','varchar(200)') as omail,
			XCol.value('(padd1)[1]','varchar(200)') as padd1,
			XCol.value('(padd2)[1]','varchar(200)') as padd2,
			XCol.value('(padd3)[1]','varchar(200)') as padd3,
			XCol.value('(pzip)[1]','varchar(200)') as pzip,
			XCol.value('(pphone)[1]','varchar(200)') as pphone,
			XCol.value('(pmobile)[1]','varchar(200)') as pmobile,
			XCol.value('(pmail)[1]','varchar(200)') as pmail
			--xcOL.value('(pisstaff)[1]','varchar(10)') as pisstaff
								 
		FROM @family_details.nodes('/table/row') AS XTbl(XCol)
		OPEN Registration_Cursor 
		FETCH NEXT FROM Registration_Cursor INTO 
			 @name
			,@uuid
			,@profession
			,@relation
			,@gender
			,@cadd1
			,@cadd2
			,@cadd3
			,@czip
			,@cphone
			,@cmobile
			,@cmail
			,@oadd1
			,@oadd2
			,@oadd3
			,@ozip
			,@ophone
			,@omobile
			,@omail
			,@padd1
			,@padd2
			,@padd3
			,@pzip
			,@pphone
			,@pmobile
			,@pmail
			--,@pisstaff				
		WHILE @@FETCH_STATUS = 0
		BEGIN	

            DECLARE @fempid int = 0,@finst_id int = 0,@mempid int = 0,@minst_id int = 0,@staff_concession int = 0,
		@fisstaff VARCHAR(10),@misstaff VARCHAR(10)
            IF @who_worked ='M'
            BEGIN
                SET @fempid = @emp_id
                SET @finst_id = @emp_inst_id
                SET @staff_concession = 1
                SET @fisstaff = 1
            END
            IF @who_worked ='F'
            BEGIN
                SET @mempid = @emp_id
                SET @minst_id = @emp_inst_id
                SET @staff_concession = 1
                SET @misstaff = 1
            END	

			IF @trans_type = 1
			BEGIN		
			--father 
				IF @relation='F'
				BEGIN
					UPDATE DBO.PARENT_MASTER
						SET Parent_Name=@name,
						Gender=@gender,
						Profession=@profession,
						Adhar_No =@uuid,
						is_staff = @fisstaff,
                        emp_inst_id = @finst_id,
                        emp_id = @fempid
					Where Parent_ID=@father_id
				
					--COMMUNICATION ADDRESS
					UPDATE dbo.ADDRESS_MASTER 
						SET	ADDRESS1 = @cadd1
						,ADDRESS2 =@cadd2
						,ADDRESS3 =@cadd3
						,PO_NO =@czip
						,PHONE1=@cphone
						,PHONE3 =@cmobile
						,EMAIL= @cmail
					WHERE Parent_ID=@father_id AND Address_Type =1
					--OFFICE ADDRESS

					UPDATE dbo.ADDRESS_MASTER 
						SET		 ADDRESS1 = @oadd1
						,ADDRESS2 =@oadd2
						,ADDRESS3 =@oadd3
						,PO_NO =@ozip
						,PHONE1=@ophone
						,PHONE3 =@omobile
						,EMAIL= @omail
					WHERE Parent_ID=@father_id AND Address_Type =2

						
					--PERMENANT ADDRESS
						
					UPDATE dbo.ADDRESS_MASTER 
						SET		 ADDRESS1 = @padd1
						,ADDRESS2 =@padd2
						,ADDRESS3 =@padd3
						,PO_NO =@pzip
						,PHONE1=@pphone
						,PHONE3 =@pmobile
						,EMAIL= @pmail
					WHERE Parent_ID=@father_id AND Address_Type =3

					DELETE FROM DBO.Stud_Parent_Relations WHERE Student_Id = @studentid AND Relation = 'F'
					INSERT INTO dbo.Stud_Parent_Relations(
						Inst_Id,
						Student_Id,
						Admn_No,
						Parent_Id,
						Relation,
						Entry_By,
						Entry_Dt,
						Adhar_No
					)VAlUES(
						@Inst_id,
						@studentid,
						@admn_no,
						@father_id,
						'F',
						@userid,
						SYSDATETIME(),
						@uuid
					)
					SET @flag = 0
					SELECT @flag = count(Family_Id) FROM DBO.STUDENT_FAMILY_RELATIONS WHERE student_id = @studentid AND Inst_Id = @Inst_id 
					IF @flag = 1
					BEGIN
						UPDATE DBO.STUDENT_FAMILY_RELATIONS SET Father_Id = @father_id WHERE student_id = @studentid AND Inst_Id = @Inst_id
					END
					ELSE 
					BEGIN
						INSERT INTO [dbo].[Student_family_Relations]
								([Inst_Id]
								,[Father_Id]
								,[Mother_Id]
								,[student_id]
								,[Admn_No]
								,[Priority]
								,[Entry_By]
								,[Entry_Dt])
							VALUES
								(@Inst_id
								,@father_id
								,0
								,@studentid
								,@admn_no
								,0
								,@userid
								,SYSDATETIME()
								)
					END


				END
				--mother
				IF @relation='M'
				BEGIN
					UPDATE DBO.PARENT_MASTER
						SET Parent_Name=@name,
						Gender=@gender,
						Profession=@profession,
						Adhar_No=@uuid,
						is_staff=@misstaff,
                        emp_inst_id = @minst_id,
                        emp_id = @mempid
					Where Parent_ID=@mother_id
				
					--COMMUNICATION ADDRESS
					UPDATE dbo.ADDRESS_MASTER 
						SET		 ADDRESS1 = @cadd1
						,ADDRESS2 =@cadd2
						,ADDRESS3 =@cadd3
						,PO_NO =@czip
						,PHONE1=@cphone
						,PHONE3 =@cmobile
						,EMAIL= @cmail
					WHERE Parent_ID=@mother_id AND Address_Type =1
					--OFFICE ADDRESS

					UPDATE dbo.ADDRESS_MASTER 
						SET		 ADDRESS1 = @oadd1
						,ADDRESS2 =@oadd2
						,ADDRESS3 =@oadd3
						,PO_NO =@ozip
						,PHONE1=@ophone
						,PHONE3 =@omobile
						,EMAIL= @omail
					WHERE Parent_ID=@mother_id AND Address_Type =2

						
					--PERMENANT ADDRESS
						
					UPDATE dbo.ADDRESS_MASTER 
						SET		 ADDRESS1 = @padd1
						,ADDRESS2 =@padd2
						,ADDRESS3 =@padd3
						,PO_NO =@pzip
						,PHONE1=@pphone
						,PHONE3 =@pmobile
						,EMAIL= @pmail
					WHERE Parent_ID=@mother_id AND Address_Type =3

					DELETE FROM DBO.Stud_Parent_Relations WHERE Student_Id = @studentid AND Relation = 'M'
					INSERT INTO dbo.Stud_Parent_Relations(
						Inst_Id,
						Student_Id,
						Admn_No,
						Parent_Id,
						Relation,
						Entry_By,
						Entry_Dt,
						Adhar_No
					)VAlUES(
						@Inst_id,
						@studentid,
						@admn_no,
						@mother_id,
						'M',
						@userid,
						SYSDATETIME(),
						@uuid
					)
					SET @flag = 0
					SELECT @flag = count(Family_Id) FROM DBO.STUDENT_FAMILY_RELATIONS WHERE student_id = @studentid AND Inst_Id = @Inst_id 
					IF @flag = 1
					BEGIN
						UPDATE DBO.STUDENT_FAMILY_RELATIONS SET Mother_Id = @mother_id WHERE student_id = @studentid AND Inst_Id = @Inst_id
					END
					ELSE 
					BEGIN
						INSERT INTO [dbo].[Student_family_Relations]
								([Inst_Id]
								,[Father_Id]
								,[Mother_Id]
								,[student_id]
								,[Admn_No]
								,[Priority]
								,[Entry_By]
								,[Entry_Dt]
								)
							VALUES
								(@Inst_id
								,0
								,@mother_id
								,@studentid
								,@admn_no
								,0
								,@userid
								,SYSDATETIME()
								)
					END
				END
				-- guardian
				IF @relation='G'
                IF @guardian_id <> 0
				BEGIN
					UPDATE DBO.PARENT_MASTER
						SET Parent_Name=@name,
						Gender=@gender,
						Profession=@profession,
						Adhar_No=@uuid
					Where Parent_ID=@guardian_id

				
					--COMMUNICATION ADDRESS
					UPDATE dbo.ADDRESS_MASTER 
						SET		 ADDRESS1 = @cadd1
						,ADDRESS2 =@cadd2
						,ADDRESS3 =@cadd3
						,PO_NO =@czip
						,PHONE1=@cphone
						,PHONE3 =@cmobile
						,EMAIL= @cmail
					WHERE Parent_ID=@guardian_id AND Address_Type =1
					--OFFICE ADDRESS

					UPDATE dbo.ADDRESS_MASTER 
						SET		 ADDRESS1 = @oadd1
						,ADDRESS2 =@oadd2
						,ADDRESS3 =@oadd3
						,PO_NO =@ozip
						,PHONE1=@ophone
						,PHONE3 =@omobile
						,EMAIL= @omail
					WHERE Parent_ID=@guardian_id AND Address_Type =2

						
					--PERMENANT ADDRESS
						
					UPDATE dbo.ADDRESS_MASTER 
						SET		 ADDRESS1 = @padd1
						,ADDRESS2 =@padd2
						,ADDRESS3 =@padd3
						,PO_NO =@pzip
						,PHONE1=@pphone
						,PHONE3 =@pmobile
						,EMAIL= @pmail
					WHERE Parent_ID=@guardian_id AND Address_Type =3
					DELETE FROM DBO.Stud_Parent_Relations WHERE Student_Id = @studentid AND Relation = 'G'
					INSERT INTO dbo.Stud_Parent_Relations(
						Inst_Id,
						Student_Id,
						Admn_No,
						Parent_Id,
						Relation,
						Entry_By,
						Entry_Dt,
						Adhar_No
					)VAlUES(
						@Inst_id,
						@studentid,
						@admn_no,
						@guardian_id,
						'G',
						@userid,
						SYSDATETIME(),
						@uuid
					)
				END	
                ELSE
                BEGIN
                INSERT INTO DBO.PARENT_MASTER (
							INST_ID
							,PARENT_NAME
							,GENDER
							,PROFESSION
							,ENTRY_BY
							,ENTRY_DATE
							,GRNOAADHARNO
							,IsAadharNo
							,Adhar_No
						) VALUES (
							@Inst_id
							,@name
							,@gender
							,@profession
							,@userid
							,SYSDATETIME()
							,''
							,1,
							@uuid
						)
						SET @parent_id = @@IDENTITY						
						--COMMUNICATION ADDRESS
						INSERT INTO dbo.ADDRESS_MASTER (
							 INST_ID
							,PARENT_ID
							,ADDRESS1
							,ADDRESS2
							,ADDRESS3
							,PO_NO
							,PHONE1
							,PHONE3
							,EMAIL
							,ADDRESS_TYPE
							,ENTRY_BY
							,ENTRY_DATE
						) VALUES (
							@Inst_id
							,@parent_id
							,@cadd1
							,@cadd2
							,@cadd3
							,@czip
							,@cphone
							,@cmobile
							,@cmail
							,1
							,@userid
							,SYSDATETIME()
						)
						--OFFICE ADDRESS
						INSERT INTO dbo.ADDRESS_MASTER (
							INST_ID
							,PARENT_ID
							,ADDRESS1
							,ADDRESS2
							,ADDRESS3
							,PO_NO
							,PHONE1
							,PHONE3
							,EMAIL
							,ADDRESS_TYPE
							,ENTRY_BY
							,ENTRY_DATE
						) VALUES (
							@Inst_id
							,@parent_id
							,@oadd1
							,@oadd2
							,@oadd3
							,@ozip
							,@ophone
							,@omobile
							,@omail
							,2
							,@userid
							,SYSDATETIME()
						)
						--PERMENANT ADDRESS
						INSERT INTO dbo.ADDRESS_MASTER (
							INST_ID
							,PARENT_ID
							,ADDRESS1
							,ADDRESS2
							,ADDRESS3
							,PO_NO
							,PHONE1
							,PHONE3
							,EMAIL
							,ADDRESS_TYPE
							,ENTRY_BY
							,ENTRY_DATE
						) VALUES (
							@Inst_id
							,@parent_id
							,@padd1
							,@padd2
							,@padd3
							,@pzip
							,@pphone
							,@pmobile
							,@pmail
							,3
							,@userid
							,SYSDATETIME()
						)

						
						IF @relation='G'
						BEGIN
						SET @guardian_id=@parent_id
						END

						--STUDENT PARENT RELATION
						INSERT INTO [dbo].[Stud_Parent_Relations] (
							INST_ID
							,STUDENT_ID
							,ADMN_NO
							,PARENT_ID
							,RELATION
							,ENTRY_BY
							,ENTRY_DT
							,EMPID
							,Adhar_No
							,IsAadharNo
							,GrNoAadharNo
						) VALUES (
							@inst_id
							,@studentid
							,@admn_no
							,@parent_id
							,@relation
							,@userid
							,SYSDATETIME()
							,NULL
							,@uuid,
							1
							,''
						)						
						--STUDENT FAMILY RELATION
						IF @relation = 'F'
						BEGIN
                            UPDATE DBO.PARENT_MASTER SET
                                    is_staff= @fisstaff,
                                    emp_inst_id = @finst_id,
                                    emp_id = @fempid
                                    WHERE Parent_ID = @parent_id
							INSERT INTO [dbo].[Student_family_Relations] (
								INST_ID
								,FATHER_ID
								,STUDENT_ID
								,ADMN_NO
								,PRIORITY
								,ENTRY_BY
								,ENTRY_DT
							) VALUES (
								@inst_id
								,@parent_id
								,@studentid
								,@admn_no
								,0
								,@userid
								,SYSDATETIME()
							)
						SET @father_id=@parent_id;
						END
                END
			END
			ELSE
			BEGIN
				IF @sibiling_student_id> 0
				BEGIN
					SET @PARENT_ID_UPDATE =0
					SELECT @PARENT_ID_UPDATE = PARENT_ID FROM DBO.Stud_Parent_Relations WHERE Student_Id = @sibiling_student_id AND Relation = @relation
					--	SElECT @flag=1 FROM dbo.Stud_Parent_Relations where Student_Id=@studentid and Parent_Id NOT IN (Select Parent_Id from dbo.Stud_Parent_Relations where student_id = @sibiling_student_id)
					--	IF @flag=1 AND @PARENT_ID_UPDATE > 0
					--	BEGIN
							--DELETE FROM dbo.Stud_Parent_Relations
							--WHERE Student_Id = @studentid 

							--INSERT INTO dbo.Stud_Parent_Relations(
							--	Inst_Id,
							--	Student_Id,
							--	Admn_No,
							--	Parent_Id,
							--	Relation,
							--	Entry_By,
							--	Entry_Dt
							--)VAlUES(
							--	@Inst_id,
							--	@studentid,
							--	@admn_no,
							--	@PARENT_ID_UPDATE,
							--	@relation,
							--	@userid,
							--	SYSDATETIME()
							--)
					-- END
					-- ELSE
					BEGIN
						IF @PARENT_ID_UPDATE > 0
						BEGIN
							UPDATE DBO.PARENT_MASTER SET
								PROFESSION = @profession,
								Gender = @gender,
								Adhar_No=@uuid
							WHERE Parent_ID = @PARENT_ID_UPDATE

							--COMMUNICATION ADDRESS

							UPDATE dbo.ADDRESS_MASTER SET
								ADDRESS1 = @cadd1
								,ADDRESS2= @cadd2
								,ADDRESS3 = @cadd3
								,PO_NO = @czip
								,PHONE1= @cphone
								,PHONE3 =@cmobile
								,EMAIL = @cmail
							WHERE PARENT_ID= @PARENT_ID_UPDATE AND ADDRESS_TYPE = 1

							--OFFICE ADDRESS

							UPDATE dbo.ADDRESS_MASTER SET
								ADDRESS1 = @oadd1
								,ADDRESS2= @oadd2
								,ADDRESS3 = @oadd3
								,PO_NO = @ozip
								,PHONE1= @ophone
								,PHONE3 =@omobile
								,EMAIL = @omail
							WHERE PARENT_ID= @PARENT_ID_UPDATE AND ADDRESS_TYPE = 2

							--PERMENANT ADDRESS

							UPDATE dbo.ADDRESS_MASTER SET
								ADDRESS1 = @padd1
								,ADDRESS2= @padd2
								,ADDRESS3 = @padd3
								,PO_NO = @pzip
								,PHONE1= @pphone
								,PHONE3 =@pmobile
								,EMAIL = @pmail
							WHERE PARENT_ID= @PARENT_ID_UPDATE AND ADDRESS_TYPE = 3	
							SET @flag = 0
							SELECT @flag =1 FROM DBO.STUD_PARENT_RELATIONS WHERE Student_Id = @studentid AND Parent_Id = @PARENT_ID_UPDATE AND Relation = @relation 
							IF @flag = 0
							BEGIN
								INSERT INTO dbo.Stud_Parent_Relations(
									Inst_Id,
									Student_Id,
									Admn_No,
									Parent_Id,
									Relation,
									Entry_By,
									Entry_Dt,
									Adhar_No
								)VAlUES(
									@Inst_id,
									@studentid,
									@admn_no,
									@PARENT_ID_UPDATE,
									@relation,
									@userid,
									SYSDATETIME(),
									@uuid
								)
							END
						END
						ELSE
						BEGIN
							INSERT INTO [dbo].[Parent_Master]
								   ([Inst_ID]
								   ,[Parent_Name]
								   ,[Gender]
								   ,[Profession]
								   ,[Entry_By]
								   ,[Entry_Date]
								   ,[GrNoAadharNo]
								   ,[IsAadharNo]
								   ,[Adhar_No])
							 VALUES
								   (@Inst_id
								   , @name
								   , @gender
								   , @profession
								   , @userid
								   ,SYSDATETIME()
								   , ''
								   , 1
								   ,@uuid)
							SET @PARENT_ID_UPDATE = @@IDENTITY
							INSERT INTO [dbo].[Address_Master]
								([Inst_ID]
								,[Parent_ID]
								,[Address1]
								,[Address2]
								,[Address3]
								,[PO_No]
								,[Phone1]
								,[EMAIL]
								,[Phone3]
								,[Address_Type]
								,[Entry_By]
								,[Entry_Date]
								,[ISACTIVE])
							VALUES
								(@Inst_id
								,@PARENT_ID_UPDATE
								,@cadd1
								,@cadd2
								,@cadd3
								,@czip
								,@cphone
								,@cmail
								,@cmobile
								,1
								,@userid
								,SYSDATETIME()
								,1)
							INSERT INTO [dbo].[Address_Master]
								([Inst_ID]
								,[Parent_ID]
								,[Address1]
								,[Address2]
								,[Address3]
								,[PO_No]
								,[Phone1]
								,[EMAIL]
								,[Phone3]
								,[Address_Type]
								,[Entry_By]
								,[Entry_Date]
								,[ISACTIVE])
							VALUES
								(@Inst_id
								,@PARENT_ID_UPDATE
								,@oadd1
								,@oadd2
								,@oadd3
								,@ozip
								,@ophone
								,@omail
								,@omobile
								,2
								,@userid
								,SYSDATETIME()
								,1)
							INSERT INTO [dbo].[Address_Master]
								([Inst_ID]
								,[Parent_ID]
								,[Address1]
								,[Address2]
								,[Address3]
								,[PO_No]
								,[Phone1]
								,[EMAIL]
								,[Phone3]
								,[Address_Type]
								,[Entry_By]
								,[Entry_Date]
								,[ISACTIVE])
							VALUES
								(@Inst_id
								,@PARENT_ID_UPDATE
								,@padd1
								,@padd2
								,@padd3
								,@pzip
								,@pphone
								,@pmail
								,@pmobile
								,3
								,@userid
								,SYSDATETIME()
								,1)
							INSERT INTO [dbo].[Stud_Parent_Relations]
								   ([Inst_Id]
								   ,[Student_Id]
								   ,[Admn_No]
								   ,[Parent_Id]
								   ,[Relation]
								   ,[Entry_By]
								   ,[Entry_Dt]
								   ,[Adhar_No]
								   )
							 VALUES
								   (@Inst_id
								   ,@studentid
								   ,@admn_no
								   ,@PARENT_ID_UPDATE
								   ,@relation
								   ,@userid
								   ,SYSDATETIME()
								   ,@uuid
								   )
							IF @relation = 'F' 
							BEGIN
                                    UPDATE DBO.PARENT_MASTER SET
                                        is_staff=@fisstaff,
                                        emp_inst_id = @finst_id,
                                        emp_id = @fempid
                                    WHERE Parent_ID = @PARENT_ID_UPDATE
								SET @flag = 0
								SELECT @flag = 1 FROM DBO.STUDENT_FAMILY_RELATIONS WHERE student_id = @studentid AND Inst_Id = @Inst_id 
								IF @flag = 1
								BEGIN
									UPDATE DBO.STUDENT_FAMILY_RELATIONS SET Father_Id = @PARENT_ID_UPDATE WHERE student_id = @studentid AND Inst_Id = @Inst_id
								END
								ELSE 
								BEGIN
									INSERT INTO [dbo].[Student_family_Relations]
										   ([Inst_Id]
										   ,[Father_Id]
										   ,[Mother_Id]
										   ,[student_id]
										   ,[Admn_No]
										   ,[Priority]
										   ,[Entry_By]
										   ,[Entry_Dt]
                                            )
									 VALUES
										   (@Inst_id
										   ,@PARENT_ID_UPDATE
										   ,0
										   ,@studentid
										   ,@admn_no
										   ,0
										   ,@userid
										   ,SYSDATETIME()
                                            )
								END
							END
							ELSE IF @relation = 'M' 
							BEGIN
                                 UPDATE DBO.PARENT_MASTER SET
                                        is_staff=@misstaff,
                                        emp_inst_id = @minst_id,
                                        emp_id = @mempid
                                    WHERE Parent_ID = @PARENT_ID_UPDATE
								SET @flag = 0
								SELECT @flag = 1 FROM DBO.STUDENT_FAMILY_RELATIONS WHERE student_id = @studentid AND Inst_Id = @Inst_id 
								IF @flag = 1
								BEGIN
									UPDATE DBO.STUDENT_FAMILY_RELATIONS SET Mother_Id = @PARENT_ID_UPDATE WHERE student_id = @studentid AND Inst_Id = @Inst_id
								END
								ELSE 
								BEGIN
									INSERT INTO [dbo].[Student_family_Relations]
										   ([Inst_Id]
										   ,[Father_Id]
										   ,[Mother_Id]
										   ,[student_id]
										   ,[Admn_No]
										   ,[Priority]
										   ,[Entry_By]
										   ,[Entry_Dt])
									 VALUES
										   (@Inst_id
										   ,0
										   ,@PARENT_ID_UPDATE
										   ,@studentid
										   ,@admn_no
										   ,0
										   ,@userid
										   ,SYSDATETIME()
                                            )
								END
							END
						END				
					END
				END
               
			END				

             UPDATE dbo.Student_Master SET staff_concession = @staff_concession WHERE student_id IN(SELECT A.student_id FROM dbo.Student_Master A 
                                JOIN dbo.Stud_Parent_Relations B ON B.Student_Id = A.student_id 
                                JOIN dbo.Parent_Master P ON P.Parent_ID = B.Parent_Id 
                                WHERE P.Parent_ID = @father_id AND P.Inst_ID = @Inst_id)
            --For updating Staff Concession For Students

           

			FETCH NEXT FROM Registration_Cursor  INTO  
				@name
			,@uuid
			,@profession
			,@relation
			,@gender
			,@cadd1
			,@cadd2
			,@cadd3
			,@czip
			,@cphone
			,@cmobile
			,@cmail
			,@oadd1
			,@oadd2
			,@oadd3
			,@ozip
			,@ophone
			,@omobile
			,@omail
			,@padd1
			,@padd2
			,@padd3
			,@pzip
			,@pphone
			,@pmobile
			,@pmail
			--,@pisstaff			
		END
		CLOSE Registration_Cursor ;
		DEALLOCATE Registration_Cursor ;	
		IF @studentid > 0
		BEGIN
			EXEC UPDATE_STUDENT_PRIORITY_REFRESH @studentid,@apikey,@acd_year,@Inst_id
			select @final_status =1
		END	
		SET @precheck=0;
		select @precheck= parent_details from [docme_registration].[registration_status] where studentid=@studentid
		IF @precheck = 0
		BEGIN
			DECLARE @PERCENT_SHARE INT,@CUR_PERCENT INT =0;
			SELECT @PERCENT_SHARE = PERCENT_SHARE FROM [docme_registration].[reg_percent_share] WHERE keyword = 'Parent_profile'
			SELECT @CUR_PERCENT = reg_percent FROM [docme_registration].[registration_status] WHERE [studentid] = @studentid AND [inst_id]=@Inst_id
			SET @CUR_PERCENT = @CUR_PERCENT + @PERCENT_SHARE
			UPDATE [docme_registration].[registration_status]
				SET [reg_percent]=@CUR_PERCENT,
				[parent_details]=1,
				[modifiedby]=@USERID,
				[modifiedon]=SYSDATETIME() 
			WHERE [studentid] = @studentid AND [inst_id]=@Inst_id
		END
	END TRY		
	BEGIN CATCH
		IF @@TRANCOUNT > 0
		BEGIN			
			SET @final_status = 0
			ROLLBACK TRANSACTION MySavePointRegistration; -- rollback to MySavePointRegistration
			SELECT 0 AS status, 1 AS error_status,'Rollbacked data updation' as error_messages,ERROR_MESSAGE() AS MSG
		END
	END CATCH
	COMMIT TRANSACTION

	IF @final_status = 0
		SELECT 0 AS status, 1 AS error_status,'Data update failed' as error_messages,ERROR_MESSAGE() AS MSG
	ELSE
		SELECT 1 AS status, 0 AS error_status,'Data updated succesfully' as error_messages,ERROR_MESSAGE() AS MSG
	
END






GO
