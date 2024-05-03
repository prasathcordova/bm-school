SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
--∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞ Transport-DocMe ∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞                                                                              
-- Author      : Chandrajith
-- Create date : 06/11/2018
-- Description : For inserting data regarding Vehicle Service Invoice
--∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞ 
ALTER PROCEDURE [docme_transport].[vehicleserviceinvoicedetails_Save] 	
	@apikey [varchar](100),
	@vehicleservicedetails_json_data varchar(MAX),
     @inst_id INT,
    @spareinvoice_details varchar(max),
    @acesories_details VARCHAR(MAX),
    @miscellaneous_details varchar(max)
	
AS
BEGIN
	SET NOCOUNT ON;	
	DECLARE @precheck int, @Err_msg varchar(mAX)
	SET	@precheck = 0;
	SELECT @precheck = COUNT(id) FROM Auth.rest_keys WHERE Auth.rest_keys.api_key = @apikey AND Auth.rest_keys.isactive = 1 and Auth.rest_keys.api_key != '525-777-777';
	IF @precheck = 0
	BEGIN
		SELECT 0 AS id, 1 AS ErrorStatus, 'Invalid / Expired API KEY' AS ErrorMessage
		RETURN
	END
	Declare @id INT, @userid INT;
	SET @id = 0;
	--DECLARE @precheck_status int;
	--SET @precheck_status = 0;
	--SELECT @precheck_status = COUNT(id) FROM [docme_fees].tbl_fee_allocation_template_master WHERE template_name=@template_name AND [inst_id] = @inst_id
	--IF @precheck_status > 0
--	BEGIN
---		SELECT 0 AS id, 1 AS ErrorStatus, 'Fee Template Name Already Exists' AS ErrorMessage
	--	RETURN 
	--END
	
	SELECT @userid = Auth.rest_keys.userid FROM Auth.rest_keys WHERE Auth.rest_keys.api_key = @apikey AND Auth.rest_keys.isactive = 1;
		
	BEGIN TRANSACTION;
		SAVE TRANSACTION MySavePointreject;
		BEGIN TRY	
            INSERT INTO [docme_transport].[tbl_invoice_service] (
			   ServiceBookingId,
					 vehicleId,
					 vehicleNum,
					 ServiceCenterId,
					 ServiceCenter,
					 invoiceNum,
					 sparesChanged,
					 acesoriesChanged,
					 otherDetails,
					 labourCharge,	
					 amountTotal,								
                      invoiceuplodefile,
                      kmreading,
                      Servicedate,
                    INVOICE_DATE,
                    DELIVERY_DATE,
                     instId,
                     isActive,
					 createdOn,
					 createdBy,
                     sparparts_details,
                     acesories_details,
                     miscellaneous_details
                     
			  )
			  SELECT *,@inst_id as instId,1 as isActive,SYSDATETIME() as createdOn, @userid as createdBy,@spareinvoice_details as sparparts_details, @acesories_details as acesories_details, @miscellaneous_details as miscellaneous_details FROM OPENJSON(@vehicleservicedetails_json_data)
				WITH (
					 ServiceBookingId int '$.servicebookingid',
					 vehicleId int '$.vehicleid',
					 vehicleNum varchar(150) '$.vehiclenum',
					 ServiceCenterId int '$.servicecenter_id',
					 ServiceCenter varchar(max) '$.servicecenter',
					 invoiceNum varchar(155) '$.invoice_num',
					 sparesChanged varchar(MAX) '$.spares',
					 acesoriesChanged varchar(MAX) '$.acessories',
					 otherDetails varchar(MAX) '$.other_charge',
					 labourCharge float '$.labour_chrge',
				     amountTotal float '$.amt_total',
                     invoiceuplodefile VARCHAR(max)	'$.invoicefile',
                     kmreading FLOAT '$.kmreading',
                     Servicedate date '$.service_date',
                     INVOICE_DATE date '$.invoice_date',
                     DELIVERY_DATE date '$.delivery_date'

				)
				 SET @id = @@IDENTITY;
				 UPDATE [docme_transport].tbl_vehicle_service_booking SET  isVehilceDelivered=1,isActive=0 WHERE  id IN (SELECT id FROM OPENJSON(@vehicleservicedetails_json_data) WITH (id int 'strict $.servicebookingid'))
		END TRY	
		BEGIN CATCH
				IF @@TRANCOUNT > 0
				BEGIN			
					ROLLBACK TRANSACTION MySavePointreject; -- rollback to MySavePointitem
						SELECT @Err_msg = ERROR_MESSAGE()
						SELECT 0 AS status, 1 AS error_status,'Rollbacked data updation' as ErrorMessage,ERROR_MESSAGE() AS MSG
						RETURN					
				END
		END CATCH

		COMMIT TRANSACTION	
			IF @id > 0
			BEGIN
				SELECT @id AS id, 0 AS ErrorStatus, '' AS ErrorMessage
			END
			ELSE
			BEGIN
				SELECT 0 AS id, 1 AS ErrorStatus, 'Unknown Error' AS ErrorMessage
			END  
END










GO
