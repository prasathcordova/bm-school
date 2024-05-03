SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

--∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞ Transport-DocMe ∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞                                                                              
-- Author      : Vinoth Kumar
-- Create date : 16/JUL/2019
-- Description : For getting data regarding fees for a pickup point
--∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞ 
ALTER PROCEDURE [docme_transport].[update_student_daily_status]	

@apikey [varchar](100),
@trip_id int,
@pickuppoint_id int,
@student_id  int,
@vehicle_id int,
@travel_type varchar(50),
@travel_date_time dateTime


AS
BEGIN		
	SET NOCOUNT ON;
	DECLARE @precheck int;	
	SET	@precheck = 0;
	SELECT @precheck = COUNT(id) FROM Auth.rest_keys WHERE Auth.rest_keys.api_key = @apikey AND Auth.rest_keys.isactive = 1
	
	IF @precheck = 0
	BEGIN
		SELECT 0 AS id, 1 AS ErrorStatus, 'Invalid / Expired API KEY' AS ErrorMessage
		RETURN
	END
	Declare @id INT, 
			@userid INT;
	SET @id = 0;

DECLARE @USER_ID INT =0, 
	@INST_ID INT =0

	SELECT @USER_ID = userid FROM AUTH.rest_keys WHERE api_key = @apikey AND isactive = 1
	SELECT @INST_ID = Inst_id FROM DBO.Employee_list WHERE Emp_id = @USER_ID

	Insert into docme_transport.tbl_student_daily_travel_data
		(					
			student_id,
			trip_id,
			pickuppoint_id,
			vehicle_id,
			user_id,
			inst_id,
			travel_type,
            travel_date_time,
            createdOn
		)					
	VALUES
		(
			@student_id,
			@trip_id,
			@pickuppoint_id,
			@vehicle_id,
			@USER_ID,
			@INST_ID,
            @travel_type,
			@travel_date_time,
            SYSDATETIME()
		)

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
