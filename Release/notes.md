## Release Note v1.2.1(Apr 09,2020)

01.Bug fixes from redmine and UI improvements
02.Registration Settings Menu , Online Payments for Registration fees
03.Screens for Developers
04.Ported Data along with Fee arrears , Collection not inclueded 

## Release Note v1.0.9(FEB 13,2020)

01. Bug fixes and UI improvements
02. Transport Maintenance and Improvements

03. MIS URL : http://10.10.4.47/MIS_DOCME/

        Tvm : principal@oxfordtvm.com  123456
        Klm : principal@oxfordkollam.com 123456
        Klm : principal@oxfordcalicut.com 123456

        FD  : jawad@mhtrust.com 123456
        MD  : samir@mhtrust.com 123456

04. Bus fee demanding from transport module done
05. 3 feecodes created. with demand frequency one time fee. please update fee code before linked with any template.
06. Please link bus fee code only to bus template
07. Staff concession updated ( but not used in Indian schools)
08. Institution Login
    OXF TVM 
        1. principal@oxfordtvm.com 123
        2. nimmi@oxfordtvm.com     123
        3. arun@oxfordtvm.com      123
09. Online payment section (in progress)
10. Fee term settings screen (in progress)

## Release Note v1.0.8(FEB 04,2020)

1.  Penalty Updated, if paid penalty for a section then no penalty need to paid again
2.  Account codes for tution fee, bus fee, activity fee created by default
3.  Bus template created, only allocate bus fee to that template.(now no validations, )
4.  Term settings Screen not created, to test term settings for a fee code, will do from backend for now
5.  Direct Bank Transfer (DBT) included in Payment Options. Select reference number and payment date, then recalculate to calculate penalty base on paymnet date
6.  Voucher cancellation : if reconciled vocuher cancelled, it reverted to crv voucher and can again reconcile
7.  Payback : Move to wallet option removed for now
8.  Staff concession : the employee selection method will changed in student management. for now select an employee from list. please select same employee when adding sibling if employee list and institution not filled automatically
9.  In individual Collection report and Individual DCB reports, there is an option for searching students
    --searching according to the selection
    . Current Students
    . Long Absentee
    . Tc Students
10. Institution Login
    OXF TVM 1. principal@oxfordtvm.com 123 2. nimmi@oxfordtvm.com 123 3. arun@oxfordtvm.com 123

    OXf KLM 1. principal@oxfordklm.com 123 2. unni@oxfordkollam.com 123 3. veena@oxfordkollam.com 123

    OXF CLT 1. principal@oxfordclt.com 123 2. asfa@oxfordcalicut.com 123 3. mary@oxfordcalicut.com 123

11. Exemption Checking URL : http://10.10.4.47/MIS_DOCME/

        Tvm : principal@oxfordtvm.com  123456
        Klm : principal@oxfordkollam.com 123456
        Klm : principal@oxfordcalicut.com 123456

        FD  : jawad@mhtrust.com 123456
        MD  : samir@mhtrust.com 123456

12. Bus fee demanding from transport module in not completed(in progress)
13. Online payment section (in progress)

---

## Release Note v1.0.8(Jan 21,2020)

1.Bug fixes for Registration
2.Integrating Transport, Online Registration

## Release Note v1.0.7(Jan 21,2020)

---- 3 Institutions : LOGIN DETAILS----

---

|INSTITUTION |USERNAME |PASSWORD|
|****************\*\*\*\*****************|
|OXFORD TVM : principal@oxfordtvm.com | 123 |
|OXFORD KOLLAM : principal@oxfordklm.com | 123 |
|OXFORD CALICUT : principal@oxfordclt.com | 123 |
|**********************\*\*\*\***********************|

Exemption Checking URL : http://10.10.4.47/MIS_DOCME/
Principal Tvm : principal@oxfordtvm.com 123456
Principal Klm : principal@oxfordkollam.com 123456
Principal Klm : principal@oxfordcalicut.com 123456

FD : jawad@mhtrust.com 123456
MD : samir@mhtrust.com 123456

---

1. Concession When Demanding - only for the siblings of the demanded student
2. Arrear saving Url
3. http://10.10.5.171/docme-school/Docme-UI/arrear-summary/save --save arrear summary for all institutions
4. http://10.10.5.171/docme-school/Docme-UI/arrear-summary/save/5 --save arrear summary for selected institution
   --5 : oxfordtvm --8 : oxfklm -- 20 : oxfclt
5. Priority will refresh and concession will add/remove for students when long absentee and release long absentee

---

## Release Note v1.0.6(DEC 23, 2019)

---- 3 Institutions : LOGIN DETAILS----

---

|INSTITUTION |USERNAME |PASSWORD|
|****************\*\*\*\*****************|
|OXFORD TVM : principal@oxfordtvm.com | 123 |
|OXFORD KOLLAM : principal@oxfordklm.com | 123 |
|OXFORD CALICUT : principal@oxfordclt.com | 123 |
|****************\*\*\*\*****************|

1.  Check feedbacked bugs first, and take action appropriately
2.  Dashboard data updation not done in this evaluation.

3.  Tab duplicating and paste the url on other tab in same browser window are prevented

4.  When idle for some time, there will be a confirmation asking about retain or logout; if not clicked any and idle some more time , it will be redirected to login page(logged out)

5.  Registration wise bugs will fixed in registration evaluation.

6.  Priority issue with old data ported (no priority handled when data ported). if create new students and parent, priority correctly assigned. (if issue in creation it's not handled in this evaluation.)

7.  Exemption issue handled in MIS and working properly now.

8.  Exemption Checking link : http://10.10.4.47/MIS_DOCME/

9.  Arrear management URL for : http://10.10.5.171/docme-school/Docme-UI/arrear-summary/save (saved arrear summary for all institution for current day)

10. Some of the Accountcodes and feecodes are cretaed manually in background and not available for editing or displaying in screens. >Service Charge >Round off >Tax >Prospectus fee etc

11. New search section
    . Advanced filter section in student filter pages is not connected with the class name selected above.
    . it's retained for the old structure of search by selecting academic year, stream, session, class and batch.
    . the items listed as class are the codes created for each batch in that institution

12. AS we implemented fee allocation only for batch allocated students, we restrict the advanced search from searching for all but for selected data from above combo boxes, that's why asked for selected stream, session, class or batch in Fee demanding page

---

## Release Note v1.0.6(dec 13, 2019)

1. Bug fixes in TC Modules
2. Bug fixes in Registration

## Release Note v1.0.6(dec 09, 2019)

---- 3 Institutions : LOGIN DETAILS----

---

|INSTITUTION |USERNAME |PASSWORD|
|****************\*\*\*\*****************|
|OXFORD TVM : principal@oxfordtvm.com |123 |
|OXFORD KOLLAM : principal@oxfordklm.com |123 |
|OXFORD CALICUT : principal@oxfordclt.com |123 |
|****************\*\*\*\*****************|

1.  Batch wise search implemented
2.  3 Institutions for checking
3.  In Fee reports, Non demandable fees are Displayed as OTH
4.  Create TUTION FEE(F001), BUS FEE(F002) , ACTIVITY FEE(F003) and their corresponding Accountcode, Feetype and Demand frequeny
5.  Exemption Checking link : http://10.10.4.47/MIS_DOCME/
6.  Penalty calculated as :
    . select the penalty slab which the effective date less than or equal to current date
    . calculate days between fee arrear date and current date
    . compare the number of days with penalty from_days
7.  One time fee adjustment with Wallet is occured when demandable fees are demanding. if that time non demandable fees are pending, then that also are adjusted with wallet amount. When Other fee demanding, no adjustment will occur. (Adjustment only when Demandabke fee demanding.)
8.  Other fees are demanded by selecting a date. (The same date also be the arrear date)
9.  Wallet withdrawal : approval and encashment joined for easy handling
10. Paybak Management : Request approval and Encashment in same screen
11. Do not change concession percentage always. (it's(percentage setting) one time process at the begining)
12. Arrear Reports are included
13. Arrear management screen is provided instead of the service run Automatically for saving arrear summary of the day.
    (use this URL for : http://10.10.5.171/docme-school/Docme-UI/arrear-summary/save)

## Release Note v1.0.5

1.  Penalty Section Added
    - Penalty settings added in Basic Settings, for term details
2.  Custom Term Provision Added.
    - No screen added for creating term details
    - Need to add term details for feecode manually to database (provision will add)
3.  Prospectus Fee head need to create manually in backend to receive Registration/Prospectus Fee
4.  Cancelation of FRV Vouchers
5.  The excess amount paid with fee payment can't be cancelled when The FRV voucher is cancelled. Only Wallet withdrawal for excess amount
6.  DCB Batch wise report ,added the batch filter. if all selected, then the report will be huge (may be > 500 pages). Selecting batchwise preferred
7.  Concession Report
    - Concession Enjoying Student Report
    - Fee Concession Report
8.  Restricted the fee demanding for batch not allocated student
9.  Exemption - No restriction for multiple exemption request for same student same fee
10. User wise option included in Daily Collection Voucherwise
11. Fee collection Page changed with service charge, round off, Excess amount , total amount display
12. Include Transfer option included in some reports
13. Fee shortcodes are used in reports
14. Fee Concession and Exemption blocks are added in Counter Collection page and Student Account page

## Release Note v1.0.4

1. Round off
   . Amount Displayed with 4 decimal places for easy calculation
   . Take Round off for Total amount
   . save round off
2. Wallet Deposit : decimal places not allowed in payment textbox
3. Exemption Amount or Concession amount not in debit transfer of Counter Collection (now showing as separate boxes for exemption and concession)
4. When Concession applied, ADJ vouchers are created for each student (as exemption)
5. For giving Staff Concession, in Registration >> Parent Details : New option for Selecting Employee details from WFM and marked as staff
6. Fee Exemption and Concession only for demanded amount (before calculated with tax)
7. Registration Fee / Prospectus Fee Scrren added
8. Student arrear section hided; will update after completion of other sections successfully
9.

---
