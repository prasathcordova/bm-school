SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
--∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞ Transport-DocMe ∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞                                                                              
-- Author      : Chandrajith
-- ALTER date : 22/10/2018
-- Description : For getting data regarding Vehicle Incidents
--∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞ 
ALTER PROCEDURE [docme_transport].[vehicleincident_select]	
@flag int,
@apikey [varchar](100),
@query varchar(100)
AS
BEGIN	
	SET NOCOUNT ON;
	DECLARE @precheck int,@user_id int = 0, @inst_id int = 0;	
	SET	@precheck = 0;
	SELECT @precheck = COUNT(id) FROM Auth.rest_keys WHERE Auth.rest_keys.api_key = @apikey AND Auth.rest_keys.isactive = 1
    select @user_id = userid from auth.rest_keys where api_key = @apikey and isactive = 1
    select @inst_id = Inst_id from dbo.Employee_list where Emp_id = @user_id
	
	IF @precheck = 0
	BEGIN
		SELECT 0 AS id, 1 AS ErrorStatus, 'Invalid / Expired API KEY' AS ErrorMessage
		RETURN
	END
	IF @flag = 3
	BEGIN
		EXEC(@query)
		RETURN
	END
	IF @flag = 1
	BEGIN
	SELECT vr.vehicleNum,tr.tripName,tpp.pickpointName ,vi.placeOfIncident,vi.causeOfIncident,vi.penaltyAmount,vi.actionTaken,vi.incidentDate,vi.incidentTime
    FROM [docme_transport].[tbl_vehicle_incidents]  vi
	left join[docme_transport]. tbl_vehicle_registration vr on vr.id=vi.vehicleId
	left join [docme_transport]. tbl_trip tr on vi.tripId=tr.id	
	left join [docme_transport].tbl_pickuppoint tpp on vi.lastPickupFromIncident=tpp.id
	--left join docme_transport.tbl_triproute_master trm on vi.id=trm.tripId
	--left join docme_transport.tbl_triproutepick_details trpd on vi.lastPickupFromIncident=trpd.stopId
	where vi.instId = @inst_id ORDER BY vehicleId ASC
	END
	ELSE
	BEGIN
		DECLARE @final_query NVARCHAR(1000);		
		IF @query IS NOT NULL
		BEGIN
			SET @final_query = 'SELECT * FROM [docme_transport].[tbl_vehicle_incidents] c WHERE ' + @query +' and c.instId = @inst_id ORDER BY vehicleId ASC';			
		END
		ELSE
		BEGIN
			SET @final_query = 'SELECT * FROM [docme_transport].[tbl_vehicle_incidents] c WHERE c.instId = @inst_id ORDER BY vehicleId ASC';
		END
		EXEC (@final_query);		
	END
END







GO
