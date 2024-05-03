SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
--∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞ Fees-DocMe ∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞                                                                              
-- Author      : Chandrajith
-- Create date : 20/07/2018
-- Description : For updating data regarding Trip
--∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞ 
ALTER PROCEDURE [docme_transport].[trip_update]  
	@apikey [varchar](100),
	@trip_id int,
	@tripName [varchar](100),
    @tripCode [varchar](150),
	@tripDescription [varchar](150),
	@pickStartTime [varchar](150),
	@pickEndTime [varchar](150),
	@dropStartTime [varchar](150),
	@dropEndTime [varchar](150),
	@inst_id int,
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
	SELECT @data_count = COUNT(id) FROM [docme_transport].[tbl_trip] WHERE id=@trip_id
	IF @data_count = 0 
	BEGIN
		SELECT 0 AS id, 1 AS ErrorStatus, 'Invalid Trip  ID' AS ErrorMessage
		RETURN
	END
	DECLARE @precheck_status int;
	SET @precheck_status = 0; 
	SELECT @precheck_status = COUNT(id) FROM [docme_transport].[tbl_trip] WHERE tripName=@tripName AND id !=@trip_id
	IF @precheck_status > 0
	BEGIN
		SELECT 0 AS id, 1 AS ErrorStatus, 'Trip Already Exists' AS ErrorMessage
		RETURN 
	END
	SELECT @precheck_status = COUNT(id) FROM [docme_transport].[tbl_trip] WHERE tripDescription=@tripDescription AND id !=@trip_id
	IF @precheck_status > 0
	BEGIN
		SELECT 0 AS id, 1 AS ErrorStatus, 'Trip Description Already Exists' AS ErrorMessage
		RETURN 
	END
	
    SELECT @precheck_status = COUNT(id) FROM [docme_transport].[tbl_trip] WHERE tripCode=@tripCode AND id !=@trip_id
	IF @precheck_status > 0
	BEGIN
		SELECT 0 AS id, 1 AS ErrorStatus, 'Trip Code Already Exists' AS ErrorMessage
		RETURN 
	END
	
	-- Data Update Intiated --
	IF @flag = 1
	BEGIN
		Update [docme_transport].[tbl_trip]
		       
			    SET tripName=@tripname,
					tripDescription=@tripDescription,
					pickStartTime=@pickStartTime,
					pickEndTime=@pickEndTime,
					dropStartTime=@dropStartTime,
					dropEndTime=@dropEndTime,
                    tripCode=@tripCode,
					instId=@inst_id,
					modifiedOn=SYSDATETIME(),
					modifiedBy=@userid			 
					where id=@trip_id
	END
	ELSE IF @flag = 0
	BEGIN
		Update [docme_transport].[tbl_trip]
		SET isActive = @status,
		modifiedOn=SYSDATETIME(),
		modifiedBy=@userid
		WHERE id=@trip_id
	END
	IF @trip_id > 0
	BEGIN
		SELECT @id AS id, 0 AS ErrorStatus, 'Data Updated' AS ErrorMessage
	END
	ELSE
	BEGIN
		SELECT 0 AS id, 1 AS ErrorStatus, 'Unknown Error' AS ErrorMessage
	END			
END

GO
