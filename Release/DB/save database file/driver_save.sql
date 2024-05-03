SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
--∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞ Transport-DocMe ∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞                                                                              
-- Author      : docme
-- Create date : 19/03/2019
-- Description : To save the parts-spare
--∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞ 
ALTER PROCEDURE [docme_transport].[driver_save]	
	@apikey [varchar](100),
	@drivername int,
	@vehno int,
	@startdate varchar(150),
    @enddate VARCHAR(150),
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
	SELECT @precheck_status = COUNT(vehicle_driver_map_id) FROM [docme_transport].[tbl_vehicle_driver_map]  WHERE vehicle_id=@vehno and emp_id=@drivername
	IF @precheck_status > 0
	BEGIN
		SELECT 0 AS id, 1 AS ErrorStatus, 'Driver Already Exists' AS ErrorMessage
		RETURN 
	END
	
	SELECT @userid = Auth.rest_keys.userid FROM Auth.rest_keys WHERE Auth.rest_keys.api_key = @apikey AND Auth.rest_keys.isactive = 1;
			Insert into [docme_transport].[tbl_vehicle_driver_map]
		            ([inst_id]
                    ,[vehicle_id]
                    ,[emp_id]
                    ,[Start_date]
                    ,[End_date]
					,createdBy
					,createdOn
					)
					
			  VALUES
				   (@inst_id,
				    @vehno,
				@drivername,	
                @startdate,
                @enddate,		   
				    @userid,
				   SYSDATETIME())
				  
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
