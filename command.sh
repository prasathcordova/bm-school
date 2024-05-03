mkdir Docme-UI/bill
mkdir Docme-UI/reports
mkdir Docme-UI/reports/maintenance_report
mkdir Docme-UI/reports/online-registration
mkdir Docme-UI/reports/online-registration/5
mkdir Docme-UI/reports/online-registration/8
mkdir Docme-UI/reports/online-registration/20
mkdir Docme-UI/reports/qr_code
mkdir Docme-UI/student_profiles
mkdir Docme-UI/uploads
mkdir Docme-UI/assets/Uploads
mkdir Docme-UI/assets/Uploads/documents
mkdir Docme-UI/docme/cache
mkdir Docme-UI/docme/logs

mkdir Portal/webapp/libraries/merchant/log
mkdir Portal/webapp/cache
mkdir Portal/webapp/logs
mkdir Portal/bill
mkdir Portal/bill/online-payment


mkdir api/Uploads
mkdir api/Uploads/temp
mkdir api/apicore/cache
mkdir api/apicore/logs

find Docme-UI -type f -exec chmod 644 {} \;
find Docme-UI -type d -exec chmod 755 {} \;

find Portal -type f -exec chmod 644 {} \;
find Portal -type d -exec chmod 755 {} \;

find api -type f -exec chmod 644 {} \;
find api -type d -exec chmod 755 {} \;

chmod -R 777 Docme-UI/bill
chmod -R 777 Docme-UI/reports
chmod -R 777 Docme-UI/reports/maintenance_report
chmod -R 777 Docme-UI/reports/online-registration
chmod -R 777 Docme-UI/reports/online-registration/5
chmod -R 777 Docme-UI/reports/online-registration/8
chmod -R 777 Docme-UI/reports/online-registration/20
chmod -R 777 Docme-UI/reports/qr_code
chmod -R 777 Docme-UI/student_profiles
chmod -R 777 Docme-UI/uploads
chmod -R 777 Docme-UI/assets/Uploads
chmod -R 777 Docme-UI/assets/Uploads/documents
chmod -R 777 Docme-UI/docme/cache
chmod -R 777 Docme-UI/docme/logs
chmod -R 777 Docme-UI/docme/third_party/vendor/mpdf/mpdf/tmp

chmod -R 777 Portal/webapp/libraries/merchant/log
chmod -R 777 Portal/webapp/cache
chmod -R 777 Portal/webapp/logs
chmod -R 777 Portal/bill/
chmod -R 777 Portal/bill/online-payment
chmod -R 777 Portal/webapp/third_party/vendor/mpdf/mpdf/tmp

chmod -R 777 api/Uploads
chmod -R 777 api/Uploads/temp
chmod -R 777 api/apicore/cache
chmod -R 777 api/apicore/logs


