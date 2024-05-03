SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

--∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞ Transport-DocMe ∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞                                                                              
-- Author      : Vinoth Kumar
-- ALTER date : 07/02/2020
-- Description : For gettING MAINTAINS REPORT
--∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞ 
ALTER PROCEDURE [docme_transport].[get_costwise_report]

@apikey [varchar](100),
@startdate date,
@enddate date,
@first_vehicle_id int,
@second_vehicle_id int,
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
	IF @first_vehicle_id=0
	BEGIN 
		 select ivs.*,ft.fuelTypeName,vsb.kmreading from docme_transport.tbl_invoice_service ivs 
left join docme_transport.tbl_vehicle_registration vreg on vreg.id = ivs.vehicleId
left join docme_transport.tbl_fueltype ft on ft.id = vreg.fuelTypeId
left join docme_transport.tbl_vehicle_service_booking vsb on vsb.id = ivs.ServiceBookingId
WHERE CAST(ivs.INVOICE_DATE as date)>= @startdate
			AND CAST(ivs.INVOICE_DATE as date )<= @enddate AND ivs.vehicleId IN (@first_vehicle_id, @second_vehicle_id)
	END
	ELSE
	BEGIN
		
          select ivs.*,ft.fuelTypeName,vsb.kmreading from docme_transport.tbl_invoice_service ivs 
left join docme_transport.tbl_vehicle_registration vreg on vreg.id = ivs.vehicleId
left join docme_transport.tbl_fueltype ft on ft.id = vreg.fuelTypeId
left join docme_transport.tbl_vehicle_service_booking vsb on vsb.id = ivs.ServiceBookingId
WHERE CAST(ivs.INVOICE_DATE as date)>= @startdate
			AND CAST(ivs.INVOICE_DATE as date )<= @enddate AND ivs.vehicleId IN (@first_vehicle_id, @second_vehicle_id)
    END
	
END










GO
