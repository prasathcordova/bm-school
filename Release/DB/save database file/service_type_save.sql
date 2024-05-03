SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
--∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞ Transport-DocMe ∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞                                                                              
-- Author      : chandrajith
-- Create date : 26/07/2018
-- Description : To save the Service type details
--∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞ 
ALTER PROCEDURE [docme_transport].[service_type_save] 	
	@apikey [varchar](100),	
	@inst_id int,
	@serv_type_name [varchar](150)
		
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
		SELECT 0 AS id, 1 AS ErrorStatus, 'Invalid / Expired API KEY' AS ErrorMessage
		RETURN
	END
	Declare @id INT, 
			@userid INT;
	SET @id = 0;
	DECLARE @precheck_status int;
	SET @precheck_status = 0; 
	SELECT @precheck_status = COUNT(id) FROM [docme_transport].[tbl_servicetype] WHERE serviceType=@serv_type_name AND id !=@id
	IF @precheck_status > 0
	BEGIN
		SELECT 0 AS id, 1 AS ErrorStatus, 'Name already exists.' AS ErrorMessage
		RETURN 
	END
	
	SELECT @userid = Auth.rest_keys.userid FROM Auth.rest_keys WHERE Auth.rest_keys.api_key = @apikey AND Auth.rest_keys.isactive = 1;
			Insert into [docme_transport].[tbl_servicetype]
		            (instId,
					 serviceType,									
					 createdBy,
					 createdOn
					)
					
			  VALUES
				   (@inst_id,
				    @serv_type_name,				    		   
				    @userid,
				    SYSDATETIME())
				  
			SET @id=@@IDENTITY;

			IF @id > 0
			BEGIN
				SELECT @id AS id, 0 AS ErrorStatus, 'Data inserted Sucessfully' AS ErrorMessage
			END
			ELSE
			BEGIN
				SELECT 0 AS id, 1 AS ErrorStatus, 'Unknown Error' AS ErrorMessage
			END  
END

GO
