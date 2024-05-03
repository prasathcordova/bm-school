SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		Saranya kumar G
-- Create date: 21-sept-2017
-- Description:	To get student details for parent info
-- =============================================
ALTER PROCEDURE [settings].[Studentparentdetails_select_profile]
@apikey [varchar](100),
@s_id int

AS
BEGIN		
	SET NOCOUNT ON;	
	DECLARE @precheck INT;
	SET	@precheck = 0;
	SELECT @precheck = COUNT(id) FROM Auth.rest_keys WHERE Auth.rest_keys.api_key = @apikey AND Auth.rest_keys.isactive = 1 and Auth.rest_keys.api_key != '525-777-777';
	IF @precheck = 0
	BEGIN
		SELECT 0 AS id, 1 AS ErrorStatus, 'Invalid / Expired API KEY' AS ErrorMessage
		RETURN
	END
	 SELECT DISTINCT 
                         s.Admn_No,s.student_id, UPPER(ISNULL(s.First_Name, '')) + CASE WHEN S.First_Name IS NULL THEN '' WHEN S.First_Name = '' THEN '' ELSE ' ' END + ISNULL(UPPER(s.Middle_Name), '') 
                         + CASE WHEN S.middle_name IS NULL THEN '' WHEN S.middle_name = '' THEN '' ELSE ' ' END + ISNULL(UPPER(s.Last_Name), '') AS student_name,
						 p.Parent_ID as father_id,
						 p.Parent_Name   AS Father,p.Adhar_No as f_adhar,a.Address1 AS F_C_address1, a.Address2 AS F_C_address2,a.Address3 AS F_C_address3 , a.PO_No AS F_C_ZIP_CODE,a.Phone1 AS F_C_Phone1,a.email AS Email,a.Phone3 AS F_C_Phone3,
						                           a1.Address1 AS F_O_address1, a1.Address2 AS F_O_address2,a1.Address3 AS F_O_address3 ,a1.PO_No AS F_O_ZIP_CODE,a1.Phone1 AS F_O_Phone1,a1.email AS OEmail,a1.Phone3 AS F_O_Phone3, 
												   a2.Address1 AS F_H_address1, a2.Address2 AS F_H_address2,a2.Address3 AS F_H_address3 ,a2.PO_No AS F_H_ZIP_CODE,a2.Phone1 AS F_H_Phone1,a2.email AS HEmail,a2.Phone3 AS F_H_Phone3,
						                            n.profession_name AS F_profession,n.profession_id AS F_profession_id,
						 q.Parent_ID as mother_id,
						 q.Parent_Name  AS  Mother,q.Adhar_No as m_adhar,a3.Address1 AS M_C_address1, a3.Address2 AS M_C_address2,a3.Address3 AS M_C_address3 ,a3.PO_No AS M_C_ZIP_CODE,a3.Phone1 AS  M_C_Phone1,a3.email AS  M_C_Email,a3.Phone3 AS  M_C_Phone3,
						                           a4.Address1 AS M_O_address1, a4.Address2 AS M_O_address2,a4.Address3 AS M_O_address3 ,a4.PO_No AS M_O_ZIP_CODE,a4.Phone1 AS M_O_Phone1,a4.email AS M_O_Email,a4.Phone3 AS M_O_Phone3,
												   a5.Address1 AS M_H_address1, a5.Address2 AS M_H_address2,a5.Address3 AS M_H_address3 ,a5.PO_No AS M_H_ZIP_CODE,a5.Phone1 AS M_H_Phone1,a5.email AS M_H_Email,a5.Phone3 AS M_H_Phone3,
												   m.profession_name AS M_profession,m.profession_id AS M_profession_id,
                         w.Parent_ID as guardian_id,
						 w.Parent_Name  AS  Guardian,w.Gender,w.Adhar_No as g_adhar,o.profession_name AS G_profession,o.profession_id AS G_profession_id,a6.Address1 AS G_C_address1, a6.Address2 AS G_C_address2,a6.Address3 AS G_C_address3 ,a6.PO_No AS G_C_ZIP_CODE,a6.Phone1 AS G_C_Phone1,a6.email AS G_C_Email,a6.Phone3 AS G_C_Phone3,
						                           a7.Address1 AS G_O_address1, a7.Address2 AS G_O_address2,a7.Address3 AS G_O_address3 ,a7.PO_No AS G_O_ZIP_CODE,a7.Phone1 AS G_O_Phone1,a7.email AS G_O_Email,a7.Phone3 AS G_O_Phone3, 
												   a8.Address1 AS G_H_address1, a8.Address2 AS G_H_address2,a8.Address3 AS G_H_address3 ,a8.PO_No AS G_H_ZIP_CODE,a8.Phone1 AS G_H_Phone1,a8.email AS G_H_Email,a8.Phone3 AS G_H_Phone3
						                           
						 
						 FROM            dbo.[Stud_Parent_Relations]   AS C LEFT OUTER JOIN
						 [dbo].[Student_Master] AS s ON s.student_id = C.student_id LEFT OUTER JOIN
                         dbo.[Stud_Parent_Relations] AS spr ON C.student_id = spr.student_id AND spr.Relation = 'F' LEFT OUTER JOIN
                         [dbo].[Parent_Master] AS p ON p.Parent_ID = spr.Parent_Id AND spr.Relation = 'F' LEFT OUTER JOIN
						 dbo.[Stud_Parent_Relations] AS sprt ON C.student_id = sprt.student_id AND sprt.Relation = 'M' LEFT OUTER JOIN
                         [dbo].[Parent_Master] AS q ON q.Parent_ID = sprt.Parent_Id AND sprt.Relation = 'M'  LEFT OUTER JOIN
						 dbo.[Stud_Parent_Relations] AS sprtg ON C.student_id = sprtg.student_id AND sprtg.Relation = 'G' AND sprtg.Parent_Id <> 0 LEFT OUTER JOIN
                         [dbo].[Parent_Master] AS w ON w.Parent_ID = sprtg.Parent_Id AND sprtg.Relation = 'G'  LEFT OUTER JOIN
						 dbo.[Address_Master] AS a ON a.Parent_ID = p.Parent_ID AND a.Address_Type = 1 AND a.isactive = 1 LEFT OUTER JOIN
						 dbo.[Address_Master] AS a1 ON a1.Parent_ID = p.Parent_ID AND a1.Address_Type = 2 AND  a.isactive = 1  LEFT OUTER JOIN
						 dbo.[Address_Master] AS a2 ON a2.Parent_ID = p.Parent_ID AND a2.Address_Type = 3 AND  a.isactive = 1 LEFT OUTER JOIN
						 dbo.[Address_Master] AS a3 ON a3.Parent_ID = q.Parent_ID AND a3.Address_Type = 1 AND  a.isactive = 1 LEFT OUTER JOIN
						 dbo.[Address_Master] AS a4 ON a4.Parent_ID = q.Parent_ID AND a4.Address_Type = 2  AND  a.isactive = 1  LEFT OUTER JOIN
						 dbo.[Address_Master] AS a5 ON a5.Parent_ID = q.Parent_ID AND a5.Address_Type = 3  AND  a.isactive = 1  LEFT OUTER JOIN
						 dbo.[Address_Master] AS a6 ON a6.Parent_ID = w.Parent_ID AND a6.Address_Type = 1 AND  a.isactive = 1  LEFT OUTER JOIN
						 dbo.[Address_Master] AS a7 ON a7.Parent_ID = w.Parent_ID AND a7.Address_Type = 2  AND  a.isactive = 1  LEFT OUTER JOIN
						 dbo.[Address_Master] AS a8 ON a8.Parent_ID = w.Parent_ID AND a8.Address_Type = 3 AND  a.isactive = 1 LEFT OUTER JOIN
						 dbo.[tbl_profession] AS m ON q.profession = m.profession_id LEFT OUTER JOIN
						 dbo.[tbl_profession] AS o ON w.profession = o.profession_id LEFT OUTER JOIN
						 dbo.[tbl_profession] AS n ON p.Profession = n.Profession_ID 
						
						  WHERE C.Student_Id = @s_id
						 

        
END

GO
