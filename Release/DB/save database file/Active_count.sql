SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		Shamna
-- Create date: 10- Oct - 2017
-- Description:	To get Count of Active field
-- =============================================
ALTER PROCEDURE [dbo].[Active_count]
@apikey [varchar](100)
AS
BEGIN		
	SET NOCOUNT ON;

	DECLARE @precheck int;
	SET	@precheck = 0;
	SELECT @precheck = COUNT(id) FROM Auth.rest_keys WHERE Auth.rest_keys.api_key = @apikey AND Auth.rest_keys.isactive = 1 and Auth.rest_keys.api_key != '525-777-777';
	IF @precheck = 0
	BEGIN
		SELECT 0 AS acd_id, 1 AS ErrorStatus, 'Invalid / Expired API KEY' AS ErrorMessage
		RETURN
	END
	SELECT(SELECT COUNT(country_id) FROM settings.tbl_country WHERE LEN(country_name) > 0 and isactive=1) AS Country,

	(SELECT COUNT(state_id) FROM settings.tbl_state WHERE LEN(state_name) > 0 and isactive=1) AS States,

	(SELECT COUNT(city_id) FROM settings.tbl_city WHERE LEN(city_name) > 0 AND isactive=1) AS City,

	(SELECT COUNT(religion_id) FROM settings.tbl_religion WHERE isactive=1) As Religion,

	(SELECT COUNT(caste_id) FROM settings.tbl_caste WHERE LEN(caste_name) > 0 AND isactive=1) AS Caste,

	(SELECT COUNT(community_id) FROM settings.tbl_community WHERE isactive=1) AS Community,

	(SELECT COUNT(currency_id) FROM settings.tbl_currency WHERE isactive=1) AS Currency,

	(SELECT COUNT(language_id) FROM settings.tbl_language WHERE LEN(language_name) > 0 and isactive=1) AS Languages,

	(SELECT COUNT(profession_id) FROM dbo.tbl_profession WHERE LEN(profession_name) > 0 and isactive=1) AS Profession

	
END
GO
