SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		  AJU S ARAVIND
-- Create date: 21-10-2017
-- Description:	To get the Student Report Class Divisionwise
-- =============================================
ALTER PROCEDURE [dbo].[Rpt_class_divisnwise] 
	-- Add the parameters for the stored procedure here
	@apikey [varchar](100),
	@acdyear int,
	@classs [varchar](100),
	@div_id [varchar](10),
	@Dt Datetime,
    @tD Datetime  
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
    	
	SET NOCOUNT ON;	
	DECLARE @precheck INT;
	SET	@precheck = 0;
	SELECT @precheck = COUNT(id) FROM Auth.rest_keys WHERE Auth.rest_keys.api_key = @apikey AND Auth.rest_keys.isactive = 1 and Auth.rest_keys.api_key != '525-777-777';
	IF @precheck = 0
	BEGIN
	SELECT 0 AS id, 1 AS ErrorStatus, 'Invalid / Expired API KEY' AS ErrorMessage
		RETURN
	END

	DECLARE @USER_ID INT =0, 
	@INST_ID INT =0

	SELECT @USER_ID = userid FROM AUTH.rest_keys WHERE api_key = @apikey AND isactive = 1
	SELECT @INST_ID = Inst_id FROM DBO.Employee_list WHERE Emp_id = @USER_ID

	
	IF @classs = 'ALL' AND @Dt IS NOT NULL AND @tD IS NOT NULL
		BEGIN
			SELECT  cl.Description as Class , ISNULL(b.Division,'') as division,s.Admn_No,UPPER(ISNULL(s.First_Name, '')) + CASE WHEN S.First_Name IS NULL THEN ''
					WHEN S.First_Name = '' THEN '' ELSE ' ' END + ISNULL(UPPER(s.Middle_Name), '') 
					+ CASE WHEN S.middle_name IS NULL THEN '' WHEN S.middle_name = '' THEN '' 
					ELSE ' ' END + ISNULL(UPPER(s.Last_Name), '') AS student_name,acd.Description,cl.Course_Det_ID AS Class_ID,b.BatchID
				FROM  [dbo].[Student_Master] s 
				LEFT JOIN [dbo].Course_Details cl ON (s.Cur_Class = cl.Course_Det_ID)
				LEFT JOIN [dbo].[Batch_Details] b ON (s.Cur_Batch  = b.BatchID ) 
				LEFT JOIN [dbo].[AcdYear_Master] acd ON s.Cur_AcadYr  = acd.Acd_ID 
				LEFT JOIN settings.Student_Reg_Details SDR ON S.student_id=SDR.Student_Id
				 WHERE Cur_AcadYr = @acdyear AND  
				 --cl.Description = @classs AND
				CONVERT(DATE,CAST(SDR.Admission_Date AS DATE),112) >= CONVERT(DATE,CAST(@Dt AS DATE),112) 
                AND CONVERT(DATE,CAST(SDR.Admission_Date AS DATE),112) <= CONVERT(DATE,CAST(@tD AS DATE),112)
				AND S.Inst_ID =@INST_ID AND s.statusFlag IN ('L','D','P','R','O','U' )
				ORDER BY cl.sort_order,b.Division,S.First_Name
		END
	ELSE IF @classs = 'ALL' and @div_id = 3000
		BEGIN
			SELECT  cl.Description as Class ,ISNULL(b.Division,'') as division,s.Admn_No,UPPER(ISNULL(s.First_Name, '')) + CASE WHEN S.First_Name IS NULL THEN ''
					WHEN S.First_Name = '' THEN '' ELSE ' ' END + ISNULL(UPPER(s.Middle_Name), '') 
					+ CASE WHEN S.middle_name IS NULL THEN '' WHEN S.middle_name = '' THEN '' 
					ELSE ' ' END + ISNULL(UPPER(s.Last_Name), '') AS student_name,acd.Description,cl.Course_Det_ID AS Class_ID,b.BatchID
				FROM  [dbo].[Student_Master] s 
				LEFT JOIN [dbo].Course_Details cl ON (s.Cur_Class = cl.Course_Det_ID)
				LEFT JOIN [dbo].[Batch_Details] b ON (s.Cur_Batch  = b.BatchID )  
				LEFT JOIN [dbo].[AcdYear_Master] acd ON s.Cur_AcadYr  = acd.Acd_ID 
				WHERE Cur_AcadYr = @acdyear 
				--AND  cl.Description = @classs 
				AND S.Inst_ID = @INST_ID AND s.statusFlag IN ('L','D','P','R','O','U' )
				ORDER BY  cl.sort_order,b.Division,S.First_Name
		END
    ELSE IF @classs IS NOT NULL  and @div_id IS NOT NULL 
		BEGIN
			SELECT  cl.Description as Class ,ISNULL(b.Division,'') as division,s.Admn_No,UPPER(ISNULL(s.First_Name, '')) + CASE WHEN S.First_Name IS NULL THEN ''
					WHEN S.First_Name = '' THEN '' ELSE ' ' END + ISNULL(UPPER(s.Middle_Name), '') 
					+ CASE WHEN S.middle_name IS NULL THEN '' WHEN S.middle_name = '' THEN '' 
					ELSE ' ' END + ISNULL(UPPER(s.Last_Name), '') AS student_name,acd.Description,cl.Course_Det_ID AS Class_ID,b.BatchID
				FROM  [dbo].[Student_Master] s 
				LEFT JOIN [dbo].Course_Details cl ON (s.Cur_Class = cl.Course_Det_ID)
				LEFT JOIN [dbo].[Batch_Details] b ON (s.Cur_Batch  = b.BatchID )  
				LEFT JOIN [dbo].[AcdYear_Master] acd ON s.Cur_AcadYr  = acd.Acd_ID 
				WHERE Cur_AcadYr = @acdyear 
				AND  cl.Description = @classs 
                AND  b.BatchID = @div_id
				AND S.Inst_ID = @INST_ID AND s.statusFlag IN ('L','D','P','R','O','U' )
				ORDER BY  cl.sort_order,b.Division,S.First_Name
		END
	ELSE
		BEGIN
			SELECT  cl.Description as Class ,ISNULL(b.Division,'') as division,s.Admn_No,UPPER(ISNULL(s.First_Name, '')) + CASE WHEN S.First_Name IS NULL THEN ''
					WHEN S.First_Name = '' THEN '' ELSE ' ' END + ISNULL(UPPER(s.Middle_Name), '') 
					+ CASE WHEN S.middle_name IS NULL THEN '' WHEN S.middle_name = '' THEN '' 
					ELSE ' ' END + ISNULL(UPPER(s.Last_Name), '') AS student_name,acd.Description,cl.Course_Det_ID AS Class_ID,b.BatchID
				FROM  [dbo].[Student_Master] s 
				LEFT JOIN [dbo].Course_Details cl ON (s.Cur_Class = cl.Course_Det_ID)
				LEFT JOIN [dbo].[Batch_Details] b ON (s.Cur_Batch  = b.BatchID )  
				LEFT JOIN [dbo].[AcdYear_Master] acd ON s.Cur_AcadYr  = acd.Acd_ID 
				WHERE Cur_AcadYr = @acdyear AND  cl.Description = @classs AND S.Inst_ID = @INST_ID AND s.statusFlag IN ('L','D','P','R','O','U' )
				ORDER BY  cl.sort_order,b.Division,S.First_Name
		
		END
	
	
END






GO
