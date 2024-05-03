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
         select distinct(ivs.INVOICE_DATE),ivs.vehicleNum,ivs.ServiceCenter,ivs.sparparts_details,ivs.acesories_details,ivs.miscellaneous_details,ivs.labourCharge,ivs.otherDetails,ivs.amountTotal from docme_transport.tbl_invoice_service ivs 
WHERE CAST(ivs.INVOICE_DATE as date)>= @startdate
			AND CAST(ivs.INVOICE_DATE as date )<= @enddate AND ivs.vehicleId =  @vehicle_id
		 
--                  select *,vsb.serrviceDate from docme_transport.tbl_invoice_service ivs 
--                   left JOIN docme_transport.tbl_vehicle_service_booking vsb on vsb.vehicleId = ivs.vehicleId
-- WHERE CAST(ivs.INVOICE_DATE as date)>= @startdate
-- 			AND CAST(ivs.INVOICE_DATE as date )<= @enddate AND ivs.vehicleId = @vehicle_id
	END
	ELSE
	BEGIN
    select distinct(ivs.INVOICE_DATE),ivs.vehicleNum,ivs.ServiceCenter,ivs.sparparts_details,ivs.acesories_details,ivs.miscellaneous_details,ivs.labourCharge,ivs.otherDetails,ivs.amountTotal from docme_transport.tbl_invoice_service ivs 
WHERE CAST(ivs.INVOICE_DATE as date)>= @startdate
			AND CAST(ivs.INVOICE_DATE as date )<= @enddate AND ivs.vehicleId =  @vehicle_id
		
--            select ivs.*,vsb.serrviceDate from docme_transport.tbl_invoice_service ivs 
--            left JOIN docme_transport.tbl_vehicle_service_booking vsb on vsb.vehicleId = ivs.vehicleId
-- WHERE CAST(ivs.INVOICE_DATE as date)>= @startdate
-- 			AND CAST(ivs.INVOICE_DATE as date )<= @enddate AND ivs.vehicleId = @vehicle_id
    END
	
END










GO
