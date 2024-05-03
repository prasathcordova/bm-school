SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
--888888888888888888888888888888888 Transport-DocMe 888888888888888888888888888888888888888                                                                              
-- Author      : Elavarasan S
-- Create date : 12/06/2019
-- Description : For getting data regarding Trip Details
--888888888888888888888888888888888888888888888888888888888888888888888888888888888888 
ALTER PROCEDURE [docme_transport].[trip_select_all_byid]	
@apikey [varchar](100),
@tripid int,
@inst_id int
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
	
	BEGIN
	 SELECT 
		tt.tripName,tt.tripCode, tt.tripDescription,tt.pickStartTime,tt.pickEndTime,tt.dropStartTime,tt.dropEndTime, tvr.vehicleNum, tvr.schoolNum, tvr.seatCapacity, ttm.vehicleLinkStartDate
	  FROM docme_transport.tbl_trip tt
	  left join docme_transport.tbl_trip_vehicle_mapping ttm on ttm.tripId=tt.id
	  left join docme_transport.tbl_vehicle_registration tvr on tvr.id=ttm.vehicleId
		WHERE tt.id = @tripid AND tt.instId = @inst_id


	END
	
END

GO
