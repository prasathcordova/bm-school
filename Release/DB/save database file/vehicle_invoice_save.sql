SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

--∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞ Transport-DocMe ∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞                                                                              
-- Author      : Chandrajith
-- ALTER date : 06/11/2018
-- Description : For getting data regarding Service Invoice
--∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞ 
ALTER PROCEDURE [docme_transport].[vehicleInvoice__select]	

@apikey [varchar](100),
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
	
	

	  Select vsb.*,vr.vehicleNum,vr.schoolNum,sc.serviceCenterName,vt.vehicleTypeName from [docme_transport].tbl_vehicle_service_booking vsb
	  join [docme_transport].tbl_vehicle_registration vr
	  on vsb.vehicleId=vr.id
	  join [docme_transport].tbl_servicecenter sc
	   on vsb.serviceCenterId=sc.id
       join [docme_transport].tbl_vehicle_type vt on vt.id = vr.vehicleType
		 where vsb.instId=@inst_id  and vsb.isVehilceDelivered=0 and vsb.instId = @inst_id
	
END




GO
