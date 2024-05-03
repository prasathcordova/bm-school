SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
--∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞ Transport-DocMe ∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞                                                                              
-- Author      : Chandrajith
-- ALTER date : 20/07/2018
-- Description : For updating data regarding Spareparts
--∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞ 
ALTER PROCEDURE [docme_transport].[conductor_update]  
	@apikey [varchar](100),
    @cid int,
	@name [varchar](150),
    @mobile [varchar](50),
    @paswd [varchar](250),
	--@instid int,		
	@flag int,
	@status int
AS
BEGIN	
	SET NOCOUNT ON;
	DECLARE @precheck int;
	SET	@precheck = 0;
	SELECT @precheck = COUNT(id) FROM Auth.rest_keys WHERE Auth.rest_keys.api_key = @apikey AND Auth.rest_keys.isactive = 1 
	--and Auth.rest_keys.api_key != '525-777-777';
	
	IF @precheck = 0
	BEGIN
		SELECT 0 AS id, 1 AS ErrorStatus, 'Invalid / Expired API KEY' AS ErrorMessage
		RETURN
	END
	Declare @id INT, 
	@userid INT,
	@api_count INT;
	SET @id = 0;
	
	
	SELECT @userid = Auth.rest_keys.userid FROM Auth.rest_keys WHERE Auth.rest_keys.api_key = @apikey AND Auth.rest_keys.isactive = 1;
	Declare @data_count int;
	SET @data_count = 0;
	SELECT @data_count = COUNT(id) FROM [docme_transport].[tbl_conductor] WHERE id=@cid
	IF @data_count = 0 
	BEGIN
		SELECT 0 AS id, 1 AS ErrorStatus, 'Invalid Type  ID' AS ErrorMessage
		RETURN
	END
	DECLARE @precheck_status int;
	SET @precheck_status = 0; 
	SELECT @precheck_status = COUNT(id) FROM [docme_transport].[tbl_conductor] WHERE mobile_no=@mobile AND id !=@cid
	IF @precheck_status > 0
	BEGIN
		SELECT 0 AS id, 1 AS ErrorStatus, 'Conductor Already Exists' AS ErrorMessage
		RETURN 
	END
	
	-- Data Update Intiated --
	IF @flag = 1
	BEGIN
		Update [docme_transport].[tbl_conductor]
		        SET conductor_name=@name,
				    mobile_no=@mobile,
					password = @paswd,					
					modifiedOn=SYSDATETIME(),
					modifiedBy=@userid
					where id=@cid
	END
	ELSE IF @flag = 0
	BEGIN
		Update [docme_transport].[tbl_conductor]
		SET isActive = @status,
		modifiedOn=SYSDATETIME(),
		modifiedBy=@userid
		WHERE id=@cid
	END
	IF @cid > 0
	BEGIN
		SELECT @id AS id, 0 AS ErrorStatus, 'Data Updated' AS ErrorMessage
	END
	ELSE
	BEGIN
		SELECT 0 AS id, 1 AS ErrorStatus, 'Unknown Error' AS ErrorMessage
	END			
END

GO
