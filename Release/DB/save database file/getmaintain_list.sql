SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

--∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞ Transport-DocMe ∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞                                                                              
-- Author      : Vinoth Kumar
-- ALTER date : 07/02/2020
-- Description : For getting data maintains list
--∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞ 
ALTER PROCEDURE [docme_transport].[get_maintanance_list]	

@apikey [varchar](100),
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
	IF @vehicle_id=0
	BEGIN 
		select st.id,st.serviceType,vsb.serrviceDate from docme_transport.tbl_vehicle_service_booking vsb 
left join docme_transport.tbl_servicetype st on st.id = vsb.serviceType
WHERE vsb.vehicleId = @vehicle_id
	END
	ELSE
	BEGIN
		
        select st.id,st.serviceType,vsb.serrviceDate from docme_transport.tbl_vehicle_service_booking vsb 
left join docme_transport.tbl_servicetype st on st.id = vsb.serviceType
WHERE vsb.vehicleId = @vehicle_id
    END
	
END



GO
