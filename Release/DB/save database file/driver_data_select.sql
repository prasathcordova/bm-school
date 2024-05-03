SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
--∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞ Transport-DocMe ∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞                                                                              
-- Author      : Chandrajith
-- ALTER date : 18/03/2019
-- Description : For getting data regarding Vendor Details
--∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞ 
ALTER PROCEDURE [docme_transport].[driver_data_select]	
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
	
	BEGIN
-- select * from  docme_transport.tbl_vehicle_driver_map vdm 
-- left join dbo.PAY_EMPLOYEE_MASTER pem on pem.Emp_id = vdm.emp_id
-- left join docme_transport.tbl_vehicle_registration vrg on vrg.id = vdm.vehicle_id
-- where vdm.inst_id=@inst_id
select *,em.First_name,em.Middle_name,em.Last_name  from docme_transport.tbl_vehicle_registration vreg 
left join docme_transport.tbl_vehicle_driver_map vdm on vdm.vehicle_id = vreg.id and vdm.isactive = 1
left join dbo.PAY_EMPLOYEE_MASTER em on em.Emp_id = vdm.emp_id
where vreg.instId = @inst_id and vreg.isActive = 1
	END
	
END






GO
