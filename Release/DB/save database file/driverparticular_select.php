SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
--∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞ Transport-DocMe ∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞                                                                              
-- Author      : Chandrajith
-- ALTER date : 06/11/2018
-- Description : For getting data regarding Spare parts
--∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞ 
ALTER PROCEDURE [docme_transport].[driverparticular_select]

@apikey [varchar](100),
@EMP_ID int
AS
BEGIN		
	SET NOCOUNT ON;
	DECLARE @precheck int, @user_id int = 0, @inst_id int = 0;	
	SET	@precheck = 0;
	SELECT @precheck = COUNT(id) FROM Auth.rest_keys WHERE Auth.rest_keys.api_key = @apikey AND Auth.rest_keys.isactive = 1
	 SELECT @user_id = userid FROM AUTH.rest_keys WHERE api_key = @apikey AND isactive = 1
	SELECT @inst_id = Inst_id FROM DBO.Employee_list WHERE Emp_id = @user_id

	IF @precheck = 0
	BEGIN
		SELECT 0 AS id, 1 AS ErrorStatus, 'Invalid / Expired API KEY' AS ErrorMessage
		RETURN
	END
	
	--  SELECT c.* FROM docme_transport.tbl_conductor c
	--  where c.id=@c_id
--     select * from  docme_transport.tbl_vehicle_driver_map vdm
-- left join dbo.PAY_EMPLOYEE_MASTER em on em.Emp_id = vdm.emp_id
-- left join docme_transport.tbl_vehicle_registration vrg on vrg.id = vdm.vehicle_id
--  WHERE vdm.vehicle_driver_map_id = @EMP_ID

select *,em.First_name,em.Middle_name,em.Last_name  from docme_transport.tbl_vehicle_registration vreg 
left join docme_transport.tbl_vehicle_driver_map vdm on vdm.vehicle_id = vreg.id and vdm.isactive = 1
left join dbo.PAY_EMPLOYEE_MASTER em on em.Emp_id = vdm.emp_id
where vreg.id = @EMP_ID AND  vreg.instId = @inst_id
    --  select * from  dbo.PAY_EMPLOYEE_MASTER em WHERE em.Emp_Id = @c_id
	 
	 
	
END




GO
