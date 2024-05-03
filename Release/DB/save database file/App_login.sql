SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:	VINOTH
-- Create date: 05- Jun - 2017
-- Description:	To check user login
-- =============================================
ALTER PROCEDURE [Auth].[App_login]	
	@user_name [varchar](50),
	@user_passcode [varchar](250),
    @apikey varchar(250)

	-- @store_type INT = 0,
	-- @inst_id INT = 0
AS
BEGIN	
	SET NOCOUNT ON;
	DECLARE @user_status INT;
	DECLARE @checkuser INT = 0 ;
    

    SELECT  pem.Emp_Name,pem.Inst_id, @apikey As api_key FROM docme_transport.tbl_conductor tcnd
    left join dbo.Employee_list pem on pem.Emp_id = tcnd.conductor_name
	 WHERE tcnd.mobile_no = @user_name AND tcnd.[password] = @user_passcode AND tcnd.isActive = 1 

	SELECT @checkuser = Emp_id FROM dbo.Employee_list WHERE Mobile = @user_name
    IF @checkuser > 0
    BEGIN
    INSERT INTO Auth.rest_keys 
			([userid],
			[api_key],
			[date_created])
			VALUES
			(@checkuser,
			@apikey,
			SYSDATETIME());
         
    END	
END

GO
