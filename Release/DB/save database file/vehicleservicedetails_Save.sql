SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

--∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞ Transport-DocMe ∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞                                                                              
-- Author      : Chandrajith
-- Create date : 28/08/2018
-- Description : For inserting data regarding Vehicle Service Booking
--∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞∞ 
ALTER PROCEDURE [docme_transport].[vehicleservicedetails_Save] 	
	@apikey [varchar](100),
	@vehicleservicedetails_json_data varchar(MAX),		
	@inst_id INT
	
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
	Declare @id INT, 
			@userid INT;
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


			Insert into [docme_transport].[tbl_vehicle_service_booking]
		            (vehicleId,
					 serviceCenterId,
					 serviceAdvisorName,
					 serviceAdvisorContactNum,
					 serviceType,
					 serrviceDate,
					 expectedDeliveryDate,
					 additionalInfo,
					 customerName,
					 customerContactNum,
                     kmreading,									
					 instId,
					 createdOn,
					 createdBy
					)

			  SELECT *,@inst_id as instId,SYSDATETIME() as createdOn,@userid as createdBy FROM OPENJSON(@vehicleservicedetails_json_data)
				WITH (

				      vehicleId int '$.vehicleselect',
					 serviceCenterId int '$.servicecenter_select',
					 serviceAdvisorName varchar(250) '$.cperson',
					 serviceAdvisorContactNum varchar(50) '$.c_num',
					 serviceType int '$.serv_type',
					 serrviceDate date '$.booking_date',
					 expectedDeliveryDate date '$.expecteddelivery_date',
					 additionalInfo varchar(MAX) '$.addition_info',
					 customerName varchar(50) '$.cust_name',
					 customerContactNum varchar(50) '$.cust_cnum',
                     kmreading FLOAT '$.km_reding'
				    
					 
					 
				)

				  
					SET @id=@@IDENTITY;

					--INSERT INTO [docme_fees].[tbl_template_with_class_map] (
				--	[template_id]
				--	,[linked_class_detail_id]			
				--	,[createdby]
				--	,[createdon]
				--)
				----SELECT @id,class_detail_id,@userid as createdby,SYSDATETIME() as createdon FROM OPENJSON(@template_class_data)
				--WITH (
				--	class_detail_id int 'strict $.class_detail_id'			
				--)
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
