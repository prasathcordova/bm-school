SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

--∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞ Transport-DocMe ∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞                                                                              
-- Author      : Vinoth Kumar
-- ALTER date : 10/02/2020
-- Description : For gettING INCIDENTS REPORT
--∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞ 
ALTER PROCEDURE [docme_transport].[get_incidents_report]

@apikey [varchar](100),
@startdate date,
@enddate date,
@vehicle_id int,
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
	IF @vehicle_id=1000
	BEGIN 
		 
               select tvin.*,tvr.vehicleNum,tpp.pickpointName,tr.tripName  from docme_transport.tbl_vehicle_incidents tvin
LEFT JOIN docme_transport.tbl_vehicle_registration tvr on tvr.id = tvin.vehicleId 
	left join [docme_transport]. tbl_trip tr on tvin.tripId=tr.id
    left join [docme_transport].tbl_pickuppoint tpp on tvin.lastPickupFromIncident=tpp.id
    WHERE CAST(tvin.incidentDate AS DATE) >= @startdate
			AND CAST(tvin.incidentDate AS DATE) <= @enddate ORDER BY vehicleId 
	END
	ELSE
	BEGIN
		
        select tvin.*,tvr.vehicleNum,tpp.pickpointName,tr.tripName  from docme_transport.tbl_vehicle_incidents tvin
LEFT JOIN docme_transport.tbl_vehicle_registration tvr on tvr.id = tvin.vehicleId 
	left join [docme_transport]. tbl_trip tr on tvin.tripId=tr.id
    left join [docme_transport].tbl_pickuppoint tpp on tvin.lastPickupFromIncident=tpp.id
    WHERE CAST(tvin.incidentDate AS DATE) >= @startdate
			AND CAST(tvin.incidentDate AS DATE) <= @enddate and tvin.vehicleId = @vehicle_id ORDER BY vehicleId
    END
	
END





GO
