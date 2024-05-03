SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author      : AJU S ARAVIND
-- Create date : 06 - 03 - 2019
-- Description : For inserting data regarding Document MASTER
-- =============================================
ALTER PROCEDURE [docme_document].[document_save] 	
	@apikey [varchar](100),
	@inst_id INT,
	@DOC_NAME VARCHAR(200),
	@DOC_ID VARCHAR(200),
	@ISSUE_DATE VARCHAR(200),
	@ISSUE_AUTHORITY VARCHAR(200),
	@RENEW_DATE VARCHAR(200),
	@TYPE INT,
	@OTHER_DETAILS VARCHAR(MAX),
	@STORAGE_ID VARCHAR(200),
	@STUDENT_ID INT,
	@FILE_COUNT INT,
	@FILE_DETAILS VARCHAR(MAX)

AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;	
	DECLARE @precheck int;
	SET	@precheck = 0;
	SELECT @precheck = COUNT(id) FROM Auth.rest_keys WHERE Auth.rest_keys.api_key = @apikey AND Auth.rest_keys.isactive = 1 and Auth.rest_keys.api_key != '525-777-777';
	IF @precheck = 0
	BEGIN
		SELECT 0 AS Doc_id, 1 AS ErrorStatus, 'Invalid / Expired API KEY' AS ErrorMessage
		RETURN
	END
	Declare @id INT, 
			@userid INT;
	SET @id = 0;
	DECLARE @precheck_status int;
	SET @precheck_status = 0;
	SELECT @precheck_status = COUNT(*) FROM [docme_document].[tbl_document] WHERE Doc_name = @DOC_NAME and doc_id_no = @DOC_ID and Inst_id = @inst_id and Student_id = @STUDENT_ID
	IF @precheck_status > 0
	BEGIN
		SELECT 0 AS BatchID, 1 AS ErrorStatus, 'Document Id Already Exists' AS ErrorMessage
		RETURN 
	END
	
	SELECT @userid = Auth.rest_keys.userid FROM Auth.rest_keys WHERE Auth.rest_keys.api_key = @apikey AND Auth.rest_keys.isactive = 1;
			Insert into  docme_document.tbl_document
		          (
				 [inst_id]
				   ,[Doc_name]
				   ,[doc_id_no]
				   ,[date_of_issue]
				   ,[issueing_authority]
				   ,[expiry_date]
				   ,[doc_type_id]
				   ,[other_details]
				   ,[data_storage_id]
				   ,[Student_id]				   
				   ,[doc_status]
				   ,[download_count]
				   ,[file_count]
				   ,[createdby]
				   ,[createdon]		
				  )
      			  VALUES
				   (@inst_id
				   , @DOC_NAME
				   ,@DOC_ID
				   ,@ISSUE_DATE
				   ,@ISSUE_AUTHORITY
				   ,@RENEW_DATE
				    ,@TYPE
				   ,@OTHER_DETAILS
				   ,@STORAGE_ID
				   ,@STUDENT_ID
				   ,1
				   ,0
				   ,@FILE_COUNT
				   ,@userid
				   ,SYSDATETIME())
				  
			SET @id=@@IDENTITY;

			INSERT INTO [docme_document].[tbl_file_master]
			   ([doc_id]
			   ,[inst_id]
			   ,[orginal_file_name]
			   ,[uploaded_file_name]
			   ,[uploaded_path]
			   ,[studentid]			 
			   ,[status_id]
			   ,[createdby]
			   ,[createdon]
			 )
			 SELECT
				@ID
				, @inst_id
				, orginal_file_name
				, uploaded_file_name
				, uploaded_file_path
				, @STUDENT_ID
				, 1
				, @userid
				, SYSDATETIME()
			FROM OPENJSON(@FILE_DETAILS)
			WITH (
				orginal_file_name VARCHAR(MAX) ' $.orginal_file_name',  							
				uploaded_file_name VARCHAR(MAX) '$.uploaded_file_name',  
				uploaded_file_path VARCHAR(MAX) '$.uploaded_file_path'
			)


			IF @id > 0
			BEGIN
				SELECT @id AS Doc_id, 0 AS ErrorStatus, 'Success' AS ErrorMessage, 1 AS data_status
			END
			ELSE
			BEGIN
				SELECT 0 AS Doc_id, 1 AS ErrorStatus, 'Unknown Error' AS ErrorMessage, 0 as data_status
			END  
END

GO
