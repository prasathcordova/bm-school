USE [DOCME_SCHOOL]
GO
/****** Object:  StoredProcedure [docme_fees].[fee_template_student_mapping]    Script Date: 03-09-2018 11:03:59 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

--∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞ Fees-DocMe ∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞                                                                              
-- Author      : Aju S Aravind
-- Create date : 31-08-2018
-- Description : For allocating periodic fees with student to the fee templates
--∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞ 
ALTER PROCEDURE [docme_fees].[fee_template_student_mapping] 	
	@apikey [varchar](100),	
	@inst_id int,
	@acd_year_id INT,
	@student_data_check varchar(MAX),
	@student_count INT,	
	@allocation_student_data VARCHAR(MAX),
	@template_id INT
	
AS
BEGIN	
    SET NOCOUNT ON;	
    DECLARE @precheck int;
    SET	@precheck = 0;
    SELECT @precheck = COUNT(id) FROM Auth.rest_keys WHERE Auth.rest_keys.api_key = @apikey AND Auth.rest_keys.isactive = 1 and Auth.rest_keys.api_key != '525-777-777';
    IF @precheck = 0
    BEGIN
        SELECT 0 AS id, 1 AS ErrorStatus, 'Invalid / Expired API KEY' AS ErrorMessage
        RETURN
    END
    Declare @id INT,@userid INT,@final_balance INT =0;
    SET @id = 0;
    DECLARE @precheck_status int, @Err_msg varchar(MAX)
    SELECT @userid = Auth.rest_keys.userid FROM Auth.rest_keys WHERE Auth.rest_keys.api_key = @apikey AND Auth.rest_keys.isactive = 1;
    --Check Students availability
    SET @precheck_status = 0;
    SELECT @precheck_status = COUNT(student_id) FROM dbo.student_master WHERE student_id IN (
    SELECT * FROM OPENJSON(@student_data_check)                   WITH (
                                    student_id int 'strict $.student_id'					
                            )
        ) AND isactive = 1 AND statusflag IN ('O','U','A') AND inst_id  = @inst_id
    IF @precheck_status <> @student_count
    BEGIN
        SELECT 0 AS id, 1 AS ErrorStatus, 'Please check if checked students are available for fee allocation and their status are in active state' AS ErrorMessage
        RETURN 
    END
    --Check Students availability
    SET @precheck_status = 0;
    DECLARE @student_list_for_check_non_availability VARCHAR(MAX)
    SELECT @precheck_status = COUNT(id) FROM [docme_fees].[tbl_template_with_student_map] WHERE student_id IN (SELECT * FROM OPENJSON(@student_data_check)
                            WITH (
                                    student_id int 'strict $.student_id'					
                            )) AND isactive = 1 AND acd_year_id = @acd_year_id
    IF @precheck_status > 0
    BEGIN
        SET @student_list_for_check_non_availability = (SELECT first_name FROM dbo.student_master WHERE student_id IN (
                SELECT student_id FROM [docme_fees].[tbl_template_with_student_map] WHERE student_id IN (SELECT * FROM OPENJSON(@student_data_check)
                        WITH (
                                student_id int 'strict $.student_id'					
                        )) AND isactive = 1 AND acd_year_id = @acd_year_id
        )  FOR JSON AUTO , INCLUDE_NULL_VALUES)
        SELECT 0 AS id, 5 AS ErrorStatus, 'Please check if checked students are already fee allocated' AS ErrorMessage, @student_list_for_check_non_availability as students_not_available
        RETURN 
    END
    DECLARE @pre_check2 INT= 0
    --Check if any students are being allocated fees
    SET @precheck_status = 0;
    SELECT @precheck_status = COUNT(id) FROM [docme_fees].[tbl_student_fee_template_allocation_status] WHERE student_id IN (SELECT * FROM OPENJSON(@student_data_check)
                            WITH (
                                    student_id int 'strict $.student_id'					
                            )) AND isactive = 1 AND inst_id = @inst_id AND acd_year_id = @acd_year_id AND is_allocation_started = 0
    SET @pre_check2 = 0;
    SELECT @pre_check2 = COUNT(id) FROM [docme_fees].[tbl_student_fee_template_allocation_status] WHERE student_id IN (SELECT * FROM OPENJSON(@student_data_check)
                            WITH (
                                    student_id int 'strict $.student_id'					
                            )) AND isactive = 1 AND inst_id = @inst_id AND acd_year_id = @acd_year_id AND is_allocation_started = 1	
    IF (@precheck_status <> @student_count) AND ((@precheck_status + @pre_check2) = @student_count)
    BEGIN
        SELECT 0 AS id, 2 AS ErrorStatus, 'Allocation of fees for one of the student is in progress. Please check again if all selected students are not fee allocated in this academic year' AS ErrorMessage
        RETURN 
    END
    --Set the notification that an allocation of the following students are going on
    UPDATE [docme_fees].[tbl_student_fee_template_allocation_status]
            SET is_allocation_started = 1  
    WHERE 
        student_id IN (SELECT * FROM OPENJSON(@student_data_check)
                        WITH (
                                student_id int 'strict $.student_id'					
                        )) 
        AND inst_id = @inst_id
        AND acd_year_id = @acd_year_id
        AND isactive = 1
    IF (@@ROWCOUNT = 0 )  
    BEGIN  
        INSERT INTO [docme_fees].[tbl_student_fee_template_allocation_status] (
                inst_id
                ,student_id
                ,acd_year_id
                ,is_allocation_started
                ,createdby
                ,createdon
        ) 
        SELECT
                inst_id
                ,student_id
                ,@acd_year_id
                ,1
                ,@userid
                ,SYSDATETIME()
        FROM dbo.student_master
        WHERE student_id IN (SELECT * FROM OPENJSON(@student_data_check)
                        WITH (
                                student_id int 'strict $.student_id'					
                        ))
        if @@IDENTITY <= 0
        BEGIN
                SELECT 0 AS id, 3 AS ErrorStatus, 'Allocation failed as the student notification failed  to work as expected' AS ErrorMessage
                RETURN 
        END			
    END 
    DECLARE @account_master_id INT =0, @account_details_id INT = 0
    --Starting the transaction for fee allocation
    BEGIN TRANSACTION;
        SAVE TRANSACTION template_allocation_point
        BEGIN TRY
            DECLARE @student_id INT,
                    @demand_type INT,
                    @fee_code_id INT,
                    @demand_amount FLOAT,
                    @demand_date DATE,
                    @arrear_date DATE,
                    @demanded_month VARCHAR(30),
                    @transaction_desc VARCHAR(MAX),
                    @allocation_master_id INT
            DELETE FROM [docme_fees].[tbl_template_with_student_map] WHERE student_id IN (SELECT * FROM OPENJSON(@student_data_check)
            WITH (
                    student_id int 'strict $.student_id'					
            )) AND inst_id = @inst_id AND acd_year_id = @acd_year_id
            INSERT INTO [docme_fees].[tbl_template_with_student_map]
                                    ([inst_id]
                                    ,[template_id]
                                    ,[student_id]
                                    ,[acd_year_id]
                                    ,[createdby]
                                    ,[createdon])						
                            SELECT @inst_id,@template_id,student_id,@acd_year_id,@userid,SYSDATETIME() FROM OPENJSON(@student_data_check)
            WITH (
                    student_id int 'strict $.student_id'					
            )
            INSERT INTO [docme_fees].[tbl_student_template_allocation_master]
                       ([student_id]
                       ,[acd_year_id]
                       ,[template_id]
                       ,[allocated_on]
                       ,[allocated_by]										   					   
                       ,[createdby]
                       ,[createdon]
                       )
            SELECT student_id,@acd_year_id,@template_id,SYSDATETIME(),@userid,@userid,SYSDATETIME() FROM OPENJSON(@student_data_check)
            WITH (
                    student_id int 'strict $.student_id'					
            )
            DECLARE allocation_cursor CURSOR LOCAL FOR 
                    SELECT * FROM OPENJSON(@allocation_student_data)
                    WITH (
                            student_id int 'strict $.student_id',
                            demand_type int '$.demand_type',
                            fee_code_id int '$.fee_code_id',
                            demand_amount float '$.demand_amount',
                            demand_arrear_date date '$.demand_arrear_date',
                            demanded_date date '$.demanded_date',
                            demanded_month varchar(30) '$.demanded_month',
                            transaction_desc varchar(max) '$.transaction_desc'			
                    )
            OPEN allocation_cursor 
            FETCH NEXT FROM allocation_cursor INTO	
                    @student_id
                    ,@demand_type
                    ,@fee_code_id
                    ,@demand_amount
                    ,@demand_date
                    ,@arrear_date				
                    ,@demanded_month
                    ,@transaction_desc				
            WHILE @@FETCH_STATUS = 0
            BEGIN
                SELECT @allocation_master_id = id FROM [docme_fees].[tbl_student_template_allocation_master]
                WHERE
                   student_id = @student_id AND acd_year_id = @acd_year_id AND template_id = @template_id
                INSERT INTO [docme_fees].[tbl_student_template_allocation_details]
                   ([inst_id]
                   ,[student_id]
                   ,[demand_type]
                   ,[allocation_master_id]
                   ,[is_template]
                   ,[template_id]
                   ,[status_id]
                   ,[fee_code_id]				   
                   ,[demand_amount]				   
                   ,[final_payable_amount]
                   ,[demand_arrear_date]
                   ,[demanded_month]				   
                   ,[demanded_by]
                   ,[demanded_on]				   
                   ,[pending_payment]				   
                   ,[createdby]
                   ,[createdon]
                   )
                VALUES (
                        @inst_id
                        ,@student_id
                        ,@demand_type
                        ,@allocation_master_id
                        ,1
                        ,@template_id
                        ,1
                        ,@fee_code_id
                        ,@demand_amount		
                        ,@demand_amount			
                        ,@arrear_date
                        ,@demanded_month
                        ,@userid
                        ,@demand_date
                        ,@demand_amount
                        ,@userid
                        ,SYSDATETIME()
                )
                INSERT INTO [docme_fees].[tbl_student_account]
                   ([transaction_type]
                   ,[transaction_desc]
                   ,[transaction_amount]          
                   ,[is_demand]
                   ,[remarks]
                   ,[is_clear_balance]          
                   ,[createdby]
                   ,[createdon]  
                   ,[is_template_enabled_transaction]
                   ,[template_id])
                VALUES
                (
                    2000
                   ,@transaction_desc
                   ,@demand_amount           
                   ,1
                   ,@transaction_desc
                   ,1         
                   ,@userid
                   ,SYSDATETIME() 
                   ,1
                   ,@template_id
                )
                SET @account_master_id = @@IDENTITY
                SET @precheck_status = 0;
                SELECT @precheck_status = 0, @final_balance = final_balance FROM [docme_fees].[tbl_student_account_balance_summary] WHERE student_id = @student_id AND isactive = 1
                IF @precheck_status = 0
                BEGIN
                    INSERT INTO [docme_fees].[tbl_student_account_balance_summary]
                            ([student_id]
                            ,[master_id]
                            ,[final_balance]
                            ,[is_locked]						
                            ,[createdby]
                            ,[createdon])
                    VALUES
                            (@student_id
                            ,@account_master_id
                            ,@demand_amount
                            ,0
                            ,@userid
                            ,SYSDATETIME()
                            )
                END
                ELSE
                BEGIN
                    SET @final_balance = @final_balance + @demand_amount
                    UPDATE [docme_fees].[tbl_student_account_balance_summary]
                            SET isactive = 0
                    WHERE student_id = @student_id 
                    INSERT INTO [docme_fees].[tbl_student_account_balance_summary]
                            ([student_id]
                            ,[master_id]
                            ,[final_balance]
                            ,[is_locked]						
                            ,[createdby]
                            ,[createdon])
                    VALUES
                            (@student_id
                            ,@account_master_id
                            ,@final_balance
                            ,0
                            ,@userid
                            ,SYSDATETIME()
                            )
                END
                SET @precheck_status = 0;
                SET @account_details_id =0;
                SELECT @precheck_status =1, @account_details_id = id FROM [docme_fees].[tbl_student_balance_details] WHERE student_id = @student_id AND isactive = 1
                IF @precheck_status = 0
                BEGIN
                    INSERT INTO [docme_fees].[tbl_student_balance_details]
                       (
                       [master_id]
                       ,[student_id]
                       ,[acd_year_id]
                       ,[demanded_fees]						  
                       ,[final_balance]						  
                       ,[created_by]
                       ,[created_on]
                       )
                    VALUES
                    (
                        @account_master_id
                        ,@student_id
                        ,@acd_year_id
                        ,@demand_amount
                        ,@demand_amount
                        ,@userid
                        ,SYSDATETIME()
                    )
                END
                ELSE
                BEGIN
                    UPDATE [docme_fees].[tbl_student_balance_details]
                    SET isactive = 0 , modified_reason ='Deactivated record for new fee demand'
                    WHERE id =@account_details_id AND student_id = @student_id
                    IF @demand_type = 1
                    BEGIN
                        INSERT INTO [docme_fees].[tbl_student_balance_details]
                           ([master_id]
                           ,[student_id]
                           ,[acd_year_id]
                           ,[demanded_fees]
                           ,[non_demanded_fees]
                           ,[family_concession]
                           ,[staff_concession]
                           ,[excemption]
                           ,[payments]
                           ,[e_wallet]
                           ,[final_balance]									  
                           ,[created_by]
                           ,[created_on]
                           )								
                        SELECT 
                                  @account_master_id
                                  ,@student_id
                                  ,@acd_year_id
                                  ,(@demand_amount + [demanded_fees])
                                  ,[non_demanded_fees]
                                  ,[family_concession]
                                  ,[staff_concession]
                                  ,[excemption]
                                  ,[payments]
                                  ,[e_wallet]
                                  ,([final_balance]	+ [demanded_fees] )
                                  ,@userid
                                  ,SYSDATETIME()
                        FROM [docme_fees].[tbl_student_balance_details]	
                    END
                    ELSE IF @demand_type = 2
                    BEGIN
                        INSERT INTO [docme_fees].[tbl_student_balance_details]
                           ([master_id]
                           ,[student_id]
                           ,[acd_year_id]
                           ,[demanded_fees]
                           ,[non_demanded_fees]
                           ,[family_concession]
                           ,[staff_concession]
                           ,[excemption]
                           ,[payments]
                           ,[e_wallet]
                           ,[final_balance]									  
                           ,[created_by]
                           ,[created_on]
                           )								
                        SELECT 
                          @account_master_id
                          ,@student_id
                          ,@acd_year_id
                          ,[demanded_fees]
                          ,([non_demanded_fees] + @demand_amount )
                          ,[family_concession]
                          ,[staff_concession]
                          ,[excemption]
                          ,[payments]
                          ,[e_wallet]
                          ,([final_balance]	+ [demanded_fees] )
                          ,@userid
                          ,SYSDATETIME()
                        FROM [docme_fees].[tbl_student_balance_details]
                    END
                END
                FETCH NEXT FROM allocation_cursor INTO	
                        @student_id
                        ,@demand_type
                        ,@fee_code_id
                        ,@demand_amount
                        ,@demand_date
                        ,@arrear_date				
                        ,@demanded_month
                        ,@transaction_desc	
            END
            CLOSE allocation_cursor ;
            DEALLOCATE allocation_cursor ;	
            SET @id = 1
        END TRY		
        BEGIN CATCH

                IF @@TRANCOUNT > 0
                BEGIN	
                        SET @id = 0		
                        ROLLBACK TRANSACTION template_allocation_point; -- rollback to MySavePointitem
                        SELECT @Err_msg = ERROR_MESSAGE()
                        SELECT 0 AS status, 1 AS error_status,'Rollbacked data updation' as ErrorMessage,ERROR_MESSAGE() AS MSG
                        RETURN					
                END
        END CATCH
    COMMIT TRANSACTION
    --Set the notification that an allocation of the following students are going on
    UPDATE [docme_fees].[tbl_student_fee_template_allocation_status]
        SET is_allocation_started = 0  
    WHERE 
        student_id IN (SELECT * FROM OPENJSON(@student_data_check)
                            WITH (
                                    student_id int 'strict $.student_id'					
                            )) 
        AND inst_id = @inst_id
        AND acd_year_id = @acd_year_id
        AND isactive = 1
    IF @id > 0
    BEGIN
        SELECT @id AS id, 0 AS ErrorStatus, '' AS ErrorMessage
    END
    ELSE
    BEGIN
        SELECT 0 AS id, 1 AS ErrorStatus, 'Unknown Error' AS ErrorMessage
    END  
END


