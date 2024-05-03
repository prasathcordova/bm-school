SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
--∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞ Transport-DocMe ∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞                                                                              
-- Author      : Chandrajith
-- ALTER date : 20/07/2018
-- Description : For updating data regarding Spareparts
--∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞ 
ALTER PROCEDURE [docme_transport].[driver_update]  
	@apikey [varchar](100),
    -- @did int,
	@emp_id int,
    @veh_no int,
    -- @start_date VARCHAR(150),
    -- @end_date VARCHAR(150),
	--@instid int,		
	@flag int,
	@status int
AS
BEGIN	
	SET NOCOUNT ON;
	DECLARE @precheck int, @user_id int =0,@inst_id int =0;
	SET	@precheck = 0;
	SELECT @precheck = COUNT(id) FROM Auth.rest_keys WHERE Auth.rest_keys.api_key = @apikey AND Auth.rest_keys.isactive = 1 
	--and Auth.rest_keys.api_key != '525-777-777';
    SELECT @user_id = userid FROM AUTH.rest_keys WHERE api_key = @apikey AND isactive = 1
	SELECT @inst_id = Inst_id FROM DBO.Employee_list WHERE Emp_id = @user_id

	
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

	DECLARE @precheck_status int;
	SET @precheck_status = 0; 
	SELECT @precheck_status = COUNT(vehicle_driver_map_id) FROM docme_transport.tbl_vehicle_driver_map WHERE vehicle_id = @veh_no AND emp_id = @emp_id
	IF @precheck_status > 0
	BEGIN
		SELECT 0 AS id, 1 AS ErrorStatus, 'Driver Already Exists.' AS ErrorMessage
		RETURN 
	END
	
	-- Data Update Intiated --
	IF @flag = 1
	BEGIN

		Update [docme_transport].[tbl_vehicle_driver_map] SET End_date = SYSDATETIME(), isactive = 0,modifiedOn=SYSDATETIME(),
		modifiedBy=@userid where vehicle_id=@veh_no

                    Insert into [docme_transport].[tbl_vehicle_driver_map]
		            ([inst_id]
                    ,[vehicle_id]
                    ,[emp_id]
                    ,[Start_date]
                    ,[End_date]
                    ,isactive
					,createdBy
					,createdOn
					)
					
			  VALUES
				   (@inst_id,
				    @veh_no,
				@emp_id,	
                SYSDATETIME(),
                '',	
                1,	   
				    @userid,
				   SYSDATETIME())
	END
	ELSE IF @flag = 0
	BEGIN
		Update [docme_transport].[tbl_vehicle_driver_map]
		SET isactive = @status,
		modifiedOn=SYSDATETIME(),
		modifiedBy=@userid
		WHERE vehicle_id=@veh_no
	END
	IF @veh_no > 0
	BEGIN
		SELECT @id AS id, 0 AS ErrorStatus, 'Data Updated' AS ErrorMessage
	END
	ELSE
	BEGIN
		SELECT 0 AS id, 1 AS ErrorStatus, 'Unknown Error' AS ErrorMessage
	END			
END





GO
