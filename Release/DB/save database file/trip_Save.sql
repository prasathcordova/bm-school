SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

--∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞ Transport-DocMe ∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞                                                                              
-- Author      : chandrajith
-- Create date : 19/07/2018
-- Description : creating trip
--∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞ 
ALTER PROCEDURE [docme_transport].[trip_Save] 	
	@apikey [varchar](100),
	@trip_name [varchar](100),
    @trip_code [varchar](150),
	@trip_desc [varchar](150),
	@pick_start_time [varchar](150),
	@pick_end_time [varchar](150),
    @drop_start_time [varchar](150),
	@drop_end_time [varchar](150),
	@inst_id int
	
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
	SELECT @precheck_status = COUNT(id) FROM [docme_transport].[tbl_trip] WHERE tripName=@trip_name
	IF @precheck_status > 0
	BEGIN
		SELECT 0 AS id, 1 AS ErrorStatus, 'Trip Name Already Exists' AS ErrorMessage
		RETURN 
	END
	
	SET @precheck_status = 0;
	SELECT @precheck_status = COUNT(id) FROM [docme_transport].[tbl_trip] WHERE tripDescription=@trip_desc
	IF @precheck_status > 0
	BEGIN
		SELECT 0 AS id, 1 AS ErrorStatus, 'Trip Description Already Exists' AS ErrorMessage
		RETURN 
	END
    SET @precheck_status = 0;
	SELECT @precheck_status = COUNT(id) FROM [docme_transport].[tbl_trip] WHERE tripCode = @trip_code
	IF @precheck_status > 0
	BEGIN
		SELECT 0 AS id, 1 AS ErrorStatus, 'Trip Code Already Exists' AS ErrorMessage
		RETURN 
	END
	
	
	SELECT @userid = Auth.rest_keys.userid FROM Auth.rest_keys WHERE Auth.rest_keys.api_key = @apikey AND Auth.rest_keys.isactive = 1;
			Insert into [docme_transport].[tbl_trip]
		            (tripName,
					tripDescription,
					pickStartTime,
					pickEndTime,
                    dropStartTime,
                    dropEndTime,
					instId,
					creartedBy,
					createdOn,
                    tripCode

					)
					
			  VALUES
				   (@trip_name,
				   @trip_desc,
				   @pick_start_time,
				   @pick_end_time,
                   @drop_start_time,
				   @drop_end_time,
				   @inst_id,
				   @userid,
				   SYSDATETIME(),
                   @trip_code)
				  
			SET @id=@@IDENTITY;

			IF @id > 0
			BEGIN
				SELECT @id AS id, 0 AS ErrorStatus, '' AS ErrorMessage
			END
			ELSE
			BEGIN
				SELECT 0 AS id, 1 AS ErrorStatus, 'Unknown Error' AS ErrorMessage
			END  
END

GO