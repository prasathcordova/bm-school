SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

--∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞ Transport-DocMe ∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞                                                                              
-- Author      : Vinoth Kumar
-- ALTER date : 07/02/2020
-- Description : For gettING MAINTAINS REPORT
--∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞ 
ALTER PROCEDURE [docme_transport].[get_maintanance_report]	

@apikey [varchar](100),
@vehicle_id int,
@maintaine_date date,
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
		 
                   select distinct(vsb.serrviceDate), vsb.*,vr.vehicleNum,sc.serviceCenterName,inv.INVOICE_DATE,inv.invoiceNum,inv.kmreading as invoice_kmreading,inv.DELIVERY_DATE,inv.sparparts_details,inv.acesories_details,inv.miscellaneous_details,inv.labourCharge,inv.otherDetails,inv.amountTotal,st.serviceType from docme_transport.tbl_vehicle_service_booking vsb
             left join docme_transport.tbl_vehicle_registration vr on vr.id = vsb.vehicleId
             left join docme_transport.tbl_servicecenter sc on sc.id = vsb.serviceCenterId
             left join docme_transport.tbl_invoice_service inv on inv.Servicedate = @maintaine_date
             left join docme_transport.tbl_servicetype st on st.id = vsb.serviceType
              where vsb.vehicleId = @vehicle_id and vsb.serrviceDate = @maintaine_date
	END
	ELSE
	BEGIN
		
                    select distinct(vsb.serrviceDate), vsb.*,vr.vehicleNum,sc.serviceCenterName,inv.INVOICE_DATE,inv.kmreading as invoice_kmreading,inv.invoiceNum,inv.DELIVERY_DATE,inv.sparparts_details,inv.acesories_details,inv.miscellaneous_details,inv.labourCharge,inv.otherDetails,inv.amountTotal,st.serviceType from docme_transport.tbl_vehicle_service_booking vsb
             left join docme_transport.tbl_vehicle_registration vr on vr.id = vsb.vehicleId
             left join docme_transport.tbl_servicecenter sc on sc.id = vsb.serviceCenterId
             left join docme_transport.tbl_invoice_service inv on inv.Servicedate = @maintaine_date
             left join docme_transport.tbl_servicetype st on st.id = vsb.serviceType
              where vsb.vehicleId = @vehicle_id and vsb.serrviceDate = @maintaine_date
    END
	
END







GO
