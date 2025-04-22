

CREATE TABLE `tbl_account_class` (
  `class_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `type_code` int(11) NOT NULL,
  PRIMARY KEY (`class_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tbl_account_class` VALUES('1','Cash on Hand','This is Cash on Hand','6');
INSERT INTO `tbl_account_class` VALUES('2','Cash in Bank','This is Cash in Bank','6');
INSERT INTO `tbl_account_class` VALUES('3','Loans and Receivable Accounts','This is Loans and Receivable Accounts','6');
INSERT INTO `tbl_account_class` VALUES('4','Due from Officers and Employees','This is Due','6');
INSERT INTO `tbl_account_class` VALUES('5','Inter-Agency Receivables','This is Inter-Agency Receivables','6');
INSERT INTO `tbl_account_class` VALUES('6','Advances','This is Advances ','6');
INSERT INTO `tbl_account_class` VALUES('7','Other Receivables','This is other receivables','6');
INSERT INTO `tbl_account_class` VALUES('8','Inventory Held for Consumption','This is Inventory','6');
INSERT INTO `tbl_account_class` VALUES('9','Inventory Held for Distribution','This is Inventory Held for Distribution','6');
INSERT INTO `tbl_account_class` VALUES('10','Prepayments','This is Prepayments','6');
INSERT INTO `tbl_account_class` VALUES('11','Property, Plant and Equipment','PPE','7');
INSERT INTO `tbl_account_class` VALUES('12','Buildings & other structures','Buildings','7');
INSERT INTO `tbl_account_class` VALUES('13','Machinery and Equipment','Machines','7');
INSERT INTO `tbl_account_class` VALUES('14','Furnitures, Fixture & Books','For Furnitures','7');
INSERT INTO `tbl_account_class` VALUES('15','Transportation Equipment','This is for Transportation','7');
INSERT INTO `tbl_account_class` VALUES('16','Other Property, Plant & Equipment','Other PPE','7');
INSERT INTO `tbl_account_class` VALUES('17','Current Liabilities','Current liabilities (also called short-term liabilities) are debts a company must pay within a normal operating cycle, usually less than 12 months','2');
INSERT INTO `tbl_account_class` VALUES('18','Inter-agency Payables','This account is used to recognize withholding of taxes from officers/employees and other entities. Debit this account for remittance of the taxes withheld to the BIR.','2');
INSERT INTO `tbl_account_class` VALUES('19','Trust Liabilities','This account is used to recognize the receipt of amount held in trust for specific purpose. Debit this account for payment or settlement of the liability.','2');
INSERT INTO `tbl_account_class` VALUES('20','Payables','Obligations/ commitments of national government agencies, whether current year and prior years, for which services have been rendered, goods have been delivered or projects have been completed and accepted.','2');
INSERT INTO `tbl_account_class` VALUES('21','Salaries and Wages','Expenses Due to Salaries and Wages','10');
INSERT INTO `tbl_account_class` VALUES('22','Other Compensation','This is for other compensation to employees and workers','10');
INSERT INTO `tbl_account_class` VALUES('23','Personnel Benefit Contributions','These are the benefits being received by employees','10');
INSERT INTO `tbl_account_class` VALUES('24','Other Personnel Benefits','These accounts are other personnel benefits','10');
INSERT INTO `tbl_account_class` VALUES('25','Traveling Expense','This for traveling expenses for local destinations','11');
INSERT INTO `tbl_account_class` VALUES('26','Training and Scholarship Expense','This is for Training and Scholarship Expense','11');
INSERT INTO `tbl_account_class` VALUES('27','Supplies and Materials Expense','This is for Supplies and Materials','11');
INSERT INTO `tbl_account_class` VALUES('28','Utility Expense','This is for water and electric bills','11');
INSERT INTO `tbl_account_class` VALUES('29','Communication Expenses','For Communication Expenses','11');
INSERT INTO `tbl_account_class` VALUES('30','Generation, Transmission and Distribution Expense','This is for Generation, Transmission and Distribution Expense','11');
INSERT INTO `tbl_account_class` VALUES('31','Confidential, Intelligence and Extraordinary Expenses','This is for Confidential, Intelligence and Extraordinary Expenses','11');
INSERT INTO `tbl_account_class` VALUES('32','Professional Services','This for Professional Service rendered','11');
INSERT INTO `tbl_account_class` VALUES('33','Repairs and Maintenance','This is for Repairs and Maintenance','11');
INSERT INTO `tbl_account_class` VALUES('34','Taxes, Insurance Premiums and Other Fees','This is Taxes','11');
INSERT INTO `tbl_account_class` VALUES('35','Other Maintenance and Operating Expenses','This is Other Maintenance','11');
INSERT INTO `tbl_account_class` VALUES('36','Equity','Equity','3');
INSERT INTO `tbl_account_class` VALUES('37','Depreciation','is the accounting process of allocating the cost of a tangible asset over its useful life.','12');
INSERT INTO `tbl_account_class` VALUES('38','Impairment Loss','This is for impairment loss','12');



CREATE TABLE `tbl_account_title` (
  `account_code` int(8) NOT NULL,
  `account_name` varchar(150) NOT NULL,
  `account_type` varchar(150) NOT NULL,
  `type_code` int(10) NOT NULL,
  `class_id` int(10) NOT NULL,
  PRIMARY KEY (`account_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tbl_account_title` VALUES('10101010','Cash-Collecting Officers','Current Assets','6','1');
INSERT INTO `tbl_account_title` VALUES('10101020','Petty Cash - General Fund','Current Assets','6','1');
INSERT INTO `tbl_account_title` VALUES('10102020','Cash in Bank, Local Currency - Current Accounts','Current Assets','6','2');
INSERT INTO `tbl_account_title` VALUES('10102030','Cash in Bank-Local Currency, Savings Account','Current Assets','6','2');
INSERT INTO `tbl_account_title` VALUES('10301010','Accounts Receivable','Current Assets','6','3');
INSERT INTO `tbl_account_title` VALUES('10301012','Allowance for Impairment- Accounts Receivable','Contra-Asset','8','3');
INSERT INTO `tbl_account_title` VALUES('10301020','Notes Receivable','Current Assets','6','0');
INSERT INTO `tbl_account_title` VALUES('10303010','Due from NGAs','Current Assets','6','5');
INSERT INTO `tbl_account_title` VALUES('10303050','Due from Government Corporation','Current Assets','6','5');
INSERT INTO `tbl_account_title` VALUES('10399010','Receivables-Disallowances/Charges','Current Assets','6','7');
INSERT INTO `tbl_account_title` VALUES('10399020','Due from Officers and Employees','Current Assets','6','4');
INSERT INTO `tbl_account_title` VALUES('10399022','Allowance for Impairment-Due from Officers and Employees','Contra-Asset','8','4');
INSERT INTO `tbl_account_title` VALUES('10399990','Other Receivables','Current Assets','6','7');
INSERT INTO `tbl_account_title` VALUES('10404020','Accountable Forms, Plates and Stickers Inventory','Current Assets','6','8');
INSERT INTO `tbl_account_title` VALUES('10404120','Chemical and Filtering Supplies Inventory','Current Assets','6','9');
INSERT INTO `tbl_account_title` VALUES('10404130','Construction Materials Inventory','Current Assets','6','9');
INSERT INTO `tbl_account_title` VALUES('10404990','Other Supplies and Materials Inventory','Current Assets','6','9');
INSERT INTO `tbl_account_title` VALUES('10601010','Land','Non-Current Assets','7','11');
INSERT INTO `tbl_account_title` VALUES('10603040','Water Supply Systems','Non-Current Assets','7','16');
INSERT INTO `tbl_account_title` VALUES('10603041','Accumulated Depreciation-Water Supply System','Contra-Asset','8','16');
INSERT INTO `tbl_account_title` VALUES('10604010','Buildings','Non-Current Assets','7','12');
INSERT INTO `tbl_account_title` VALUES('10604011','Accumulated Depreciation- Building','Contra-Asset','8','12');
INSERT INTO `tbl_account_title` VALUES('10604990','Other Structures','Non-Current Assets','7','12');
INSERT INTO `tbl_account_title` VALUES('10604991','Accumulated Depreciation-Other Structures','Contra-Asset','8','12');
INSERT INTO `tbl_account_title` VALUES('10605020','Office Equipment','Non-Current Assets','7','0');
INSERT INTO `tbl_account_title` VALUES('10605021','Accumulated Depreciation-Office Equipment','Non-Current Assets','7','0');
INSERT INTO `tbl_account_title` VALUES('10605030','ICT Equipment','Non-Current Assets','7','13');
INSERT INTO `tbl_account_title` VALUES('10605031','Accumulated Depreciation-ICT Equipment','Contra-Asset','8','13');
INSERT INTO `tbl_account_title` VALUES('10605070','Communications Equipment','Non-Current Assets','7','0');
INSERT INTO `tbl_account_title` VALUES('10605071','Accumulated Depreciation-Communications Equipment','Non-Current Assets','7','0');
INSERT INTO `tbl_account_title` VALUES('10605990','Other Machineries and Equipment','Non-Current Assets','7','13');
INSERT INTO `tbl_account_title` VALUES('10605991','Accumulated Depreciation-Other Machinery and Equipment','Contra-Asset','8','13');
INSERT INTO `tbl_account_title` VALUES('10606010','Motor Vehicles','Non-Current Assets','7','15');
INSERT INTO `tbl_account_title` VALUES('10606011','Accumulated Depreciation-Motor Vehicles','Contra-Asset','8','15');
INSERT INTO `tbl_account_title` VALUES('10606990','Other Transportation Equipment','Non-Current Assets','7','15');
INSERT INTO `tbl_account_title` VALUES('10606991','Accumulated Depreciation-Other Transportation Equipment','Contra-Asset','8','15');
INSERT INTO `tbl_account_title` VALUES('10607010','Furnitures and Fixtures','Non-Current Assets','7','14');
INSERT INTO `tbl_account_title` VALUES('10607011','Accumulated Depreciation- Furnitures and Fixtures','Contra-Asset','8','14');
INSERT INTO `tbl_account_title` VALUES('10698020','Construction in Progress-Infrastructure Assets','Non-Current Assets','7','0');
INSERT INTO `tbl_account_title` VALUES('19901020','Advances for Payroll','Current Assets','6','6');
INSERT INTO `tbl_account_title` VALUES('19901040','Advances to Officers and Employees','Current Assets','6','6');
INSERT INTO `tbl_account_title` VALUES('19902020','Prepaid Rent','Current Assets','6','10');
INSERT INTO `tbl_account_title` VALUES('19902990','Other Prepayments','Current Assets','6','10');
INSERT INTO `tbl_account_title` VALUES('19999990','Other Assets','Current Assets','6','0');
INSERT INTO `tbl_account_title` VALUES('20101010','Accounts Payable','Liabilities','2','20');
INSERT INTO `tbl_account_title` VALUES('20101020','Due to Officers and Employees','Liabilities','2','17');
INSERT INTO `tbl_account_title` VALUES('20101040','Loans Payable-Domestic','Long-Term Liabilities','9','0');
INSERT INTO `tbl_account_title` VALUES('20101050','Interest Payable','Liabilities','2','17');
INSERT INTO `tbl_account_title` VALUES('20102041','Loans Payable-Domestic (Current)','Liabilities','2','0');
INSERT INTO `tbl_account_title` VALUES('20201010','Due to BIR','Liabilities','2','18');
INSERT INTO `tbl_account_title` VALUES('20201020','Due to GSIS','Liabilities','2','18');
INSERT INTO `tbl_account_title` VALUES('20201030','Due to Pag-IBIG','Liabilities','2','18');
INSERT INTO `tbl_account_title` VALUES('20201040','Due to PhilHealth','Liabilities','2','18');
INSERT INTO `tbl_account_title` VALUES('20201050','Due to NGAs','Liabilities','2','18');
INSERT INTO `tbl_account_title` VALUES('20401040','Guaranty/Security Deposit Payable','Liabilities','2','19');
INSERT INTO `tbl_account_title` VALUES('20401050','Customers\' Deposits Payable','Liabilities','2','19');
INSERT INTO `tbl_account_title` VALUES('20501990','Other Deferred Credits','Long-Term Liabilities','9','0');
INSERT INTO `tbl_account_title` VALUES('30101020','Government Equity','Equity','3','0');
INSERT INTO `tbl_account_title` VALUES('30701010','Retained Earnings','Equity','3','0');
INSERT INTO `tbl_account_title` VALUES('40202090','Waterworks System Fee','Income','5','0');
INSERT INTO `tbl_account_title` VALUES('40202210','Income Interest','Income','5','0');
INSERT INTO `tbl_account_title` VALUES('40202230','Fines and Penalties-Business Income','Income','5','0');
INSERT INTO `tbl_account_title` VALUES('40202990','Other Business Income','Income','5','0');
INSERT INTO `tbl_account_title` VALUES('40403010','Grants in Cash','Income','5','0');
INSERT INTO `tbl_account_title` VALUES('40699990','Miscellaneous Income','Income','5','0');
INSERT INTO `tbl_account_title` VALUES('50101010','Salaries and Wages - Regular','Personnel Services','10','21');
INSERT INTO `tbl_account_title` VALUES('50101020','Salaries and Wages - Casual/Contractual','Personnel Services','10','21');
INSERT INTO `tbl_account_title` VALUES('50102010','Personal Economic Relief Allowance (PERA)','Personnel Services','10','22');
INSERT INTO `tbl_account_title` VALUES('50102020','Representation Allowance(RA)','Personnel Services','10','22');
INSERT INTO `tbl_account_title` VALUES('50102030','Transportation Allowance(TA)','Personnel Services','10','22');
INSERT INTO `tbl_account_title` VALUES('50102040','Clothing/Uniform Allowance','Personnel Services','10','22');
INSERT INTO `tbl_account_title` VALUES('50102100','Honoraria','Personnel Services','10','22');
INSERT INTO `tbl_account_title` VALUES('50102130','Overtime and Night Pay','Personnel Services','10','22');
INSERT INTO `tbl_account_title` VALUES('50102150','Cash Gift','Expenses','4','0');
INSERT INTO `tbl_account_title` VALUES('50103010','Retirement and Life Insurance Premium','Personnel Services','10','23');
INSERT INTO `tbl_account_title` VALUES('50103020','Pag-IBIG Contributions','Personnel Services','10','23');
INSERT INTO `tbl_account_title` VALUES('50103030','PhilHealth Contributions','Personnel Services','10','23');
INSERT INTO `tbl_account_title` VALUES('50103040','Employees Compensation Insurance Premiums','Personnel Services','10','23');
INSERT INTO `tbl_account_title` VALUES('50104990','Other Personnel Benefits','Personnel Services','10','24');
INSERT INTO `tbl_account_title` VALUES('50201010','Traveling Expenses - Local','Maintenance and Other Operating Expenses','11','25');
INSERT INTO `tbl_account_title` VALUES('50202010','Training Expenses','Maintenance and Other Operating Expenses','11','26');
INSERT INTO `tbl_account_title` VALUES('50203010','Office Supplies Expenses','Maintenance and Other Operating Expenses','11','27');
INSERT INTO `tbl_account_title` VALUES('50203020','Accountable Form Expenses','Expenses','4','27');
INSERT INTO `tbl_account_title` VALUES('50203090','Fuel, Oil and Lubricants Expenses','Maintenance and Other Operating Expenses','11','27');
INSERT INTO `tbl_account_title` VALUES('50203130','Chemicals and Filtering Supplies Expenses','Expenses','4','0');
INSERT INTO `tbl_account_title` VALUES('50203210','Semi Expendable Machinery and Equipment Expenses','Maintenance and Other Operating Expenses','11','27');
INSERT INTO `tbl_account_title` VALUES('50204020','Electricity Expenses','Maintenance and Other Operating Expenses','11','28');
INSERT INTO `tbl_account_title` VALUES('50205010','Postage and Courier Services','Maintenance and Other Operating Expenses','11','29');
INSERT INTO `tbl_account_title` VALUES('50205020','Telephone Expenses','Maintenance and Other Operating Expenses','11','29');
INSERT INTO `tbl_account_title` VALUES('50209010','Generation, Transmission and Distribution Expenses','Maintenance and Other Operating Expenses','11','30');
INSERT INTO `tbl_account_title` VALUES('50210030','Extraordinary and Miscellaneous Expense','Maintenance and Other Operating Expenses','11','31');
INSERT INTO `tbl_account_title` VALUES('50211010','Legal Services','Maintenance and Other Operating Expenses','11','32');
INSERT INTO `tbl_account_title` VALUES('50211020','Auditing Services','Maintenance and Other Operating Expenses','11','32');
INSERT INTO `tbl_account_title` VALUES('50211990','Other Professional Services','Maintenance and Other Operating Expenses','11','32');
INSERT INTO `tbl_account_title` VALUES('50212990','Other General Services','Expenses','4','0');
INSERT INTO `tbl_account_title` VALUES('50213030','Repair and Maintenance - Infrastructure Assets','Maintenance and Other Operating Expenses','11','33');
INSERT INTO `tbl_account_title` VALUES('50213040','Repair and Maintenance - Building and Other Structures','Maintenance and Other Operating Expenses','11','33');
INSERT INTO `tbl_account_title` VALUES('50213050','Repair and Maintenance - Machinery and Equipment','Maintenance and Other Operating Expenses','11','33');
INSERT INTO `tbl_account_title` VALUES('50213060','Repair and Maintenance - Transportation Equipment','Maintenance and Other Operating Expenses','11','33');
INSERT INTO `tbl_account_title` VALUES('50213070','Repair and Maintenance - Furniture and Fixtures','Maintenance and Other Operating Expenses','11','33');
INSERT INTO `tbl_account_title` VALUES('50215010','Taxes, Duties and Licenses','Maintenance and Other Operating Expenses','11','34');
INSERT INTO `tbl_account_title` VALUES('50215020','Fidelity Bond Premium','Maintenance and Other Operating Expenses','11','34');
INSERT INTO `tbl_account_title` VALUES('50215030','Insurance/Reinsurance Expense','Maintenance and Other Operating Expenses','11','34');
INSERT INTO `tbl_account_title` VALUES('50216010','Labor and Wages - Contractual','Expenses','4','0');
INSERT INTO `tbl_account_title` VALUES('50299010','Advertising, Promotional and Marketing Expenses','Maintenance and Other Operating Expenses','11','35');
INSERT INTO `tbl_account_title` VALUES('50299020','Printing and Publication Expenses','Maintenance and Other Operating Expenses','11','35');
INSERT INTO `tbl_account_title` VALUES('50299030','Representation Expenses','Maintenance and Other Operating Expenses','11','35');
INSERT INTO `tbl_account_title` VALUES('50299050','Rent/Lease Expenses','Maintenance and Other Operating Expenses','11','35');
INSERT INTO `tbl_account_title` VALUES('50299060','Membership Dues and Contribution to Organization','Maintenance and Other Operating Expenses','11','35');
INSERT INTO `tbl_account_title` VALUES('50301010','Internet Expense','Financial Expense','13','0');
INSERT INTO `tbl_account_title` VALUES('50301040','Bank Charges','Financial Expense','13','0');
INSERT INTO `tbl_account_title` VALUES('50501060','Depreciation - Transportation Equipment','Non Cash Expense','12','37');
INSERT INTO `tbl_account_title` VALUES('50501070','Depreciation - Furniture, Fixtures and Books','Non Cash Expense','12','37');
INSERT INTO `tbl_account_title` VALUES('50501990','Depreciation - Other Property, Plant Equipment','Expenses','4','37');
INSERT INTO `tbl_account_title` VALUES('50503020','Impairment Loss - Loans and Receivables','Non Cash Expense','12','38');



CREATE TABLE `tbl_account_type` (
  `type_code` int(8) NOT NULL AUTO_INCREMENT,
  `account_type` varchar(100) NOT NULL,
  `normal_balance` varchar(100) NOT NULL,
  `type_description` text NOT NULL,
  `main_type_id` int(10) NOT NULL,
  PRIMARY KEY (`type_code`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tbl_account_type` VALUES('2','Liabilities','Credit','It is used to keep track of all legally-binding debts that must be paid to someone else','6');
INSERT INTO `tbl_account_type` VALUES('3','Equity','Credit','Equity accounts represent the financial ownership in a company and are visible in the balance sheet immediately after the liability accounts.','6');
INSERT INTO `tbl_account_type` VALUES('5','Income','Credit','For Income Accounts','4');
INSERT INTO `tbl_account_type` VALUES('6','Current Assets','Debit','It is any resource a company could use, turn into cash, or sell within a year.','1');
INSERT INTO `tbl_account_type` VALUES('7','Non-Current Assets','Debit','They are assets and property owned by a business that are not easily converted to cash within a year','1');
INSERT INTO `tbl_account_type` VALUES('8','Contra-Asset','Credit',' The account offsets the balance in the respective asset account that it is paired with on the balance sheet.','1');
INSERT INTO `tbl_account_type` VALUES('9','Long-Term Liabilities','Credit','Long-term liabilities, also called long-term debts, are debts a company owes third-party creditors that are payable beyond 12 months.','6');
INSERT INTO `tbl_account_type` VALUES('10','Personnel Services','Debit',' This is for Personnel Services Expenses','5');
INSERT INTO `tbl_account_type` VALUES('11','Maintenance and Other Operating Expenses','Debit',' For Maintenance Expenses','5');
INSERT INTO `tbl_account_type` VALUES('12','Non Cash Expense','Debit',' Non Cash Expenses','5');
INSERT INTO `tbl_account_type` VALUES('13','Financial Expense','Debit','They are costs incurred from borrowing from lenders or creditors.','5');



CREATE TABLE `tbl_audit_log` (
  `audit_log_id` int(11) NOT NULL AUTO_INCREMENT,
  `table_modified` varchar(100) NOT NULL,
  `id_modified` int(11) NOT NULL,
  `audit_action` varchar(100) NOT NULL,
  `audit_description` text NOT NULL,
  `uid` int(11) NOT NULL,
  `audit_timestamp` datetime NOT NULL,
  PRIMARY KEY (`audit_log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=703 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tbl_audit_log` VALUES('107','tbl_user','6','ADD','Added new user with username user3','1','2024-10-15 20:53:57');
INSERT INTO `tbl_audit_log` VALUES('108','tbl_user_info','7','ADD','Added new user named: Deca on ID 7','1','2024-10-15 20:56:01');
INSERT INTO `tbl_audit_log` VALUES('109','tbl_user','7','ADD','Added new user with username user4','1','2024-10-15 20:56:01');
INSERT INTO `tbl_audit_log` VALUES('110','tbl_user_info','8','ADD','Added new user named: Decy on ID 8','1','2024-10-15 20:58:34');
INSERT INTO `tbl_audit_log` VALUES('111','tbl_user','8','ADD','Added new user with username user3','1','2024-10-15 20:58:34');
INSERT INTO `tbl_audit_log` VALUES('112','tbl_user_info','9','ADD','Added new user named: Ran on ID 9','1','2024-10-15 20:59:31');
INSERT INTO `tbl_audit_log` VALUES('113','tbl_user','9','ADD','Added new user with username user4','1','2024-10-15 20:59:31');
INSERT INTO `tbl_audit_log` VALUES('114','tbl_user_info','10','ADD','Added new user named: Deca on ID 10','1','2024-10-15 21:01:00');
INSERT INTO `tbl_audit_log` VALUES('115','tbl_user','10','ADD','Added new user with username user5','1','2024-10-15 21:01:00');
INSERT INTO `tbl_audit_log` VALUES('116','tbl_user_info','11','ADD','Added new user named: Kaeya on ID 11','1','2024-10-15 21:02:07');
INSERT INTO `tbl_audit_log` VALUES('117','tbl_user','11','ADD','Added new user with username user6','1','2024-10-15 21:02:07');
INSERT INTO `tbl_audit_log` VALUES('118','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-10-15 21:58:58');
INSERT INTO `tbl_audit_log` VALUES('119','tbl_user','2','LOGIN','Cashier user2 has logged in into the system','2','2024-10-15 21:59:03');
INSERT INTO `tbl_audit_log` VALUES('120','tbl_user','2','LOGOUT','Cashier user2 has logged out into the system','2','2024-10-15 22:00:26');
INSERT INTO `tbl_audit_log` VALUES('121','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-15 22:00:30');
INSERT INTO `tbl_audit_log` VALUES('122','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-16 09:59:29');
INSERT INTO `tbl_audit_log` VALUES('123','tbl_journal_entry','18','ADD','Added new journal entry with voucher number 24-0001','1','2024-10-16 10:17:15');
INSERT INTO `tbl_audit_log` VALUES('124','tbl_journal_items','43','ADD','Added new journal items with 10301010','1','2024-10-16 10:17:15');
INSERT INTO `tbl_audit_log` VALUES('125','tbl_general_ledger','43','ADD','Added new general ledger items with 10301010 with journal voucher ID 18','1','2024-10-16 10:17:15');
INSERT INTO `tbl_audit_log` VALUES('126','tbl_trial_balance','43','ADD','Added new trial balance items with 10301010 with journal voucher ID 18','1','2024-10-16 10:17:15');
INSERT INTO `tbl_audit_log` VALUES('127','tbl_journal_items','44','ADD','Added new journal items with 40202090','1','2024-10-16 10:17:15');
INSERT INTO `tbl_audit_log` VALUES('128','tbl_general_ledger','44','ADD','Added new general ledger items with 40202090 with journal voucher ID 18','1','2024-10-16 10:17:15');
INSERT INTO `tbl_audit_log` VALUES('129','tbl_trial_balance','44','ADD','Added new trial balance items with 40202090 with journal voucher ID 18','1','2024-10-16 10:17:15');
INSERT INTO `tbl_audit_log` VALUES('130','tbl_journal_items','45','ADD','Added new journal items with 40202230','1','2024-10-16 10:17:15');
INSERT INTO `tbl_audit_log` VALUES('131','tbl_general_ledger','45','ADD','Added new general ledger items with 40202230 with journal voucher ID 18','1','2024-10-16 10:17:15');
INSERT INTO `tbl_audit_log` VALUES('132','tbl_trial_balance','45','ADD','Added new trial balance items with 40202230 with journal voucher ID 18','1','2024-10-16 10:17:15');
INSERT INTO `tbl_audit_log` VALUES('133','tbl_journal_entry','19','ADD','Added new journal entry with voucher number 24-0002','1','2024-10-16 10:29:25');
INSERT INTO `tbl_audit_log` VALUES('134','tbl_journal_items','46','ADD','Added new journal items with 10101010','1','2024-10-16 10:29:25');
INSERT INTO `tbl_audit_log` VALUES('135','tbl_general_ledger','46','ADD','Added new general ledger items with 10101010 with journal voucher ID 19','1','2024-10-16 10:29:25');
INSERT INTO `tbl_audit_log` VALUES('136','tbl_trial_balance','46','ADD','Added new trial balance items with 10101010 with journal voucher ID 19','1','2024-10-16 10:29:25');
INSERT INTO `tbl_audit_log` VALUES('137','tbl_journal_items','47','ADD','Added new journal items with 20401050','1','2024-10-16 10:29:25');
INSERT INTO `tbl_audit_log` VALUES('138','tbl_general_ledger','47','ADD','Added new general ledger items with 20401050 with journal voucher ID 19','1','2024-10-16 10:29:25');
INSERT INTO `tbl_audit_log` VALUES('139','tbl_trial_balance','47','ADD','Added new trial balance items with 20401050 with journal voucher ID 19','1','2024-10-16 10:29:25');
INSERT INTO `tbl_audit_log` VALUES('140','tbl_journal_items','48','ADD','Added new journal items with 40202990','1','2024-10-16 10:29:25');
INSERT INTO `tbl_audit_log` VALUES('141','tbl_general_ledger','48','ADD','Added new general ledger items with 40202990 with journal voucher ID 19','1','2024-10-16 10:29:25');
INSERT INTO `tbl_audit_log` VALUES('142','tbl_trial_balance','48','ADD','Added new trial balance items with 40202990 with journal voucher ID 19','1','2024-10-16 10:29:25');
INSERT INTO `tbl_audit_log` VALUES('143','tbl_journal_items','49','ADD','Added new journal items with 40202230','1','2024-10-16 10:29:25');
INSERT INTO `tbl_audit_log` VALUES('144','tbl_general_ledger','49','ADD','Added new general ledger items with 40202230 with journal voucher ID 19','1','2024-10-16 10:29:25');
INSERT INTO `tbl_audit_log` VALUES('145','tbl_trial_balance','49','ADD','Added new trial balance items with 40202230 with journal voucher ID 19','1','2024-10-16 10:29:25');
INSERT INTO `tbl_audit_log` VALUES('146','tbl_journal_items','50','ADD','Added new journal items with 10301010','1','2024-10-16 10:29:25');
INSERT INTO `tbl_audit_log` VALUES('147','tbl_general_ledger','50','ADD','Added new general ledger items with 10301010 with journal voucher ID 19','1','2024-10-16 10:29:25');
INSERT INTO `tbl_audit_log` VALUES('148','tbl_trial_balance','50','ADD','Added new trial balance items with 10301010 with journal voucher ID 19','1','2024-10-16 10:29:25');
INSERT INTO `tbl_audit_log` VALUES('149','tbl_journal_items','51','ADD','Added new journal items with 19901040','1','2024-10-16 10:29:25');
INSERT INTO `tbl_audit_log` VALUES('150','tbl_general_ledger','51','ADD','Added new general ledger items with 19901040 with journal voucher ID 19','1','2024-10-16 10:29:25');
INSERT INTO `tbl_audit_log` VALUES('151','tbl_trial_balance','51','ADD','Added new trial balance items with 19901040 with journal voucher ID 19','1','2024-10-16 10:29:25');
INSERT INTO `tbl_audit_log` VALUES('152','tbl_journal_entry','20','ADD','Added new journal entry with voucher number 24-0003','1','2024-10-16 10:31:37');
INSERT INTO `tbl_audit_log` VALUES('153','tbl_journal_items','52','ADD','Added new journal items with 19901040','1','2024-10-16 10:31:37');
INSERT INTO `tbl_audit_log` VALUES('154','tbl_general_ledger','52','ADD','Added new general ledger items with 19901040 with journal voucher ID 20','1','2024-10-16 10:31:37');
INSERT INTO `tbl_audit_log` VALUES('155','tbl_trial_balance','52','ADD','Added new trial balance items with 19901040 with journal voucher ID 20','1','2024-10-16 10:31:37');
INSERT INTO `tbl_audit_log` VALUES('156','tbl_journal_items','53','ADD','Added new journal items with 10102020','1','2024-10-16 10:31:37');
INSERT INTO `tbl_audit_log` VALUES('157','tbl_general_ledger','53','ADD','Added new general ledger items with 10102020 with journal voucher ID 20','1','2024-10-16 10:31:37');
INSERT INTO `tbl_audit_log` VALUES('158','tbl_trial_balance','53','ADD','Added new trial balance items with 10102020 with journal voucher ID 20','1','2024-10-16 10:31:37');
INSERT INTO `tbl_audit_log` VALUES('159','tbl_journal_entry','21','ADD','Added new journal entry with voucher number 24-0004','1','2024-10-16 10:32:52');
INSERT INTO `tbl_audit_log` VALUES('160','tbl_journal_items','54','ADD','Added new journal items with 10102020','1','2024-10-16 10:32:52');
INSERT INTO `tbl_audit_log` VALUES('161','tbl_general_ledger','54','ADD','Added new general ledger items with 10102020 with journal voucher ID 21','1','2024-10-16 10:32:52');
INSERT INTO `tbl_audit_log` VALUES('162','tbl_trial_balance','54','ADD','Added new trial balance items with 10102020 with journal voucher ID 21','1','2024-10-16 10:32:52');
INSERT INTO `tbl_audit_log` VALUES('163','tbl_journal_items','55','ADD','Added new journal items with 10101010','1','2024-10-16 10:32:52');
INSERT INTO `tbl_audit_log` VALUES('164','tbl_general_ledger','55','ADD','Added new general ledger items with 10101010 with journal voucher ID 21','1','2024-10-16 10:32:52');
INSERT INTO `tbl_audit_log` VALUES('165','tbl_trial_balance','55','ADD','Added new trial balance items with 10101010 with journal voucher ID 21','1','2024-10-16 10:32:52');
INSERT INTO `tbl_audit_log` VALUES('166','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-10-16 10:50:44');
INSERT INTO `tbl_audit_log` VALUES('167','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-16 10:55:14');
INSERT INTO `tbl_audit_log` VALUES('168','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-10-16 11:16:28');
INSERT INTO `tbl_audit_log` VALUES('169','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-16 18:45:26');
INSERT INTO `tbl_audit_log` VALUES('170','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-16 19:13:32');
INSERT INTO `tbl_audit_log` VALUES('171','tbl_user','0','UPDATE','Updated Fiscal Status of 2','1','2024-10-16 19:16:57');
INSERT INTO `tbl_audit_log` VALUES('172','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-10-16 19:17:00');
INSERT INTO `tbl_audit_log` VALUES('173','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-16 19:17:06');
INSERT INTO `tbl_audit_log` VALUES('174','tbl_user','0','UPDATE','Updated Fiscal Status of 3','1','2024-10-16 19:21:16');
INSERT INTO `tbl_audit_log` VALUES('175','tbl_user','0','UPDATE','Updated Fiscal Status of 2','1','2024-10-16 19:21:33');
INSERT INTO `tbl_audit_log` VALUES('176','tbl_user','0','UPDATE','Updated Fiscal Status of 3','1','2024-10-16 19:21:39');
INSERT INTO `tbl_audit_log` VALUES('177','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-10-16 19:21:40');
INSERT INTO `tbl_audit_log` VALUES('178','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-16 19:21:57');
INSERT INTO `tbl_audit_log` VALUES('179','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-10-16 19:36:20');
INSERT INTO `tbl_audit_log` VALUES('180','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-16 19:40:27');
INSERT INTO `tbl_audit_log` VALUES('181','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-10-16 19:40:46');
INSERT INTO `tbl_audit_log` VALUES('182','tbl_user','2','LOGIN','Cashier user2 has logged in into the system','2','2024-10-16 19:40:55');
INSERT INTO `tbl_audit_log` VALUES('183','tbl_user','2','LOGOUT','Cashier user2 has logged out into the system','2','2024-10-16 19:40:57');
INSERT INTO `tbl_audit_log` VALUES('184','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-16 19:46:21');
INSERT INTO `tbl_audit_log` VALUES('185','tbl_journal_entry','22','ADD','Added new journal entry with voucher number 24-0005','1','2024-10-19 18:25:48');
INSERT INTO `tbl_audit_log` VALUES('186','tbl_journal_items','56','ADD','Added new journal items with 10101010','1','2024-10-19 18:25:48');
INSERT INTO `tbl_audit_log` VALUES('187','tbl_general_ledger','56','ADD','Added new general ledger items with 10101010 with journal voucher ID 22','1','2024-10-19 18:25:48');
INSERT INTO `tbl_audit_log` VALUES('188','tbl_trial_balance','56','ADD','Added new trial balance items with 10101010 with journal voucher ID 22','1','2024-10-19 18:25:48');
INSERT INTO `tbl_audit_log` VALUES('189','tbl_journal_items','57','ADD','Added new journal items with 40202090','1','2024-10-19 18:25:48');
INSERT INTO `tbl_audit_log` VALUES('190','tbl_general_ledger','57','ADD','Added new general ledger items with 40202090 with journal voucher ID 22','1','2024-10-19 18:25:48');
INSERT INTO `tbl_audit_log` VALUES('191','tbl_trial_balance','57','ADD','Added new trial balance items with 40202090 with journal voucher ID 22','1','2024-10-19 18:25:48');
INSERT INTO `tbl_audit_log` VALUES('192','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-10-19 19:56:08');
INSERT INTO `tbl_audit_log` VALUES('193','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-19 21:20:23');
INSERT INTO `tbl_audit_log` VALUES('194','tbl_user_info','12','ADD','Added new user named: Alorna on ID 12','1','2024-10-19 21:27:40');
INSERT INTO `tbl_audit_log` VALUES('195','tbl_user','12','ADD','Added new user with username alorna','1','2024-10-19 21:27:40');
INSERT INTO `tbl_audit_log` VALUES('196','tbl_journal_entry','23','ADD','Added new journal entry with voucher number 24-0006','1','2024-10-19 21:33:03');
INSERT INTO `tbl_audit_log` VALUES('197','tbl_journal_items','58','ADD','Added new journal items with 10101010','1','2024-10-19 21:33:03');
INSERT INTO `tbl_audit_log` VALUES('198','tbl_general_ledger','58','ADD','Added new general ledger items with 10101010 with journal voucher ID 23','1','2024-10-19 21:33:03');
INSERT INTO `tbl_audit_log` VALUES('199','tbl_trial_balance','58','ADD','Added new trial balance items with 10101010 with journal voucher ID 23','1','2024-10-19 21:33:03');
INSERT INTO `tbl_audit_log` VALUES('200','tbl_journal_items','59','ADD','Added new journal items with 20101010','1','2024-10-19 21:33:03');
INSERT INTO `tbl_audit_log` VALUES('201','tbl_general_ledger','59','ADD','Added new general ledger items with 20101010 with journal voucher ID 23','1','2024-10-19 21:33:03');
INSERT INTO `tbl_audit_log` VALUES('202','tbl_trial_balance','59','ADD','Added new trial balance items with 20101010 with journal voucher ID 23','1','2024-10-19 21:33:03');
INSERT INTO `tbl_audit_log` VALUES('203','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-10-19 21:42:54');
INSERT INTO `tbl_audit_log` VALUES('204','tbl_user','12','LOGIN','Cashier alorna has logged in into the system','12','2024-10-19 21:43:02');
INSERT INTO `tbl_audit_log` VALUES('205','tbl_journal_entry','24','ADD','Added new journal entry with voucher number 24-0007','12','2024-10-19 21:43:51');
INSERT INTO `tbl_audit_log` VALUES('206','tbl_journal_items','60','ADD','Added new journal items with 10101010','12','2024-10-19 21:43:51');
INSERT INTO `tbl_audit_log` VALUES('207','tbl_general_ledger','60','ADD','Added new general ledger items with 10101010 with journal voucher ID 24','12','2024-10-19 21:43:51');
INSERT INTO `tbl_audit_log` VALUES('208','tbl_trial_balance','60','ADD','Added new trial balance items with 10101010 with journal voucher ID 24','12','2024-10-19 21:43:51');
INSERT INTO `tbl_audit_log` VALUES('209','tbl_journal_items','61','ADD','Added new journal items with 40202090','12','2024-10-19 21:43:51');
INSERT INTO `tbl_audit_log` VALUES('210','tbl_general_ledger','61','ADD','Added new general ledger items with 40202090 with journal voucher ID 24','12','2024-10-19 21:43:51');
INSERT INTO `tbl_audit_log` VALUES('211','tbl_trial_balance','61','ADD','Added new trial balance items with 40202090 with journal voucher ID 24','12','2024-10-19 21:43:51');
INSERT INTO `tbl_audit_log` VALUES('212','tbl_user','12','LOGOUT','Cashier alorna has logged out into the system','12','2024-10-19 21:45:39');
INSERT INTO `tbl_audit_log` VALUES('213','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-19 21:49:13');
INSERT INTO `tbl_audit_log` VALUES('214','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-10-19 21:52:28');
INSERT INTO `tbl_audit_log` VALUES('215','tbl_user','2','LOGIN','Cashier user2 has logged in into the system','2','2024-10-19 21:52:37');
INSERT INTO `tbl_audit_log` VALUES('216','tbl_user','2','LOGOUT','Cashier user2 has logged out into the system','2','2024-10-19 21:53:55');
INSERT INTO `tbl_audit_log` VALUES('217','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-19 22:05:45');
INSERT INTO `tbl_audit_log` VALUES('218','tbl_journal_category','6','UPDATE','Updated Category 6','1','2024-10-19 23:26:53');
INSERT INTO `tbl_audit_log` VALUES('219','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-19 23:56:21');
INSERT INTO `tbl_audit_log` VALUES('220','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-10-19 23:57:56');
INSERT INTO `tbl_audit_log` VALUES('221','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-20 16:46:56');
INSERT INTO `tbl_audit_log` VALUES('222','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-10-20 16:53:29');
INSERT INTO `tbl_audit_log` VALUES('223','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-20 16:57:52');
INSERT INTO `tbl_audit_log` VALUES('224','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-10-20 16:59:03');
INSERT INTO `tbl_audit_log` VALUES('225','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-20 16:59:45');
INSERT INTO `tbl_audit_log` VALUES('226','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-20 18:27:15');
INSERT INTO `tbl_audit_log` VALUES('227','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-10-20 18:28:22');
INSERT INTO `tbl_audit_log` VALUES('228','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-20 18:29:19');
INSERT INTO `tbl_audit_log` VALUES('229','tbl_user','0','UPDATE','Updated Fiscal Status of 2','1','2024-10-20 19:53:45');
INSERT INTO `tbl_audit_log` VALUES('230','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-10-20 19:53:46');
INSERT INTO `tbl_audit_log` VALUES('231','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-20 19:53:54');
INSERT INTO `tbl_audit_log` VALUES('232','tbl_journal_entry','25','ADD','Added new journal entry with voucher number 23-0001','1','2024-10-20 19:59:19');
INSERT INTO `tbl_audit_log` VALUES('233','tbl_journal_items','62','ADD','Added new journal items with 10301010','1','2024-10-20 19:59:19');
INSERT INTO `tbl_audit_log` VALUES('234','tbl_general_ledger','62','ADD','Added new general ledger items with 10301010 with journal voucher ID 25','1','2024-10-20 19:59:19');
INSERT INTO `tbl_audit_log` VALUES('235','tbl_trial_balance','62','ADD','Added new trial balance items with 10301010 with journal voucher ID 25','1','2024-10-20 19:59:19');
INSERT INTO `tbl_audit_log` VALUES('236','tbl_journal_items','63','ADD','Added new journal items with 40202090','1','2024-10-20 19:59:19');
INSERT INTO `tbl_audit_log` VALUES('237','tbl_general_ledger','63','ADD','Added new general ledger items with 40202090 with journal voucher ID 25','1','2024-10-20 19:59:19');
INSERT INTO `tbl_audit_log` VALUES('238','tbl_trial_balance','63','ADD','Added new trial balance items with 40202090 with journal voucher ID 25','1','2024-10-20 19:59:19');
INSERT INTO `tbl_audit_log` VALUES('239','tbl_journal_items','64','ADD','Added new journal items with 40202230','1','2024-10-20 19:59:19');
INSERT INTO `tbl_audit_log` VALUES('240','tbl_general_ledger','64','ADD','Added new general ledger items with 40202230 with journal voucher ID 25','1','2024-10-20 19:59:19');
INSERT INTO `tbl_audit_log` VALUES('241','tbl_trial_balance','64','ADD','Added new trial balance items with 40202230 with journal voucher ID 25','1','2024-10-20 19:59:19');
INSERT INTO `tbl_audit_log` VALUES('242','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-10-20 19:59:28');
INSERT INTO `tbl_audit_log` VALUES('243','tbl_user','2','LOGIN','Cashier user2 has logged in into the system','2','2024-10-20 19:59:32');
INSERT INTO `tbl_audit_log` VALUES('244','tbl_journal_entry','26','ADD','Added new journal entry with voucher number 23-0002','2','2024-10-20 20:07:57');
INSERT INTO `tbl_audit_log` VALUES('245','tbl_journal_items','65','ADD','Added new journal items with 10101010','2','2024-10-20 20:07:57');
INSERT INTO `tbl_audit_log` VALUES('246','tbl_general_ledger','65','ADD','Added new general ledger items with 10101010 with journal voucher ID 26','2','2024-10-20 20:07:57');
INSERT INTO `tbl_audit_log` VALUES('247','tbl_trial_balance','65','ADD','Added new trial balance items with 10101010 with journal voucher ID 26','2','2024-10-20 20:07:57');
INSERT INTO `tbl_audit_log` VALUES('248','tbl_journal_items','66','ADD','Added new journal items with 10301010','2','2024-10-20 20:07:57');
INSERT INTO `tbl_audit_log` VALUES('249','tbl_general_ledger','66','ADD','Added new general ledger items with 10301010 with journal voucher ID 26','2','2024-10-20 20:07:57');
INSERT INTO `tbl_audit_log` VALUES('250','tbl_trial_balance','66','ADD','Added new trial balance items with 10301010 with journal voucher ID 26','2','2024-10-20 20:07:57');
INSERT INTO `tbl_audit_log` VALUES('251','tbl_journal_entry','27','ADD','Added new journal entry with voucher number 23-0003','2','2024-10-20 20:11:07');
INSERT INTO `tbl_audit_log` VALUES('252','tbl_journal_items','67','ADD','Added new journal items with 10102020','2','2024-10-20 20:11:07');
INSERT INTO `tbl_audit_log` VALUES('253','tbl_general_ledger','67','ADD','Added new general ledger items with 10102020 with journal voucher ID 27','2','2024-10-20 20:11:07');
INSERT INTO `tbl_audit_log` VALUES('254','tbl_trial_balance','67','ADD','Added new trial balance items with 10102020 with journal voucher ID 27','2','2024-10-20 20:11:07');
INSERT INTO `tbl_audit_log` VALUES('255','tbl_journal_items','68','ADD','Added new journal items with 10101010','2','2024-10-20 20:11:07');
INSERT INTO `tbl_audit_log` VALUES('256','tbl_general_ledger','68','ADD','Added new general ledger items with 10101010 with journal voucher ID 27','2','2024-10-20 20:11:07');
INSERT INTO `tbl_audit_log` VALUES('257','tbl_trial_balance','68','ADD','Added new trial balance items with 10101010 with journal voucher ID 27','2','2024-10-20 20:11:07');
INSERT INTO `tbl_audit_log` VALUES('258','tbl_journal_entry','28','ADD','Added new journal entry with voucher number 23-0004','2','2024-10-20 20:13:57');
INSERT INTO `tbl_audit_log` VALUES('259','tbl_journal_items','69','ADD','Added new journal items with 10607010','2','2024-10-20 20:13:57');
INSERT INTO `tbl_audit_log` VALUES('260','tbl_general_ledger','69','ADD','Added new general ledger items with 10607010 with journal voucher ID 28','2','2024-10-20 20:13:57');
INSERT INTO `tbl_audit_log` VALUES('261','tbl_trial_balance','69','ADD','Added new trial balance items with 10607010 with journal voucher ID 28','2','2024-10-20 20:13:57');
INSERT INTO `tbl_audit_log` VALUES('262','tbl_journal_items','70','ADD','Added new journal items with 10605030','2','2024-10-20 20:13:57');
INSERT INTO `tbl_audit_log` VALUES('263','tbl_general_ledger','70','ADD','Added new general ledger items with 10605030 with journal voucher ID 28','2','2024-10-20 20:13:57');
INSERT INTO `tbl_audit_log` VALUES('264','tbl_trial_balance','70','ADD','Added new trial balance items with 10605030 with journal voucher ID 28','2','2024-10-20 20:13:57');
INSERT INTO `tbl_audit_log` VALUES('265','tbl_journal_items','71','ADD','Added new journal items with 10606010','2','2024-10-20 20:13:57');
INSERT INTO `tbl_audit_log` VALUES('266','tbl_general_ledger','71','ADD','Added new general ledger items with 10606010 with journal voucher ID 28','2','2024-10-20 20:13:57');
INSERT INTO `tbl_audit_log` VALUES('267','tbl_trial_balance','71','ADD','Added new trial balance items with 10606010 with journal voucher ID 28','2','2024-10-20 20:13:57');
INSERT INTO `tbl_audit_log` VALUES('268','tbl_journal_items','72','ADD','Added new journal items with 20201010','2','2024-10-20 20:13:57');
INSERT INTO `tbl_audit_log` VALUES('269','tbl_general_ledger','72','ADD','Added new general ledger items with 20201010 with journal voucher ID 28','2','2024-10-20 20:13:57');
INSERT INTO `tbl_audit_log` VALUES('270','tbl_trial_balance','72','ADD','Added new trial balance items with 20201010 with journal voucher ID 28','2','2024-10-20 20:13:57');
INSERT INTO `tbl_audit_log` VALUES('271','tbl_journal_items','73','ADD','Added new journal items with 10102020','2','2024-10-20 20:13:57');
INSERT INTO `tbl_audit_log` VALUES('272','tbl_general_ledger','73','ADD','Added new general ledger items with 10102020 with journal voucher ID 28','2','2024-10-20 20:13:57');
INSERT INTO `tbl_audit_log` VALUES('273','tbl_trial_balance','73','ADD','Added new trial balance items with 10102020 with journal voucher ID 28','2','2024-10-20 20:13:57');
INSERT INTO `tbl_audit_log` VALUES('274','tbl_journal_entry','29','ADD','Added new journal entry with voucher number 23-0005','2','2024-10-20 20:16:39');
INSERT INTO `tbl_audit_log` VALUES('275','tbl_journal_items','74','ADD','Added new journal items with 10101020','2','2024-10-20 20:16:39');
INSERT INTO `tbl_audit_log` VALUES('276','tbl_general_ledger','74','ADD','Added new general ledger items with 10101020 with journal voucher ID 29','2','2024-10-20 20:16:39');
INSERT INTO `tbl_audit_log` VALUES('277','tbl_trial_balance','74','ADD','Added new trial balance items with 10101020 with journal voucher ID 29','2','2024-10-20 20:16:39');
INSERT INTO `tbl_audit_log` VALUES('278','tbl_journal_items','75','ADD','Added new journal items with 10102020','2','2024-10-20 20:16:39');
INSERT INTO `tbl_audit_log` VALUES('279','tbl_general_ledger','75','ADD','Added new general ledger items with 10102020 with journal voucher ID 29','2','2024-10-20 20:16:39');
INSERT INTO `tbl_audit_log` VALUES('280','tbl_trial_balance','75','ADD','Added new trial balance items with 10102020 with journal voucher ID 29','2','2024-10-20 20:16:39');
INSERT INTO `tbl_audit_log` VALUES('281','tbl_journal_entry','30','ADD','Added new journal entry with voucher number 23-0006','2','2024-10-20 20:20:28');
INSERT INTO `tbl_audit_log` VALUES('282','tbl_journal_items','76','ADD','Added new journal items with 50101010','2','2024-10-20 20:20:28');
INSERT INTO `tbl_audit_log` VALUES('283','tbl_general_ledger','76','ADD','Added new general ledger items with 50101010 with journal voucher ID 30','2','2024-10-20 20:20:28');
INSERT INTO `tbl_audit_log` VALUES('284','tbl_trial_balance','76','ADD','Added new trial balance items with 50101010 with journal voucher ID 30','2','2024-10-20 20:20:28');
INSERT INTO `tbl_audit_log` VALUES('285','tbl_journal_items','77','ADD','Added new journal items with 20201020','2','2024-10-20 20:20:28');
INSERT INTO `tbl_audit_log` VALUES('286','tbl_general_ledger','77','ADD','Added new general ledger items with 20201020 with journal voucher ID 30','2','2024-10-20 20:20:28');
INSERT INTO `tbl_audit_log` VALUES('287','tbl_trial_balance','77','ADD','Added new trial balance items with 20201020 with journal voucher ID 30','2','2024-10-20 20:20:28');
INSERT INTO `tbl_audit_log` VALUES('288','tbl_journal_items','78','ADD','Added new journal items with 20201030','2','2024-10-20 20:20:28');
INSERT INTO `tbl_audit_log` VALUES('289','tbl_general_ledger','78','ADD','Added new general ledger items with 20201030 with journal voucher ID 30','2','2024-10-20 20:20:28');
INSERT INTO `tbl_audit_log` VALUES('290','tbl_trial_balance','78','ADD','Added new trial balance items with 20201030 with journal voucher ID 30','2','2024-10-20 20:20:28');
INSERT INTO `tbl_audit_log` VALUES('291','tbl_journal_items','79','ADD','Added new journal items with 20201040','2','2024-10-20 20:20:28');
INSERT INTO `tbl_audit_log` VALUES('292','tbl_general_ledger','79','ADD','Added new general ledger items with 20201040 with journal voucher ID 30','2','2024-10-20 20:20:28');
INSERT INTO `tbl_audit_log` VALUES('293','tbl_trial_balance','79','ADD','Added new trial balance items with 20201040 with journal voucher ID 30','2','2024-10-20 20:20:28');
INSERT INTO `tbl_audit_log` VALUES('294','tbl_journal_items','80','ADD','Added new journal items with 10102020','2','2024-10-20 20:20:28');
INSERT INTO `tbl_audit_log` VALUES('295','tbl_general_ledger','80','ADD','Added new general ledger items with 10102020 with journal voucher ID 30','2','2024-10-20 20:20:28');
INSERT INTO `tbl_audit_log` VALUES('296','tbl_trial_balance','80','ADD','Added new trial balance items with 10102020 with journal voucher ID 30','2','2024-10-20 20:20:28');
INSERT INTO `tbl_audit_log` VALUES('297','tbl_journal_entry','31','ADD','Added new journal entry with voucher number 23-0007','2','2024-10-20 20:25:17');
INSERT INTO `tbl_audit_log` VALUES('298','tbl_journal_items','81','ADD','Added new journal items with 10404020','2','2024-10-20 20:25:17');
INSERT INTO `tbl_audit_log` VALUES('299','tbl_general_ledger','81','ADD','Added new general ledger items with 10404020 with journal voucher ID 31','2','2024-10-20 20:25:17');
INSERT INTO `tbl_audit_log` VALUES('300','tbl_trial_balance','81','ADD','Added new trial balance items with 10404020 with journal voucher ID 31','2','2024-10-20 20:25:17');
INSERT INTO `tbl_audit_log` VALUES('301','tbl_journal_items','82','ADD','Added new journal items with 10404120','2','2024-10-20 20:25:17');
INSERT INTO `tbl_audit_log` VALUES('302','tbl_general_ledger','82','ADD','Added new general ledger items with 10404120 with journal voucher ID 31','2','2024-10-20 20:25:17');
INSERT INTO `tbl_audit_log` VALUES('303','tbl_trial_balance','82','ADD','Added new trial balance items with 10404120 with journal voucher ID 31','2','2024-10-20 20:25:17');
INSERT INTO `tbl_audit_log` VALUES('304','tbl_journal_items','83','ADD','Added new journal items with 10404990','2','2024-10-20 20:25:17');
INSERT INTO `tbl_audit_log` VALUES('305','tbl_general_ledger','83','ADD','Added new general ledger items with 10404990 with journal voucher ID 31','2','2024-10-20 20:25:17');
INSERT INTO `tbl_audit_log` VALUES('306','tbl_trial_balance','83','ADD','Added new trial balance items with 10404990 with journal voucher ID 31','2','2024-10-20 20:25:17');
INSERT INTO `tbl_audit_log` VALUES('307','tbl_journal_items','84','ADD','Added new journal items with 20101010','2','2024-10-20 20:25:17');
INSERT INTO `tbl_audit_log` VALUES('308','tbl_general_ledger','84','ADD','Added new general ledger items with 20101010 with journal voucher ID 31','2','2024-10-20 20:25:17');
INSERT INTO `tbl_audit_log` VALUES('309','tbl_trial_balance','84','ADD','Added new trial balance items with 20101010 with journal voucher ID 31','2','2024-10-20 20:25:17');
INSERT INTO `tbl_audit_log` VALUES('310','tbl_journal_entry','32','ADD','Added new journal entry with voucher number 23-0008','2','2024-10-20 20:32:13');
INSERT INTO `tbl_audit_log` VALUES('311','tbl_journal_items','85','ADD','Added new journal items with 10102020','2','2024-10-20 20:32:13');
INSERT INTO `tbl_audit_log` VALUES('312','tbl_general_ledger','85','ADD','Added new general ledger items with 10102020 with journal voucher ID 32','2','2024-10-20 20:32:13');
INSERT INTO `tbl_audit_log` VALUES('313','tbl_trial_balance','85','ADD','Added new trial balance items with 10102020 with journal voucher ID 32','2','2024-10-20 20:32:13');
INSERT INTO `tbl_audit_log` VALUES('314','tbl_journal_items','86','ADD','Added new journal items with 20101040','2','2024-10-20 20:32:13');
INSERT INTO `tbl_audit_log` VALUES('315','tbl_general_ledger','86','ADD','Added new general ledger items with 20101040 with journal voucher ID 32','2','2024-10-20 20:32:13');
INSERT INTO `tbl_audit_log` VALUES('316','tbl_trial_balance','86','ADD','Added new trial balance items with 20101040 with journal voucher ID 32','2','2024-10-20 20:32:13');
INSERT INTO `tbl_audit_log` VALUES('317','tbl_journal_entry','33','ADD','Added new journal entry with voucher number 23-0009','2','2024-10-20 20:35:43');
INSERT INTO `tbl_audit_log` VALUES('318','tbl_journal_items','87','ADD','Added new journal items with 50203010','2','2024-10-20 20:35:43');
INSERT INTO `tbl_audit_log` VALUES('319','tbl_general_ledger','87','ADD','Added new general ledger items with 50203010 with journal voucher ID 33','2','2024-10-20 20:35:43');
INSERT INTO `tbl_audit_log` VALUES('320','tbl_trial_balance','87','ADD','Added new trial balance items with 50203010 with journal voucher ID 33','2','2024-10-20 20:35:43');
INSERT INTO `tbl_audit_log` VALUES('321','tbl_journal_items','88','ADD','Added new journal items with 50203090','2','2024-10-20 20:35:43');
INSERT INTO `tbl_audit_log` VALUES('322','tbl_general_ledger','88','ADD','Added new general ledger items with 50203090 with journal voucher ID 33','2','2024-10-20 20:35:43');
INSERT INTO `tbl_audit_log` VALUES('323','tbl_trial_balance','88','ADD','Added new trial balance items with 50203090 with journal voucher ID 33','2','2024-10-20 20:35:43');
INSERT INTO `tbl_audit_log` VALUES('324','tbl_journal_items','89','ADD','Added new journal items with 50205010','2','2024-10-20 20:35:43');
INSERT INTO `tbl_audit_log` VALUES('325','tbl_general_ledger','89','ADD','Added new general ledger items with 50205010 with journal voucher ID 33','2','2024-10-20 20:35:43');
INSERT INTO `tbl_audit_log` VALUES('326','tbl_trial_balance','89','ADD','Added new trial balance items with 50205010 with journal voucher ID 33','2','2024-10-20 20:35:43');
INSERT INTO `tbl_audit_log` VALUES('327','tbl_journal_items','90','ADD','Added new journal items with 50299020','2','2024-10-20 20:35:43');
INSERT INTO `tbl_audit_log` VALUES('328','tbl_general_ledger','90','ADD','Added new general ledger items with 50299020 with journal voucher ID 33','2','2024-10-20 20:35:43');
INSERT INTO `tbl_audit_log` VALUES('329','tbl_trial_balance','90','ADD','Added new trial balance items with 50299020 with journal voucher ID 33','2','2024-10-20 20:35:43');
INSERT INTO `tbl_audit_log` VALUES('330','tbl_journal_items','91','ADD','Added new journal items with 50299030','2','2024-10-20 20:35:43');
INSERT INTO `tbl_audit_log` VALUES('331','tbl_general_ledger','91','ADD','Added new general ledger items with 50299030 with journal voucher ID 33','2','2024-10-20 20:35:43');
INSERT INTO `tbl_audit_log` VALUES('332','tbl_trial_balance','91','ADD','Added new trial balance items with 50299030 with journal voucher ID 33','2','2024-10-20 20:35:43');
INSERT INTO `tbl_audit_log` VALUES('333','tbl_journal_items','92','ADD','Added new journal items with 50213030','2','2024-10-20 20:35:43');
INSERT INTO `tbl_audit_log` VALUES('334','tbl_general_ledger','92','ADD','Added new general ledger items with 50213030 with journal voucher ID 33','2','2024-10-20 20:35:43');
INSERT INTO `tbl_audit_log` VALUES('335','tbl_trial_balance','92','ADD','Added new trial balance items with 50213030 with journal voucher ID 33','2','2024-10-20 20:35:43');
INSERT INTO `tbl_audit_log` VALUES('336','tbl_journal_items','93','ADD','Added new journal items with 10102020','2','2024-10-20 20:35:43');
INSERT INTO `tbl_audit_log` VALUES('337','tbl_general_ledger','93','ADD','Added new general ledger items with 10102020 with journal voucher ID 33','2','2024-10-20 20:35:43');
INSERT INTO `tbl_audit_log` VALUES('338','tbl_trial_balance','93','ADD','Added new trial balance items with 10102020 with journal voucher ID 33','2','2024-10-20 20:35:43');
INSERT INTO `tbl_audit_log` VALUES('339','tbl_journal_entry','34','ADD','Added new journal entry with voucher number 23-0010','2','2024-10-20 20:41:44');
INSERT INTO `tbl_audit_log` VALUES('340','tbl_journal_items','94','ADD','Added new journal items with 40202090','2','2024-10-20 20:41:44');
INSERT INTO `tbl_audit_log` VALUES('341','tbl_general_ledger','94','ADD','Added new general ledger items with 40202090 with journal voucher ID 34','2','2024-10-20 20:41:44');
INSERT INTO `tbl_audit_log` VALUES('342','tbl_trial_balance','94','ADD','Added new trial balance items with 40202090 with journal voucher ID 34','2','2024-10-20 20:41:44');
INSERT INTO `tbl_audit_log` VALUES('343','tbl_journal_items','95','ADD','Added new journal items with 40202230','2','2024-10-20 20:41:44');
INSERT INTO `tbl_audit_log` VALUES('344','tbl_general_ledger','95','ADD','Added new general ledger items with 40202230 with journal voucher ID 34','2','2024-10-20 20:41:44');
INSERT INTO `tbl_audit_log` VALUES('345','tbl_trial_balance','95','ADD','Added new trial balance items with 40202230 with journal voucher ID 34','2','2024-10-20 20:41:44');
INSERT INTO `tbl_audit_log` VALUES('346','tbl_journal_items','96','ADD','Added new journal items with 50101010','2','2024-10-20 20:41:44');
INSERT INTO `tbl_audit_log` VALUES('347','tbl_general_ledger','96','ADD','Added new general ledger items with 50101010 with journal voucher ID 34','2','2024-10-20 20:41:44');
INSERT INTO `tbl_audit_log` VALUES('348','tbl_trial_balance','96','ADD','Added new trial balance items with 50101010 with journal voucher ID 34','2','2024-10-20 20:41:44');
INSERT INTO `tbl_audit_log` VALUES('349','tbl_journal_items','97','ADD','Added new journal items with 50203010','2','2024-10-20 20:41:44');
INSERT INTO `tbl_audit_log` VALUES('350','tbl_general_ledger','97','ADD','Added new general ledger items with 50203010 with journal voucher ID 34','2','2024-10-20 20:41:44');
INSERT INTO `tbl_audit_log` VALUES('351','tbl_trial_balance','97','ADD','Added new trial balance items with 50203010 with journal voucher ID 34','2','2024-10-20 20:41:44');
INSERT INTO `tbl_audit_log` VALUES('352','tbl_journal_items','98','ADD','Added new journal items with 50203090','2','2024-10-20 20:41:44');
INSERT INTO `tbl_audit_log` VALUES('353','tbl_general_ledger','98','ADD','Added new general ledger items with 50203090 with journal voucher ID 34','2','2024-10-20 20:41:44');
INSERT INTO `tbl_audit_log` VALUES('354','tbl_trial_balance','98','ADD','Added new trial balance items with 50203090 with journal voucher ID 34','2','2024-10-20 20:41:44');
INSERT INTO `tbl_audit_log` VALUES('355','tbl_journal_items','99','ADD','Added new journal items with 50205010','2','2024-10-20 20:41:44');
INSERT INTO `tbl_audit_log` VALUES('356','tbl_general_ledger','99','ADD','Added new general ledger items with 50205010 with journal voucher ID 34','2','2024-10-20 20:41:44');
INSERT INTO `tbl_audit_log` VALUES('357','tbl_trial_balance','99','ADD','Added new trial balance items with 50205010 with journal voucher ID 34','2','2024-10-20 20:41:44');
INSERT INTO `tbl_audit_log` VALUES('358','tbl_journal_items','100','ADD','Added new journal items with 50213030','2','2024-10-20 20:41:44');
INSERT INTO `tbl_audit_log` VALUES('359','tbl_general_ledger','100','ADD','Added new general ledger items with 50213030 with journal voucher ID 34','2','2024-10-20 20:41:44');
INSERT INTO `tbl_audit_log` VALUES('360','tbl_trial_balance','100','ADD','Added new trial balance items with 50213030 with journal voucher ID 34','2','2024-10-20 20:41:44');
INSERT INTO `tbl_audit_log` VALUES('361','tbl_journal_items','101','ADD','Added new journal items with 50299020','2','2024-10-20 20:41:44');
INSERT INTO `tbl_audit_log` VALUES('362','tbl_general_ledger','101','ADD','Added new general ledger items with 50299020 with journal voucher ID 34','2','2024-10-20 20:41:44');
INSERT INTO `tbl_audit_log` VALUES('363','tbl_trial_balance','101','ADD','Added new trial balance items with 50299020 with journal voucher ID 34','2','2024-10-20 20:41:44');
INSERT INTO `tbl_audit_log` VALUES('364','tbl_journal_items','102','ADD','Added new journal items with 50299030','2','2024-10-20 20:41:44');
INSERT INTO `tbl_audit_log` VALUES('365','tbl_general_ledger','102','ADD','Added new general ledger items with 50299030 with journal voucher ID 34','2','2024-10-20 20:41:44');
INSERT INTO `tbl_audit_log` VALUES('366','tbl_trial_balance','102','ADD','Added new trial balance items with 50299030 with journal voucher ID 34','2','2024-10-20 20:41:44');
INSERT INTO `tbl_audit_log` VALUES('367','tbl_journal_items','103','ADD','Added new journal items with 30701010','2','2024-10-20 20:41:44');
INSERT INTO `tbl_audit_log` VALUES('368','tbl_general_ledger','103','ADD','Added new general ledger items with 30701010 with journal voucher ID 34','2','2024-10-20 20:41:44');
INSERT INTO `tbl_audit_log` VALUES('369','tbl_trial_balance','103','ADD','Added new trial balance items with 30701010 with journal voucher ID 34','2','2024-10-20 20:41:44');
INSERT INTO `tbl_audit_log` VALUES('370','tbl_user','2','LOGOUT','Cashier user2 has logged out into the system','2','2024-10-20 20:42:28');
INSERT INTO `tbl_audit_log` VALUES('371','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-20 20:42:33');
INSERT INTO `tbl_audit_log` VALUES('372','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-10-20 21:29:42');
INSERT INTO `tbl_audit_log` VALUES('373','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-20 21:29:45');
INSERT INTO `tbl_audit_log` VALUES('374','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-10-20 22:03:41');
INSERT INTO `tbl_audit_log` VALUES('375','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-20 22:08:19');
INSERT INTO `tbl_audit_log` VALUES('376','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-10-20 22:11:27');
INSERT INTO `tbl_audit_log` VALUES('377','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-21 08:11:10');
INSERT INTO `tbl_audit_log` VALUES('378','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-10-21 08:11:18');
INSERT INTO `tbl_audit_log` VALUES('379','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-21 09:02:36');
INSERT INTO `tbl_audit_log` VALUES('380','tbl_fiscal_year','9','ADD','Inserted new fiscal_year: F.Y-2027 and it is currently Inactive','1','2024-10-21 09:06:09');
INSERT INTO `tbl_audit_log` VALUES('381','tbl_user','0','UPDATE','Updated Fiscal Status of 3','1','2024-10-21 09:06:27');
INSERT INTO `tbl_audit_log` VALUES('382','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-10-21 09:06:36');
INSERT INTO `tbl_audit_log` VALUES('383','tbl_user','2','LOGIN','Cashier user2 has logged in into the system','2','2024-10-21 09:06:49');
INSERT INTO `tbl_audit_log` VALUES('384','tbl_journal_entry','35','ADD','Added new journal entry with voucher number 24-0007','2','2024-10-21 09:21:53');
INSERT INTO `tbl_audit_log` VALUES('385','tbl_journal_items','104','ADD','Added new journal items with 10101010','2','2024-10-21 09:21:53');
INSERT INTO `tbl_audit_log` VALUES('386','tbl_general_ledger','104','ADD','Added new general ledger items with 10101010 with journal voucher ID 35','2','2024-10-21 09:21:53');
INSERT INTO `tbl_audit_log` VALUES('387','tbl_trial_balance','104','ADD','Added new trial balance items with 10101010 with journal voucher ID 35','2','2024-10-21 09:21:53');
INSERT INTO `tbl_audit_log` VALUES('388','tbl_journal_items','105','ADD','Added new journal items with 20101010','2','2024-10-21 09:21:53');
INSERT INTO `tbl_audit_log` VALUES('389','tbl_general_ledger','105','ADD','Added new general ledger items with 20101010 with journal voucher ID 35','2','2024-10-21 09:21:53');
INSERT INTO `tbl_audit_log` VALUES('390','tbl_trial_balance','105','ADD','Added new trial balance items with 20101010 with journal voucher ID 35','2','2024-10-21 09:21:53');
INSERT INTO `tbl_audit_log` VALUES('391','tbl_journal_entry','36','ADD','Added new journal entry with voucher number 24-0008','2','2024-10-21 09:24:18');
INSERT INTO `tbl_audit_log` VALUES('392','tbl_journal_items','106','ADD','Added new journal items with 50101010','2','2024-10-21 09:24:18');
INSERT INTO `tbl_audit_log` VALUES('393','tbl_general_ledger','106','ADD','Added new general ledger items with 50101010 with journal voucher ID 36','2','2024-10-21 09:24:18');
INSERT INTO `tbl_audit_log` VALUES('394','tbl_trial_balance','106','ADD','Added new trial balance items with 50101010 with journal voucher ID 36','2','2024-10-21 09:24:18');
INSERT INTO `tbl_audit_log` VALUES('395','tbl_journal_items','107','ADD','Added new journal items with 10101010','2','2024-10-21 09:24:18');
INSERT INTO `tbl_audit_log` VALUES('396','tbl_general_ledger','107','ADD','Added new general ledger items with 10101010 with journal voucher ID 36','2','2024-10-21 09:24:18');
INSERT INTO `tbl_audit_log` VALUES('397','tbl_trial_balance','107','ADD','Added new trial balance items with 10101010 with journal voucher ID 36','2','2024-10-21 09:24:18');
INSERT INTO `tbl_audit_log` VALUES('398','tbl_journal_entry','37','ADD','Added new journal entry with voucher number 24-0009','2','2024-10-21 09:26:00');
INSERT INTO `tbl_audit_log` VALUES('399','tbl_journal_items','108','ADD','Added new journal items with 10101010','2','2024-10-21 09:26:00');
INSERT INTO `tbl_audit_log` VALUES('400','tbl_general_ledger','108','ADD','Added new general ledger items with 10101010 with journal voucher ID 37','2','2024-10-21 09:26:00');
INSERT INTO `tbl_audit_log` VALUES('401','tbl_trial_balance','108','ADD','Added new trial balance items with 10101010 with journal voucher ID 37','2','2024-10-21 09:26:00');
INSERT INTO `tbl_audit_log` VALUES('402','tbl_journal_items','109','ADD','Added new journal items with 40202090','2','2024-10-21 09:26:00');
INSERT INTO `tbl_audit_log` VALUES('403','tbl_general_ledger','109','ADD','Added new general ledger items with 40202090 with journal voucher ID 37','2','2024-10-21 09:26:00');
INSERT INTO `tbl_audit_log` VALUES('404','tbl_trial_balance','109','ADD','Added new trial balance items with 40202090 with journal voucher ID 37','2','2024-10-21 09:26:00');
INSERT INTO `tbl_audit_log` VALUES('405','tbl_journal_items','110','ADD','Added new journal items with 40202230','2','2024-10-21 09:26:00');
INSERT INTO `tbl_audit_log` VALUES('406','tbl_general_ledger','110','ADD','Added new general ledger items with 40202230 with journal voucher ID 37','2','2024-10-21 09:26:00');
INSERT INTO `tbl_audit_log` VALUES('407','tbl_trial_balance','110','ADD','Added new trial balance items with 40202230 with journal voucher ID 37','2','2024-10-21 09:26:00');
INSERT INTO `tbl_audit_log` VALUES('408','tbl_journal_entry','38','ADD','Added new journal entry with voucher number 24-0010','2','2024-10-21 09:45:43');
INSERT INTO `tbl_audit_log` VALUES('409','tbl_journal_items','111','ADD','Added new journal items with 10102020','2','2024-10-21 09:45:43');
INSERT INTO `tbl_audit_log` VALUES('410','tbl_general_ledger','111','ADD','Added new general ledger items with 10102020 with journal voucher ID 38','2','2024-10-21 09:45:43');
INSERT INTO `tbl_audit_log` VALUES('411','tbl_trial_balance','111','ADD','Added new trial balance items with 10102020 with journal voucher ID 38','2','2024-10-21 09:45:43');
INSERT INTO `tbl_audit_log` VALUES('412','tbl_journal_items','112','ADD','Added new journal items with 10101010','2','2024-10-21 09:45:43');
INSERT INTO `tbl_audit_log` VALUES('413','tbl_general_ledger','112','ADD','Added new general ledger items with 10101010 with journal voucher ID 38','2','2024-10-21 09:45:43');
INSERT INTO `tbl_audit_log` VALUES('414','tbl_trial_balance','112','ADD','Added new trial balance items with 10101010 with journal voucher ID 38','2','2024-10-21 09:45:43');
INSERT INTO `tbl_audit_log` VALUES('415','tbl_user','2','LOGOUT','Cashier user2 has logged out into the system','2','2024-10-21 10:04:30');
INSERT INTO `tbl_audit_log` VALUES('416','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-21 10:04:33');
INSERT INTO `tbl_audit_log` VALUES('417','tbl_user','0','UPDATE','Updated Fiscal Status of 4','1','2024-10-21 10:05:05');
INSERT INTO `tbl_audit_log` VALUES('418','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-10-21 10:05:06');
INSERT INTO `tbl_audit_log` VALUES('419','tbl_user','2','LOGIN','Cashier user2 has logged in into the system','2','2024-10-21 10:05:11');
INSERT INTO `tbl_audit_log` VALUES('420','tbl_user','2','LOGOUT','Cashier user2 has logged out into the system','2','2024-10-21 10:06:23');
INSERT INTO `tbl_audit_log` VALUES('421','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-21 10:06:26');
INSERT INTO `tbl_audit_log` VALUES('422','tbl_user','0','UPDATE','Updated Fiscal Status of 3','1','2024-10-21 10:11:46');
INSERT INTO `tbl_audit_log` VALUES('423','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-10-21 10:11:47');
INSERT INTO `tbl_audit_log` VALUES('424','tbl_user','2','LOGIN','Cashier user2 has logged in into the system','2','2024-10-21 10:11:54');
INSERT INTO `tbl_audit_log` VALUES('425','tbl_user','2','LOGOUT','Cashier user2 has logged out into the system','2','2024-10-21 12:56:01');
INSERT INTO `tbl_audit_log` VALUES('426','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-21 13:10:20');
INSERT INTO `tbl_audit_log` VALUES('427','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-10-21 13:26:38');
INSERT INTO `tbl_audit_log` VALUES('428','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-21 13:41:50');
INSERT INTO `tbl_audit_log` VALUES('429','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-10-21 15:24:21');
INSERT INTO `tbl_audit_log` VALUES('430','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-22 08:12:12');
INSERT INTO `tbl_audit_log` VALUES('431','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-10-22 08:12:16');
INSERT INTO `tbl_audit_log` VALUES('432','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-22 08:12:29');
INSERT INTO `tbl_audit_log` VALUES('433','tbl_user_info','12','ADD','Added new user named: Joan on ID 12','1','2024-10-22 08:14:12');
INSERT INTO `tbl_audit_log` VALUES('434','tbl_user','12','ADD','Added new user with username user3','1','2024-10-22 08:14:12');
INSERT INTO `tbl_audit_log` VALUES('435','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-10-22 08:14:18');
INSERT INTO `tbl_audit_log` VALUES('436','tbl_user','12','LOGIN','Accounting Processoruser3 has logged in into the system','12','2024-10-22 08:14:23');
INSERT INTO `tbl_audit_log` VALUES('437','tbl_user','12','LOGOUT','Accounting Processor user3 has logged out into the system','12','2024-10-22 08:26:30');
INSERT INTO `tbl_audit_log` VALUES('438','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-22 08:26:34');
INSERT INTO `tbl_audit_log` VALUES('439','tbl_journal_entry','39','ADD','Added new journal entry with voucher number 24-0011','1','2024-10-22 08:41:32');
INSERT INTO `tbl_audit_log` VALUES('440','tbl_journal_items','113','ADD','Added new journal items with 10606010','1','2024-10-22 08:41:32');
INSERT INTO `tbl_audit_log` VALUES('441','tbl_journal_items','114','ADD','Added new journal items with 10102020','1','2024-10-22 08:41:32');
INSERT INTO `tbl_audit_log` VALUES('442','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-10-22 11:14:38');
INSERT INTO `tbl_audit_log` VALUES('443','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-22 16:39:13');
INSERT INTO `tbl_audit_log` VALUES('444','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-10-22 17:07:58');
INSERT INTO `tbl_audit_log` VALUES('445','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-22 19:26:17');
INSERT INTO `tbl_audit_log` VALUES('447','tbl_user','39','UPDATE','Updated Journal Status of 39','1','2024-10-22 20:22:14');
INSERT INTO `tbl_audit_log` VALUES('448','tbl_user','12','LOGIN','Accounting Processoruser3 has logged in into the system','12','2024-10-22 20:23:26');
INSERT INTO `tbl_audit_log` VALUES('449','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-10-22 21:47:42');
INSERT INTO `tbl_audit_log` VALUES('450','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-22 21:57:39');
INSERT INTO `tbl_audit_log` VALUES('451','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-23 07:34:22');
INSERT INTO `tbl_audit_log` VALUES('452','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-23 17:38:53');
INSERT INTO `tbl_audit_log` VALUES('453','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-10-23 18:07:15');
INSERT INTO `tbl_audit_log` VALUES('454','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-23 18:47:04');
INSERT INTO `tbl_audit_log` VALUES('455','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-10-23 18:47:31');
INSERT INTO `tbl_audit_log` VALUES('456','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-28 09:55:11');
INSERT INTO `tbl_audit_log` VALUES('457','tbl_journal_entry','40','INSERT','Added new journal entry with voucher number 24-0013','1','2024-10-28 09:57:29');
INSERT INTO `tbl_audit_log` VALUES('458','tbl_journal_items','115','INSERT','Added new journal items with 10102020','1','2024-10-28 09:57:29');
INSERT INTO `tbl_audit_log` VALUES('459','tbl_journal_items','116','INSERT','Added new journal items with 10101010','1','2024-10-28 09:57:29');
INSERT INTO `tbl_audit_log` VALUES('460','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-28 18:11:22');
INSERT INTO `tbl_audit_log` VALUES('461','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-10-29 11:55:51');
INSERT INTO `tbl_audit_log` VALUES('462','tbl_user','2','LOGIN','Cashier user2 has logged in into the system','2','2024-10-29 12:55:56');
INSERT INTO `tbl_audit_log` VALUES('463','tbl_user','2','LOGOUT','Cashier user2 has logged out into the system','2','2024-10-29 13:23:46');
INSERT INTO `tbl_audit_log` VALUES('464','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-29 18:30:14');
INSERT INTO `tbl_audit_log` VALUES('465','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-10-29 19:28:14');
INSERT INTO `tbl_audit_log` VALUES('466','tbl_user','12','LOGIN','Accounting Processoruser3 has logged in into the system','12','2024-10-29 19:28:18');
INSERT INTO `tbl_audit_log` VALUES('467','tbl_user','12','LOGOUT','Accounting Processor user3 has logged out into the system','12','2024-10-29 19:46:50');
INSERT INTO `tbl_audit_log` VALUES('468','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-29 19:46:59');
INSERT INTO `tbl_audit_log` VALUES('469','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-10-29 19:47:17');
INSERT INTO `tbl_audit_log` VALUES('470','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-29 19:52:38');
INSERT INTO `tbl_audit_log` VALUES('471','tbl_account_type','5','UPDATE','Updated Type ID 5','1','2024-10-30 02:29:51');
INSERT INTO `tbl_audit_log` VALUES('472','tbl_account_type','5','UPDATE','Updated Type ID 5','1','2024-10-30 02:30:13');
INSERT INTO `tbl_audit_log` VALUES('473','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-30 07:09:11');
INSERT INTO `tbl_audit_log` VALUES('474','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-10-30 07:24:28');
INSERT INTO `tbl_audit_log` VALUES('475','tbl_user','2','LOGIN','Cashier user2 has logged in into the system','2','2024-10-30 07:24:35');
INSERT INTO `tbl_audit_log` VALUES('476','tbl_user','12','LOGIN','Accounting Processoruser3 has logged in into the system','12','2024-10-30 07:26:37');
INSERT INTO `tbl_audit_log` VALUES('477','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-30 07:28:48');
INSERT INTO `tbl_audit_log` VALUES('478','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-10-30 09:46:39');
INSERT INTO `tbl_audit_log` VALUES('479','tbl_user','2','LOGIN','Cashier user2 has logged in into the system','2','2024-10-30 09:48:49');
INSERT INTO `tbl_audit_log` VALUES('480','tbl_user','2','LOGOUT','Cashier user2 has logged out into the system','2','2024-10-30 09:49:25');
INSERT INTO `tbl_audit_log` VALUES('481','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-30 09:49:30');
INSERT INTO `tbl_audit_log` VALUES('482','tbl_fiscal_year','2','UPDATE','Updated Fiscal Status of fiscal ID 2 to Active','1','2024-10-30 09:49:50');
INSERT INTO `tbl_audit_log` VALUES('483','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-10-30 09:49:52');
INSERT INTO `tbl_audit_log` VALUES('484','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-30 09:49:57');
INSERT INTO `tbl_audit_log` VALUES('485','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-10-30 13:12:01');
INSERT INTO `tbl_audit_log` VALUES('486','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-30 13:12:04');
INSERT INTO `tbl_audit_log` VALUES('487','tbl_fiscal_year','3','UPDATE','Updated Fiscal Status of fiscal ID 3 to Active','1','2024-10-30 13:13:26');
INSERT INTO `tbl_audit_log` VALUES('488','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-10-30 13:13:27');
INSERT INTO `tbl_audit_log` VALUES('489','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-30 13:13:31');
INSERT INTO `tbl_audit_log` VALUES('490','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-10-30 13:15:57');
INSERT INTO `tbl_audit_log` VALUES('491','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-31 07:24:59');
INSERT INTO `tbl_audit_log` VALUES('492','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-31 10:33:29');
INSERT INTO `tbl_audit_log` VALUES('493','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-10-31 11:07:03');
INSERT INTO `tbl_audit_log` VALUES('494','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-31 11:07:14');
INSERT INTO `tbl_audit_log` VALUES('495','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-10-31 11:12:54');
INSERT INTO `tbl_audit_log` VALUES('496','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-31 11:13:05');
INSERT INTO `tbl_audit_log` VALUES('497','tbl_journal_category','2','ADD','Inserted new signatory: ','1','2024-10-31 11:29:50');
INSERT INTO `tbl_audit_log` VALUES('498','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-31 12:06:17');
INSERT INTO `tbl_audit_log` VALUES('499','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-31 14:28:41');
INSERT INTO `tbl_audit_log` VALUES('500','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-10-31 14:28:58');
INSERT INTO `tbl_audit_log` VALUES('501','tbl_user','2','LOGIN','Cashier user2 has logged in into the system','2','2024-10-31 14:29:03');
INSERT INTO `tbl_audit_log` VALUES('502','tbl_user','2','LOGOUT','Cashier user2 has logged out into the system','2','2024-10-31 15:01:19');
INSERT INTO `tbl_audit_log` VALUES('503','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-31 15:01:22');
INSERT INTO `tbl_audit_log` VALUES('504','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-10-31 15:01:38');
INSERT INTO `tbl_audit_log` VALUES('505','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-10-31 15:02:39');
INSERT INTO `tbl_audit_log` VALUES('506','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-10-31 15:04:33');
INSERT INTO `tbl_audit_log` VALUES('507','tbl_user','2','LOGIN','Cashier user2 has logged in into the system','2','2024-10-31 15:04:37');
INSERT INTO `tbl_audit_log` VALUES('508','tbl_user','2','LOGOUT','Cashier user2 has logged out into the system','2','2024-10-31 15:52:34');
INSERT INTO `tbl_audit_log` VALUES('509','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-11-01 05:06:27');
INSERT INTO `tbl_audit_log` VALUES('510','tbl_user','2','LOGIN','Cashier user2 has logged in into the system','2','2024-11-03 17:58:11');
INSERT INTO `tbl_audit_log` VALUES('511','tbl_journal_entry','41','INSERT','Added new journal entry with voucher number 23-0011','2','2024-11-03 18:05:43');
INSERT INTO `tbl_audit_log` VALUES('512','tbl_journal_items','117','INSERT','Added new journal items with 10102020','2','2024-11-03 18:05:43');
INSERT INTO `tbl_audit_log` VALUES('513','tbl_journal_items','118','INSERT','Added new journal items with 10101010','2','2024-11-03 18:05:43');
INSERT INTO `tbl_audit_log` VALUES('514','tbl_user','2','LOGOUT','Cashier user2 has logged out into the system','2','2024-11-03 18:05:52');
INSERT INTO `tbl_audit_log` VALUES('515','tbl_user','12','LOGIN','Accounting Processoruser3 has logged in into the system','12','2024-11-03 18:05:58');
INSERT INTO `tbl_audit_log` VALUES('516','tbl_user','5','UPDATE','Inserted Notification  for Rejection of Journal Entry of 23-0011','12','2024-11-03 18:10:50');
INSERT INTO `tbl_audit_log` VALUES('517','tbl_user','12','LOGOUT','Accounting Processor user3 has logged out into the system','12','2024-11-03 18:21:04');
INSERT INTO `tbl_audit_log` VALUES('518','tbl_user','2','LOGIN','Cashier user2 has logged in into the system','2','2024-11-03 18:21:09');
INSERT INTO `tbl_audit_log` VALUES('519','tbl_user','2','LOGOUT','Cashier user2 has logged out into the system','2','2024-11-03 21:22:59');
INSERT INTO `tbl_audit_log` VALUES('520','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-11-03 21:23:07');
INSERT INTO `tbl_audit_log` VALUES('521','tbl_user_info','2','UPDATE','Updated User ID ','1','2024-11-03 21:26:02');
INSERT INTO `tbl_audit_log` VALUES('522','tbl_user_info','2','UPDATE','Updated User ID 2','1','2024-11-03 21:26:59');
INSERT INTO `tbl_audit_log` VALUES('523','tbl_user','0','UPDATE','Updated Fiscal Status of ','1','2024-11-03 21:38:29');
INSERT INTO `tbl_audit_log` VALUES('524','tbl_user','0','UPDATE','Updated Fiscal Status of ','1','2024-11-03 21:38:39');
INSERT INTO `tbl_audit_log` VALUES('525','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-11-04 09:05:19');
INSERT INTO `tbl_audit_log` VALUES('526','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-11-04 09:05:30');
INSERT INTO `tbl_audit_log` VALUES('527','tbl_user','2','LOGIN','Cashier user2 has logged in into the system','2','2024-11-04 09:05:36');
INSERT INTO `tbl_audit_log` VALUES('528','tbl_user','2','LOGOUT','Cashier user2 has logged out into the system','2','2024-11-04 09:05:44');
INSERT INTO `tbl_audit_log` VALUES('529','tbl_user','12','LOGIN','Accounting Processoruser3 has logged in into the system','12','2024-11-04 09:05:48');
INSERT INTO `tbl_audit_log` VALUES('530','tbl_user','12','LOGOUT','Accounting Processor user3 has logged out into the system','12','2024-11-04 09:08:17');
INSERT INTO `tbl_audit_log` VALUES('531','tbl_user','12','LOGIN','Accounting Processoruser3 has logged in into the system','12','2024-11-04 10:16:21');
INSERT INTO `tbl_audit_log` VALUES('532','tbl_user','12','LOGOUT','Accounting Processor user3 has logged out into the system','12','2024-11-04 10:18:36');
INSERT INTO `tbl_audit_log` VALUES('533','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-11-04 10:18:40');
INSERT INTO `tbl_audit_log` VALUES('534','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-11-04 13:36:47');
INSERT INTO `tbl_audit_log` VALUES('535','tbl_user','2','LOGIN','Cashier user2 has logged in into the system','2','2024-11-04 14:04:22');
INSERT INTO `tbl_audit_log` VALUES('536','tbl_user','2','LOGOUT','Cashier user2 has logged out into the system','2','2024-11-04 14:05:05');
INSERT INTO `tbl_audit_log` VALUES('537','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-11-04 14:05:10');
INSERT INTO `tbl_audit_log` VALUES('538','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-11-04 14:09:02');
INSERT INTO `tbl_audit_log` VALUES('539','tbl_user','2','LOGIN','Cashier user2 has logged in into the system','2','2024-11-04 14:09:10');
INSERT INTO `tbl_audit_log` VALUES('540','tbl_journal_entry','42','INSERT','Added new journal entry with voucher number 23-0012','2','2024-11-04 14:09:43');
INSERT INTO `tbl_audit_log` VALUES('541','tbl_journal_items','119','INSERT','Added new journal items with 10101010','2','2024-11-04 14:09:43');
INSERT INTO `tbl_audit_log` VALUES('542','tbl_journal_items','120','INSERT','Added new journal items with 10101020','2','2024-11-04 14:09:43');
INSERT INTO `tbl_audit_log` VALUES('543','tbl_user','2','LOGOUT','Cashier user2 has logged out into the system','2','2024-11-04 14:09:47');
INSERT INTO `tbl_audit_log` VALUES('544','tbl_user','12','LOGIN','Accounting Processoruser3 has logged in into the system','12','2024-11-04 14:09:51');
INSERT INTO `tbl_audit_log` VALUES('545','tbl_user','6','UPDATE','Inserted Notification  for Rejection of Journal Entry of 23-0012','12','2024-11-04 14:10:09');
INSERT INTO `tbl_audit_log` VALUES('546','tbl_user','12','LOGOUT','Accounting Processor user3 has logged out into the system','12','2024-11-04 14:10:12');
INSERT INTO `tbl_audit_log` VALUES('547','tbl_user','2','LOGIN','Cashier user2 has logged in into the system','2','2024-11-04 14:10:16');
INSERT INTO `tbl_audit_log` VALUES('548','tbl_user','2','LOGOUT','Cashier user2 has logged out into the system','2','2024-11-04 14:13:50');
INSERT INTO `tbl_audit_log` VALUES('549','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-11-04 14:14:14');
INSERT INTO `tbl_audit_log` VALUES('550','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-11-04 15:58:07');
INSERT INTO `tbl_audit_log` VALUES('551','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-11-04 15:58:13');
INSERT INTO `tbl_audit_log` VALUES('552','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-11-04 16:00:53');
INSERT INTO `tbl_audit_log` VALUES('553','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-11-04 16:01:00');
INSERT INTO `tbl_audit_log` VALUES('554','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-11-04 16:02:31');
INSERT INTO `tbl_audit_log` VALUES('555','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-11-04 16:06:22');
INSERT INTO `tbl_audit_log` VALUES('556','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-11-04 16:21:44');
INSERT INTO `tbl_audit_log` VALUES('557','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-11-04 16:22:07');
INSERT INTO `tbl_audit_log` VALUES('558','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-11-04 16:22:10');
INSERT INTO `tbl_audit_log` VALUES('559','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-11-04 17:55:41');
INSERT INTO `tbl_audit_log` VALUES('560','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-11-04 18:15:15');
INSERT INTO `tbl_audit_log` VALUES('561','tbl_user','2','LOGIN','Cashier user2 has logged in into the system','2','2024-11-04 18:15:24');
INSERT INTO `tbl_audit_log` VALUES('562','tbl_user','2','LOGOUT','Cashier user2 has logged out into the system','2','2024-11-04 18:20:12');
INSERT INTO `tbl_audit_log` VALUES('563','tbl_user','2','LOGIN','Cashier user2 has logged in into the system','2','2024-11-04 18:20:15');
INSERT INTO `tbl_audit_log` VALUES('564','tbl_user','2','LOGOUT','Cashier user2 has logged out into the system','2','2024-11-04 18:21:08');
INSERT INTO `tbl_audit_log` VALUES('565','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-11-04 18:21:12');
INSERT INTO `tbl_audit_log` VALUES('566','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-11-04 18:21:17');
INSERT INTO `tbl_audit_log` VALUES('567','tbl_user','2','LOGIN','Cashier user2 has logged in into the system','2','2024-11-04 18:21:23');
INSERT INTO `tbl_audit_log` VALUES('568','tbl_user','2','LOGIN','Cashier user2 has logged in into the system','2','2024-11-04 18:28:33');
INSERT INTO `tbl_audit_log` VALUES('569','tbl_user','2','LOGOUT','Cashier user2 has logged out into the system','2','2024-11-04 18:41:56');
INSERT INTO `tbl_audit_log` VALUES('570','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-11-04 18:42:00');
INSERT INTO `tbl_audit_log` VALUES('571','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-11-04 19:10:25');
INSERT INTO `tbl_audit_log` VALUES('572','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-11-04 19:51:21');
INSERT INTO `tbl_audit_log` VALUES('573','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-11-05 11:36:10');
INSERT INTO `tbl_audit_log` VALUES('574','tbl_user','42','UPDATE','Updated Journal Status of 42','1','2024-11-05 11:55:55');
INSERT INTO `tbl_audit_log` VALUES('575','tbl_general_ledger','113','ADD','Added new general ledger debit entry with account 10101010 for journal voucher ID 42','1','2024-11-05 11:55:55');
INSERT INTO `tbl_audit_log` VALUES('576','tbl_general_ledger','114','ADD','Added new general ledger credit entry with account 10101020 for journal voucher ID 42','1','2024-11-05 11:55:55');
INSERT INTO `tbl_audit_log` VALUES('577','tbl_user','7','UPDATE','Inserted Notification  for Rejection of Journal Entry of 23-0012','1','2024-11-05 11:55:55');
INSERT INTO `tbl_audit_log` VALUES('578','tbl_user','41','UPDATE','Updated Journal Status of 41','1','2024-11-05 11:56:21');
INSERT INTO `tbl_audit_log` VALUES('579','tbl_general_ledger','115','ADD','Added new general ledger debit entry with account 10102020 for journal voucher ID 41','1','2024-11-05 11:56:21');
INSERT INTO `tbl_audit_log` VALUES('580','tbl_general_ledger','116','ADD','Added new general ledger credit entry with account 10101010 for journal voucher ID 41','1','2024-11-05 11:56:21');
INSERT INTO `tbl_audit_log` VALUES('581','tbl_user','8','UPDATE','Inserted Notification  for Rejection of Journal Entry of 23-0011','1','2024-11-05 11:56:21');
INSERT INTO `tbl_audit_log` VALUES('582','tbl_fiscal_year','3','UPDATE','Updated Fiscal Status of fiscal ID 3 to Active','1','2024-11-05 11:56:38');
INSERT INTO `tbl_audit_log` VALUES('583','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-11-05 11:56:39');
INSERT INTO `tbl_audit_log` VALUES('584','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-11-05 11:56:43');
INSERT INTO `tbl_audit_log` VALUES('585','tbl_user','0','UPDATE','Updated Signatory Status of 2','1','2024-11-05 12:57:00');
INSERT INTO `tbl_audit_log` VALUES('586','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-11-05 14:53:22');
INSERT INTO `tbl_audit_log` VALUES('587','tbl_user','12','LOGIN','Accounting Processoruser3 has logged in into the system','12','2024-11-05 14:53:26');
INSERT INTO `tbl_audit_log` VALUES('588','tbl_user','2','LOGIN','Cashier user2 has logged in into the system','2','2024-11-05 15:32:05');
INSERT INTO `tbl_audit_log` VALUES('589','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-11-05 15:52:19');
INSERT INTO `tbl_audit_log` VALUES('590','tbl_journal_category','3','ADD','Inserted new signatory: James L Castillo','1','2024-11-05 17:14:05');
INSERT INTO `tbl_audit_log` VALUES('591','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-11-05 20:12:49');
INSERT INTO `tbl_audit_log` VALUES('592','tbl_user','2','LOGOUT','Cashier user2 has logged out into the system','2','2024-11-05 20:12:56');
INSERT INTO `tbl_audit_log` VALUES('593','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-11-05 21:06:53');
INSERT INTO `tbl_audit_log` VALUES('594','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-11-05 21:13:44');
INSERT INTO `tbl_audit_log` VALUES('595','tbl_user','2','LOGIN','Cashier user2 has logged in into the system','2','2024-11-05 21:13:48');
INSERT INTO `tbl_audit_log` VALUES('596','tbl_user','2','LOGOUT','Cashier user2 has logged out into the system','2','2024-11-05 21:14:03');
INSERT INTO `tbl_audit_log` VALUES('597','tbl_user','12','LOGIN','Accounting Processoruser3 has logged in into the system','12','2024-11-05 21:14:07');
INSERT INTO `tbl_audit_log` VALUES('598','tbl_user','12','LOGOUT','Accounting Processor user3 has logged out into the system','12','2024-11-05 21:14:37');
INSERT INTO `tbl_audit_log` VALUES('599','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-11-05 21:14:41');
INSERT INTO `tbl_audit_log` VALUES('600','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-11-05 21:23:52');
INSERT INTO `tbl_audit_log` VALUES('601','tbl_user','2','LOGIN','Cashier user2 has logged in into the system','2','2024-11-05 21:23:56');
INSERT INTO `tbl_audit_log` VALUES('602','tbl_user','2','LOGOUT','Cashier user2 has logged out into the system','2','2024-11-05 21:31:19');
INSERT INTO `tbl_audit_log` VALUES('603','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-11-05 21:31:23');
INSERT INTO `tbl_audit_log` VALUES('604','tbl_user_info','3','UPDATE','Updated User ID 3','1','2024-11-05 21:34:45');
INSERT INTO `tbl_audit_log` VALUES('605','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-11-05 21:52:52');
INSERT INTO `tbl_audit_log` VALUES('606','tbl_user','2','LOGIN','Cashier user2 has logged in into the system','2','2024-11-06 06:38:05');
INSERT INTO `tbl_audit_log` VALUES('607','tbl_journal_entry','43','INSERT','Added new journal entry with voucher number 24-0001','2','2024-11-06 06:39:54');
INSERT INTO `tbl_audit_log` VALUES('608','tbl_journal_items','121','INSERT','Added new journal items with 10607010','2','2024-11-06 06:39:54');
INSERT INTO `tbl_audit_log` VALUES('609','tbl_journal_items','122','INSERT','Added new journal items with 20101010','2','2024-11-06 06:39:54');
INSERT INTO `tbl_audit_log` VALUES('610','tbl_user','12','LOGIN','Accounting Processoruser3 has logged in into the system','12','2024-11-06 06:40:29');
INSERT INTO `tbl_audit_log` VALUES('611','tbl_user','43','UPDATE','Updated Journal Status of 43','12','2024-11-06 06:40:46');
INSERT INTO `tbl_audit_log` VALUES('612','tbl_general_ledger','117','ADD','Added new general ledger debit entry with account 10607010 for journal voucher ID 43','12','2024-11-06 06:40:46');
INSERT INTO `tbl_audit_log` VALUES('613','tbl_general_ledger','118','ADD','Added new general ledger credit entry with account 20101010 for journal voucher ID 43','12','2024-11-06 06:40:46');
INSERT INTO `tbl_audit_log` VALUES('614','tbl_user','9','UPDATE','Inserted Notification  for Rejection of Journal Entry of 24-0001','12','2024-11-06 06:40:46');
INSERT INTO `tbl_audit_log` VALUES('615','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-11-06 07:03:44');
INSERT INTO `tbl_audit_log` VALUES('616','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-11-06 08:30:31');
INSERT INTO `tbl_audit_log` VALUES('617','tbl_user','12','LOGOUT','Accounting Processor user3 has logged out into the system','12','2024-11-06 08:30:42');
INSERT INTO `tbl_audit_log` VALUES('618','tbl_user','2','LOGOUT','Cashier user2 has logged out into the system','2','2024-11-06 08:33:09');
INSERT INTO `tbl_audit_log` VALUES('619','tbl_user','12','LOGIN','Accounting Processoruser3 has logged in into the system','12','2024-11-06 09:07:58');
INSERT INTO `tbl_audit_log` VALUES('620','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-11-06 09:08:17');
INSERT INTO `tbl_audit_log` VALUES('621','tbl_journal_category','4','ADD','Inserted new signatory: Marie Ann G Fontanilla','1','2024-11-06 09:15:17');
INSERT INTO `tbl_audit_log` VALUES('622','tbl_user','0','UPDATE','Updated Signatory Status of 4','1','2024-11-06 09:15:35');
INSERT INTO `tbl_audit_log` VALUES('623','tbl_journal_entry','44','INSERT','Added new journal entry with voucher number 24-0002','1','2024-11-06 09:17:01');
INSERT INTO `tbl_audit_log` VALUES('624','tbl_journal_items','123','INSERT','Added new journal items with 10101010','1','2024-11-06 09:17:01');
INSERT INTO `tbl_audit_log` VALUES('625','tbl_journal_items','124','INSERT','Added new journal items with 10102020','1','2024-11-06 09:17:01');
INSERT INTO `tbl_audit_log` VALUES('626','tbl_user','10','UPDATE','Inserted Notification  for Rejection of Journal Entry of 24-0002','1','2024-11-06 09:17:38');
INSERT INTO `tbl_audit_log` VALUES('627','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-11-06 09:17:41');
INSERT INTO `tbl_audit_log` VALUES('628','tbl_user','2','LOGIN','Cashier user2 has logged in into the system','2','2024-11-06 09:17:46');
INSERT INTO `tbl_audit_log` VALUES('629','tbl_user','2','LOGOUT','Cashier user2 has logged out into the system','2','2024-11-06 09:18:54');
INSERT INTO `tbl_audit_log` VALUES('630','tbl_user','2','LOGIN','Cashier user2 has logged in into the system','2','2024-11-06 10:10:52');
INSERT INTO `tbl_audit_log` VALUES('631','tbl_user','12','LOGOUT','Accounting Processor user3 has logged out into the system','12','2024-11-06 10:12:26');
INSERT INTO `tbl_audit_log` VALUES('632','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-11-06 10:12:29');
INSERT INTO `tbl_audit_log` VALUES('633','tbl_user','12','LOGIN','Accounting Processoruser3 has logged in into the system','12','2024-11-06 13:32:30');
INSERT INTO `tbl_audit_log` VALUES('634','tbl_journal_entry','45','INSERT','Added new journal entry with voucher number 24-0003','2','2024-11-06 13:35:09');
INSERT INTO `tbl_audit_log` VALUES('635','tbl_journal_items','125','INSERT','Added new journal items with 10605030','2','2024-11-06 13:35:09');
INSERT INTO `tbl_audit_log` VALUES('636','tbl_journal_items','126','INSERT','Added new journal items with 20101010','2','2024-11-06 13:35:09');
INSERT INTO `tbl_audit_log` VALUES('637','tbl_user','45','UPDATE','Updated Journal Status of 45','12','2024-11-06 13:35:50');
INSERT INTO `tbl_audit_log` VALUES('638','tbl_general_ledger','119','ADD','Added new general ledger debit entry with account 10605030 for journal voucher ID 45','12','2024-11-06 13:35:50');
INSERT INTO `tbl_audit_log` VALUES('639','tbl_general_ledger','120','ADD','Added new general ledger credit entry with account 20101010 for journal voucher ID 45','12','2024-11-06 13:35:50');
INSERT INTO `tbl_audit_log` VALUES('640','tbl_user','11','UPDATE','Inserted Notification  for Rejection of Journal Entry of 24-0003','12','2024-11-06 13:35:50');
INSERT INTO `tbl_audit_log` VALUES('641','tbl_user','44','UPDATE','Updated Journal Status of 44','12','2024-11-06 13:36:21');
INSERT INTO `tbl_audit_log` VALUES('642','tbl_general_ledger','121','ADD','Added new general ledger debit entry with account 10101010 for journal voucher ID 44','12','2024-11-06 13:36:21');
INSERT INTO `tbl_audit_log` VALUES('643','tbl_general_ledger','122','ADD','Added new general ledger credit entry with account 10102020 for journal voucher ID 44','12','2024-11-06 13:36:21');
INSERT INTO `tbl_audit_log` VALUES('644','tbl_user','12','UPDATE','Inserted Notification  for Rejection of Journal Entry of 24-0002','12','2024-11-06 13:36:21');
INSERT INTO `tbl_audit_log` VALUES('645','tbl_journal_entry','46','INSERT','Added new journal entry with voucher number 24-0004','2','2024-11-06 13:49:14');
INSERT INTO `tbl_audit_log` VALUES('646','tbl_journal_items','127','INSERT','Added new journal items with 20101010','2','2024-11-06 13:49:14');
INSERT INTO `tbl_audit_log` VALUES('647','tbl_journal_items','128','INSERT','Added new journal items with 10102020','2','2024-11-06 13:49:14');
INSERT INTO `tbl_audit_log` VALUES('648','tbl_user','46','UPDATE','Updated Journal Status of 46','12','2024-11-06 13:49:40');
INSERT INTO `tbl_audit_log` VALUES('649','tbl_general_ledger','123','ADD','Added new general ledger debit entry with account 20101010 for journal voucher ID 46','12','2024-11-06 13:49:40');
INSERT INTO `tbl_audit_log` VALUES('650','tbl_general_ledger','124','ADD','Added new general ledger credit entry with account 10102020 for journal voucher ID 46','12','2024-11-06 13:49:40');
INSERT INTO `tbl_audit_log` VALUES('651','tbl_user','13','UPDATE','Inserted Notification  for Rejection of Journal Entry of 24-0004','12','2024-11-06 13:49:40');
INSERT INTO `tbl_audit_log` VALUES('652','tbl_user','2','LOGOUT','Cashier user2 has logged out into the system','2','2024-11-06 13:52:18');
INSERT INTO `tbl_audit_log` VALUES('653','tbl_user','2','LOGIN','Cashier user2 has logged in into the system','2','2024-11-06 14:10:32');
INSERT INTO `tbl_audit_log` VALUES('654','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-11-06 14:14:52');
INSERT INTO `tbl_audit_log` VALUES('655','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-11-06 14:14:57');
INSERT INTO `tbl_audit_log` VALUES('656','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-11-06 14:17:01');
INSERT INTO `tbl_audit_log` VALUES('657','tbl_user','12','LOGOUT','Accounting Processor user3 has logged out into the system','12','2024-11-06 15:41:02');
INSERT INTO `tbl_audit_log` VALUES('658','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-11-11 14:03:06');
INSERT INTO `tbl_audit_log` VALUES('659','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-11-11 14:08:43');
INSERT INTO `tbl_audit_log` VALUES('660','tbl_user','12','LOGIN','Accounting Processoruser3 has logged in into the system','12','2024-11-11 14:08:49');
INSERT INTO `tbl_audit_log` VALUES('661','tbl_user','12','LOGOUT','Accounting Processor user3 has logged out into the system','12','2024-11-11 14:09:10');
INSERT INTO `tbl_audit_log` VALUES('662','tbl_user','2','LOGIN','Cashier user2 has logged in into the system','2','2024-11-11 14:09:42');
INSERT INTO `tbl_audit_log` VALUES('663','tbl_user','2','LOGOUT','Cashier user2 has logged out into the system','2','2024-11-11 14:12:26');
INSERT INTO `tbl_audit_log` VALUES('664','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-11-11 14:12:30');
INSERT INTO `tbl_audit_log` VALUES('665','tbl_user_info','2','UPDATE','Updated User ID 2','1','2024-11-11 16:53:33');
INSERT INTO `tbl_audit_log` VALUES('666','tbl_journal_entry','47','INSERT','Added new journal entry with voucher number 24-0005','1','2024-11-11 17:38:49');
INSERT INTO `tbl_audit_log` VALUES('667','tbl_journal_items','129','INSERT','Added new journal items with 10101010','1','2024-11-11 17:38:49');
INSERT INTO `tbl_audit_log` VALUES('668','tbl_journal_items','130','INSERT','Added new journal items with 10102020','1','2024-11-11 17:38:49');
INSERT INTO `tbl_audit_log` VALUES('669','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-11-25 13:30:03');
INSERT INTO `tbl_audit_log` VALUES('670','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-11-25 13:33:26');
INSERT INTO `tbl_audit_log` VALUES('671','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-11-25 13:33:36');
INSERT INTO `tbl_audit_log` VALUES('672','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-11-25 13:42:18');
INSERT INTO `tbl_audit_log` VALUES('673','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-11-25 13:42:47');
INSERT INTO `tbl_audit_log` VALUES('674','tbl_user','47','UPDATE','Updated Journal Status of 47','1','2024-11-25 13:43:01');
INSERT INTO `tbl_audit_log` VALUES('675','tbl_general_ledger','125','ADD','Added new general ledger debit entry with account 10101010 for journal voucher ID 47','1','2024-11-25 13:43:01');
INSERT INTO `tbl_audit_log` VALUES('676','tbl_general_ledger','126','ADD','Added new general ledger credit entry with account 10102020 for journal voucher ID 47','1','2024-11-25 13:43:01');
INSERT INTO `tbl_audit_log` VALUES('677','tbl_user','14','UPDATE','Inserted Notification  for Rejection of Journal Entry of 24-0005','1','2024-11-25 13:43:01');
INSERT INTO `tbl_audit_log` VALUES('678','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-11-25 13:53:38');
INSERT INTO `tbl_audit_log` VALUES('679','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-11-25 13:53:42');
INSERT INTO `tbl_audit_log` VALUES('680','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-11-25 14:19:53');
INSERT INTO `tbl_audit_log` VALUES('681','tbl_user','2','LOGIN','Cashier user2 has logged in into the system','2','2024-11-25 14:19:58');
INSERT INTO `tbl_audit_log` VALUES('682','tbl_user','2','LOGOUT','Cashier user2 has logged out into the system','2','2024-11-25 14:20:38');
INSERT INTO `tbl_audit_log` VALUES('683','tbl_user','12','LOGIN','Accounting Processoruser3 has logged in into the system','12','2024-11-25 14:20:42');
INSERT INTO `tbl_audit_log` VALUES('684','tbl_user','12','LOGOUT','Accounting Processor user3 has logged out into the system','12','2024-11-25 14:24:56');
INSERT INTO `tbl_audit_log` VALUES('685','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-11-27 21:22:16');
INSERT INTO `tbl_audit_log` VALUES('686','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-11-27 22:03:21');
INSERT INTO `tbl_audit_log` VALUES('687','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-12-04 18:50:31');
INSERT INTO `tbl_audit_log` VALUES('688','tbl_user_info','13','ADD','Added new user named: Inactive on ID 13','1','2024-12-04 18:59:08');
INSERT INTO `tbl_audit_log` VALUES('689','tbl_user','13','ADD','Added new user with username user6','1','2024-12-04 18:59:08');
INSERT INTO `tbl_audit_log` VALUES('690','tbl_user','1','UPDATE','Updated Status of admin','1','2024-12-04 18:59:19');
INSERT INTO `tbl_audit_log` VALUES('691','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-12-04 19:00:31');
INSERT INTO `tbl_audit_log` VALUES('692','tbl_user','13','LOGIN','Cashier user6 has logged in into the system','13','2024-12-04 19:00:36');
INSERT INTO `tbl_audit_log` VALUES('693','tbl_user','13','LOGOUT','Cashier user6 has logged out into the system','13','2024-12-04 19:00:41');
INSERT INTO `tbl_audit_log` VALUES('694','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-12-04 19:02:35');
INSERT INTO `tbl_audit_log` VALUES('695','tbl_user','13','UPDATE','Updated Status of user6','1','2024-12-04 19:02:50');
INSERT INTO `tbl_audit_log` VALUES('696','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-12-04 19:04:50');
INSERT INTO `tbl_audit_log` VALUES('697','tbl_user','13','LOGIN','Cashier user6 has logged in into the system','13','2024-12-04 19:04:58');
INSERT INTO `tbl_audit_log` VALUES('698','tbl_user','13','LOGOUT','Cashier user6 has logged out into the system','13','2024-12-04 19:05:02');
INSERT INTO `tbl_audit_log` VALUES('699','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-12-04 19:05:15');
INSERT INTO `tbl_audit_log` VALUES('700','tbl_user','13','UPDATE','Updated Status of user6','1','2024-12-04 19:05:27');
INSERT INTO `tbl_audit_log` VALUES('701','tbl_user','1','LOGOUT','Administrator admin has logged out into the system','1','2024-12-04 19:05:29');
INSERT INTO `tbl_audit_log` VALUES('702','tbl_user','1','LOGIN','Administrator admin has logged in into the system','1','2024-12-04 19:06:12');



CREATE TABLE `tbl_fiscal_year` (
  `fiscal_id` int(11) NOT NULL AUTO_INCREMENT,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `description` text NOT NULL,
  `fiscal_status` varchar(100) NOT NULL,
  PRIMARY KEY (`fiscal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tbl_fiscal_year` VALUES('2','2023-01-01','2023-12-31','F.Y-2023','Closed');
INSERT INTO `tbl_fiscal_year` VALUES('3','2024-01-01','2024-12-31','F.Y-2024','Active');
INSERT INTO `tbl_fiscal_year` VALUES('4','2025-01-01','2025-12-31','F.Y-2025','Inactive');
INSERT INTO `tbl_fiscal_year` VALUES('5','2026-01-01','2026-12-31','F.Y-2026','Inactive');
INSERT INTO `tbl_fiscal_year` VALUES('9','2027-01-01','2027-12-31','F.Y-2027','Inactive');



CREATE TABLE `tbl_general_ledger` (
  `ledger_id` int(8) NOT NULL AUTO_INCREMENT,
  `ledger_date` date NOT NULL,
  `account_code` int(8) NOT NULL,
  `debit` decimal(10,2) NOT NULL,
  `credit` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `journal_voucher_id` int(8) NOT NULL,
  `fiscal_id` int(10) NOT NULL,
  PRIMARY KEY (`ledger_id`)
) ENGINE=InnoDB AUTO_INCREMENT=127 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tbl_general_ledger` VALUES('62','2023-01-25','10301010','12180500.00','0.00','To take up billing','25','2');
INSERT INTO `tbl_general_ledger` VALUES('63','2023-01-25','40202090','0.00','11814085.00','To take up billing','25','2');
INSERT INTO `tbl_general_ledger` VALUES('64','2023-01-25','40202230','0.00','366415.00','To take up billing','25','2');
INSERT INTO `tbl_general_ledger` VALUES('65','2023-02-22','10101010','11449670.00','0.00','To take up collections','26','2');
INSERT INTO `tbl_general_ledger` VALUES('66','2023-02-22','10301010','0.00','11449670.00','To take up collections','26','2');
INSERT INTO `tbl_general_ledger` VALUES('67','2023-03-23','10102020','10877186.50','0.00','To take up deposits','27','2');
INSERT INTO `tbl_general_ledger` VALUES('68','2023-03-23','10101010','0.00','10877186.50','To take up deposits','27','2');
INSERT INTO `tbl_general_ledger` VALUES('69','2023-05-24','10607010','15000.00','0.00','To take up purchase of PPEs on account','28','2');
INSERT INTO `tbl_general_ledger` VALUES('70','2023-05-24','10605030','25700.00','0.00','To take up purchase of PPEs on account','28','2');
INSERT INTO `tbl_general_ledger` VALUES('71','2023-05-24','10606010','80550.00','0.00','To take up purchase of PPEs on account','28','2');
INSERT INTO `tbl_general_ledger` VALUES('72','2023-05-24','20201010','0.00','7031.25','To take up purchase of PPEs on account','28','2');
INSERT INTO `tbl_general_ledger` VALUES('73','2023-05-24','10102020','0.00','114218.75','To take up purchase of PPEs on account','28','2');
INSERT INTO `tbl_general_ledger` VALUES('74','2023-05-30','10101020','15000.00','0.00','To take up establishment of PCF','29','2');
INSERT INTO `tbl_general_ledger` VALUES('75','2023-05-30','10102020','0.00','15000.00','To take up establishment of PCF','29','2');
INSERT INTO `tbl_general_ledger` VALUES('76','2023-07-31','50101010','4380000.00','0.00','To take up payroll','30','2');
INSERT INTO `tbl_general_ledger` VALUES('77','2023-07-31','20201020','0.00','394200.00','To take up payroll','30','2');
INSERT INTO `tbl_general_ledger` VALUES('78','2023-07-31','20201030','0.00','87600.00','To take up payroll','30','2');
INSERT INTO `tbl_general_ledger` VALUES('79','2023-07-31','20201040','0.00','109500.00','To take up payroll','30','2');
INSERT INTO `tbl_general_ledger` VALUES('80','2023-07-31','10102020','0.00','3788700.00','To take up payroll','30','2');
INSERT INTO `tbl_general_ledger` VALUES('81','2023-10-27','10404020','125000.00','0.00','To take up purchase on account for fittings, materials, chemicals and accountable forms','31','2');
INSERT INTO `tbl_general_ledger` VALUES('82','2023-10-27','10404120','48600.00','0.00','To take up purchase on account for fittings, materials, chemicals and accountable forms','31','2');
INSERT INTO `tbl_general_ledger` VALUES('83','2023-10-27','10404990','235100.00','0.00','To take up purchase on account for fittings, materials, chemicals and accountable forms','31','2');
INSERT INTO `tbl_general_ledger` VALUES('84','2023-10-27','20101010','0.00','408700.00','To take up purchase on account for fittings, materials, chemicals and accountable forms','31','2');
INSERT INTO `tbl_general_ledger` VALUES('85','2023-11-13','10102020','500000.00','0.00','To take up financial assistance from LWUA','32','2');
INSERT INTO `tbl_general_ledger` VALUES('86','2023-11-13','20101040','0.00','500000.00','To take up financial assistance from LWUA','32','2');
INSERT INTO `tbl_general_ledger` VALUES('87','2023-12-01','50203010','4671.00','0.00','To take up replenishment of Petty Cash Fund','33','2');
INSERT INTO `tbl_general_ledger` VALUES('88','2023-12-01','50203090','3950.00','0.00','To take up replenishment of Petty Cash Fund','33','2');
INSERT INTO `tbl_general_ledger` VALUES('89','2023-12-01','50205010','360.00','0.00','To take up replenishment of Petty Cash Fund','33','2');
INSERT INTO `tbl_general_ledger` VALUES('90','2023-12-01','50299020','1050.00','0.00','To take up replenishment of Petty Cash Fund','33','2');
INSERT INTO `tbl_general_ledger` VALUES('91','2023-12-01','50299030','2760.00','0.00','To take up replenishment of Petty Cash Fund','33','2');
INSERT INTO `tbl_general_ledger` VALUES('92','2023-12-01','50213030','1610.00','0.00','To take up replenishment of Petty Cash Fund','33','2');
INSERT INTO `tbl_general_ledger` VALUES('93','2023-12-01','10102020','0.00','14401.00','To take up replenishment of Petty Cash Fund','33','2');
INSERT INTO `tbl_general_ledger` VALUES('94','2023-12-31','40202090','11814085.00','0.00','To record retained earnings for the year of 2023','34','2');
INSERT INTO `tbl_general_ledger` VALUES('95','2023-12-31','40202230','366415.00','0.00','To record retained earnings for the year of 2023','34','2');
INSERT INTO `tbl_general_ledger` VALUES('96','2023-12-31','50101010','0.00','4380000.00','To record retained earnings for the year of 2023','34','2');
INSERT INTO `tbl_general_ledger` VALUES('97','2023-12-31','50203010','0.00','4671.00','To record retained earnings for the year of 2023','34','2');
INSERT INTO `tbl_general_ledger` VALUES('98','2023-12-31','50203090','0.00','3950.00','To record retained earnings for the year of 2023','34','2');
INSERT INTO `tbl_general_ledger` VALUES('99','2023-12-31','50205010','0.00','360.00','To record retained earnings for the year of 2023','34','2');
INSERT INTO `tbl_general_ledger` VALUES('100','2023-12-31','50213030','0.00','1610.00','To record retained earnings for the year of 2023','34','2');
INSERT INTO `tbl_general_ledger` VALUES('101','2023-12-31','50299020','0.00','1050.00','To record retained earnings for the year of 2023','34','2');
INSERT INTO `tbl_general_ledger` VALUES('102','2023-12-31','50299030','0.00','2760.00','To record retained earnings for the year of 2023','34','2');
INSERT INTO `tbl_general_ledger` VALUES('103','2023-12-31','30701010','0.00','7786099.00','To record retained earnings for the year of 2023','34','2');
INSERT INTO `tbl_general_ledger` VALUES('113','2023-12-31','10101010','10000.00','0.00','To take up collections','42','2');
INSERT INTO `tbl_general_ledger` VALUES('114','2023-12-31','10101020','0.00','10000.00','To take up collections','42','2');
INSERT INTO `tbl_general_ledger` VALUES('115','2023-12-31','10102020','30000.00','0.00','To collect cash-collecting cash on hand','41','2');
INSERT INTO `tbl_general_ledger` VALUES('116','2023-12-31','10101010','0.00','30000.00','To collect cash-collecting cash on hand','41','2');
INSERT INTO `tbl_general_ledger` VALUES('117','2024-11-05','10607010','15000.00','0.00','To purchases Furnitures','43','3');
INSERT INTO `tbl_general_ledger` VALUES('118','2024-11-05','20101010','0.00','15000.00','To purchases Furnitures','43','3');
INSERT INTO `tbl_general_ledger` VALUES('119','2024-11-06','10605030','50000.00','0.00','To purchase ICT Equipment','45','3');
INSERT INTO `tbl_general_ledger` VALUES('120','2024-11-06','20101010','0.00','50000.00','To purchase ICT Equipment','45','3');
INSERT INTO `tbl_general_ledger` VALUES('121','2024-11-06','10101010','50000.00','0.00','To take up billing','44','3');
INSERT INTO `tbl_general_ledger` VALUES('122','2024-11-06','10102020','0.00','50000.00','To take up billing','44','3');
INSERT INTO `tbl_general_ledger` VALUES('123','2024-11-06','20101010','30000.00','0.00','To pay payable','46','3');
INSERT INTO `tbl_general_ledger` VALUES('124','2024-11-06','10102020','0.00','30000.00','To pay payable','46','3');
INSERT INTO `tbl_general_ledger` VALUES('125','2024-11-25','10101010','60000.00','0.00','To take up collections','47','3');
INSERT INTO `tbl_general_ledger` VALUES('126','2024-11-25','10102020','0.00','60000.00','To take up collections','47','3');



CREATE TABLE `tbl_help` (
  `help_id` int(11) NOT NULL AUTO_INCREMENT,
  `topic` varchar(100) NOT NULL,
  `context` text NOT NULL,
  PRIMARY KEY (`help_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tbl_help` VALUES('1','Login','Logging in on your device requires a username and password');
INSERT INTO `tbl_help` VALUES('2','Dashboard','This page will show the navigation of the entire web application\r\n');
INSERT INTO `tbl_help` VALUES('3','Journal Management','This will show how to manage the journal entries of the system');
INSERT INTO `tbl_help` VALUES('4','Logout','This is for logout\n        ');
INSERT INTO `tbl_help` VALUES('5','User Management','This is for managing users\n        ');
INSERT INTO `tbl_help` VALUES('6','Journal Entry Voucher Report','JEV Report\n        ');
INSERT INTO `tbl_help` VALUES('7','General Ledger ','Ledger Entries');
INSERT INTO `tbl_help` VALUES('8','Trial Balance','For validating the trial balance entries');
INSERT INTO `tbl_help` VALUES('9','Account Title Management (Add)','For validating the trial balance entries');
INSERT INTO `tbl_help` VALUES('10','Account Types Management (Add)','For adding account types');
INSERT INTO `tbl_help` VALUES('11','Update Account Titles','For adding account types');
INSERT INTO `tbl_help` VALUES('12','Account Groups Management (Add)','For adding account types');
INSERT INTO `tbl_help` VALUES('13','Account Groups Management (Update)','For Update ');
INSERT INTO `tbl_help` VALUES('14','Journal Categories Management (Add)','For Update ');
INSERT INTO `tbl_help` VALUES('15','Journal Category Management (Update)','Journal Category Management  updating');
INSERT INTO `tbl_help` VALUES('16','Add Fiscal Year','For fiscal year/calendar year\n');
INSERT INTO `tbl_help` VALUES('17','Set Current Fiscal Year','Fiscal Year');
INSERT INTO `tbl_help` VALUES('18','Backup Database','Fiscal Year');
INSERT INTO `tbl_help` VALUES('19','Restore Database','DB Restoration');
INSERT INTO `tbl_help` VALUES('20','Approve Journal Entries','TO approve\n        ');
INSERT INTO `tbl_help` VALUES('21','Edit Journal Entries (Before Adding)','Edit Journal Entry before adding\n        ');
INSERT INTO `tbl_help` VALUES('22','Edit Journal Entries','Edit Journal Entries ');
INSERT INTO `tbl_help` VALUES('23','Edit Account Types','For editing account types');
INSERT INTO `tbl_help` VALUES('24','Password','For login link to password\n\n        ');



CREATE TABLE `tbl_help_items` (
  `help_item_id` int(10) NOT NULL AUTO_INCREMENT,
  `help_id` int(10) NOT NULL,
  `help_text` text NOT NULL,
  `photo_documentation` varchar(150) NOT NULL,
  PRIMARY KEY (`help_item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=123 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tbl_help_items` VALUES('1','1','1) The system needs a username and password access the system, you must login with your username and password as stated by the system administrator.','help/img/Login3.png');
INSERT INTO `tbl_help_items` VALUES('2','1','2) Press Login to access the journal entry voucher management system','help/img/Login4.png');
INSERT INTO `tbl_help_items` VALUES('3','3','1) Press Journal Management to open the journal entry management page','help/img/Dashboard6.png');
INSERT INTO `tbl_help_items` VALUES('4','3','2) Press add journal entry to add new journal entries','help/img/JournalEntry1.png');
INSERT INTO `tbl_help_items` VALUES('5','1','3) If any error messages pop up on the caused by invalid login credentials or wrong password, press OK.','help/img/Login6.png');
INSERT INTO `tbl_help_items` VALUES('6','2','1) This is the dashboard interface for the administrator of the Journal Entry Voucher Management System after a successful login','help/img/Dashboard4.png');
INSERT INTO `tbl_help_items` VALUES('7','2','2) This is the dashboard of the cashier user of the Journal Entry Voucher Management System after successful login','help/img/Dashboard3.png');
INSERT INTO `tbl_help_items` VALUES('8','4','1) Press the logout button in order to logout of the system','help/img/Logout3.png');
INSERT INTO `tbl_help_items` VALUES('9','4','2) Press Logout in order to logout of the system','help/img/Logout4.png');
INSERT INTO `tbl_help_items` VALUES('10','5','1) Press User Management button on the left sidebar in order to access the user management page','help/img/Dashboard5.png');
INSERT INTO `tbl_help_items` VALUES('11','5','2) Press Add Users to add new users of the system','help/img/UserM1.png');
INSERT INTO `tbl_help_items` VALUES('12','5','3) Fill up the necessary fields to add new users of the system','help/img/UserM3.png');
INSERT INTO `tbl_help_items` VALUES('13','5','4) Press add user to confirm adding the new users of the system','help/img/UserM5.png');
INSERT INTO `tbl_help_items` VALUES('14','5','5) Press yes to proceed adding the user of the system','help/img/UserM6.png');
INSERT INTO `tbl_help_items` VALUES('15','5','6) After the system has added the new user press ok to proceed with other tasks','help/img/Add_User.png');
INSERT INTO `tbl_help_items` VALUES('16','3','3) Fill up the fields needed as shown by the arrows which is the journal entry date, journal category and journal particulars','help/img/JournalEntry2.png');
INSERT INTO `tbl_help_items` VALUES('17','3','4) Press the account title dropdown to show the list of account titles','help/img/JournalEntry3.png');
INSERT INTO `tbl_help_items` VALUES('18','3','5)	Choose from the list or search it and click the account title that is needed','help/img/JournalEntry6.png');
INSERT INTO `tbl_help_items` VALUES('19','3','6) Insert amount to enter the amount of the account title','help/img/JournalEntry4.png');
INSERT INTO `tbl_help_items` VALUES('20','3','7) Press debit or credit depending on the type of journal entry','help/img/JournalEntry7.png');
INSERT INTO `tbl_help_items` VALUES('21','3','8) Ensure that both credit and debit have a balanced total and after that press save entry','help/img/EditAdd1.png');
INSERT INTO `tbl_help_items` VALUES('22','3','9) A journal entry voucher pdf report will be generated after the report and click the print to print','help/img/JEV.png');
INSERT INTO `tbl_help_items` VALUES('23','6','1) In order to view the created JEV Entry, press view entry button','help/img/ViewEntry.png');
INSERT INTO `tbl_help_items` VALUES('24','6','2)	In order to print the journal entry voucher, press the print button','help/img/PrintJEV.png');
INSERT INTO `tbl_help_items` VALUES('25','6','3)	The generated Journal Entry Voucher will show as a pdf which is ready to print','help/img/JEV.png');
INSERT INTO `tbl_help_items` VALUES('26','7','1) General Ledger Entries are already posted after a journal entry process so to open it you must press General Ledger button on the left side','help/img/Dashboard7.png');
INSERT INTO `tbl_help_items` VALUES('27','7','2) Press the dropdown filter account titles to choose the account title to display in the general ledger','help/img/GenLedger1.png');
INSERT INTO `tbl_help_items` VALUES('28','7','3) Scroll the dropdown to find the account title and click the account title you want to pick','help/img/GenLedger2.png');
INSERT INTO `tbl_help_items` VALUES('29','7','4) Press date from and date to filter the date for the general ledger table','help/img/GenLedger3.png');
INSERT INTO `tbl_help_items` VALUES('30','7','5) Use the date picker to pick the date for the date to or date from filter for the general ledger','help/img/GenLedger4.png');
INSERT INTO `tbl_help_items` VALUES('31','7','6) Press the print general ledger to display the ledger report','help/img/GenLedger5.png');
INSERT INTO `tbl_help_items` VALUES('32','7','7) This is the displayed general ledger entry','help/img/GenLedger6.png');
INSERT INTO `tbl_help_items` VALUES('33','8','1) Trial balance entries are created when journal entries are created and the general ledger has posted the ledger entries','help/img/Dashboard8.png');
INSERT INTO `tbl_help_items` VALUES('34','8','2) Press the date to and date from to filter the dates for the trial balance data','help/img/Trial Balance2.png');
INSERT INTO `tbl_help_items` VALUES('35','8','3) After setting date to and date from, you can choose to press any of the buttons as indicated by the arrows.','help/img/Trial Balance3.png');
INSERT INTO `tbl_help_items` VALUES('36','8','4) This is the trial balance report that will show the trial balance of journal entries','help/img/Screenshot 2024-10-16 204906.png');
INSERT INTO `tbl_help_items` VALUES('37','8','5) This is the balance sheet that will show the balances of assets, liabilities and equity accounts','help/img/Screenshot 2024-10-16 204927.png');
INSERT INTO `tbl_help_items` VALUES('38','8','6) This is the income statement that will show the balances of expense and income accounts.','help/img/Screenshot 2024-10-16 204943.png');
INSERT INTO `tbl_help_items` VALUES('39','9','1) Press Account title management to go to the account title management page','help/img/Account_Title.png');
INSERT INTO `tbl_help_items` VALUES('40','9','2) Press the add new accounts button to add new accounts','help/img/ATitles1.png');
INSERT INTO `tbl_help_items` VALUES('41','9','3) Fill all the necessary fields like the account code, account title and account type.','help/img/ATitles2.png');
INSERT INTO `tbl_help_items` VALUES('42','9','4) Press the add account type button to add the account type to the list of accounts','help/img/ATitles5.png');
INSERT INTO `tbl_help_items` VALUES('43','9','5) Press yes to confirm the account title is added to the chart of accounts','help/img/ATitles3.png');
INSERT INTO `tbl_help_items` VALUES('44','9','6) A success or error information window will pop up after pressing yes','help/img/ATitles11.png');
INSERT INTO `tbl_help_items` VALUES('45','10','1) Press account type management to open the account type management','help/img/Account_Type.png');
INSERT INTO `tbl_help_items` VALUES('46','10','2) Press add account types to add new account types for the chart/list of accounts','help/img/ATypes1.png');
INSERT INTO `tbl_help_items` VALUES('47','10','3) Fill up all the required fields needed by the add account types window','help/img/ATypes2.png');
INSERT INTO `tbl_help_items` VALUES('48','10','4) Press add account type to add the new account type to the list of accounts.','help/img/ATypes3.png');
INSERT INTO `tbl_help_items` VALUES('49','10','5) Press yes to confirm that the account type is to be added','help/img/ATypes4.png');
INSERT INTO `tbl_help_items` VALUES('50','10','6) A window with success or error will pop up after confirming the adding of the account type','help/img/ATypes5.png');
INSERT INTO `tbl_help_items` VALUES('51','11','1) Press actions to open the actions for updating the account titles','help/img/ATitles6.png');
INSERT INTO `tbl_help_items` VALUES('52','11','2) Press update account button in order to update the account titles','help/img/ATitles7.png');
INSERT INTO `tbl_help_items` VALUES('53','11','3) Fill up all the required fields, filling up account group is optional','help/img/ATitles8.png');
INSERT INTO `tbl_help_items` VALUES('54','11','4) Press update account to prepare the account for being updated','help/img/ATitles9.png');
INSERT INTO `tbl_help_items` VALUES('55','11','5) Press yes to confirm updating the account title','help/img/ATitles10.png');
INSERT INTO `tbl_help_items` VALUES('56','11','6) A window will pop up after successfully updating the account title','help/img/ATitles12.png');
INSERT INTO `tbl_help_items` VALUES('57','12','1) Press account category management to go to the account group management page','help/img/Account_Category.png');
INSERT INTO `tbl_help_items` VALUES('58','12','2) Press add new account class to add new account class to classify the accounts','help/img/AGroup1.png');
INSERT INTO `tbl_help_items` VALUES('59','12','3) Fill up the necessary field for adding an account group as shown by the photo','help/img/AGroup2.png');
INSERT INTO `tbl_help_items` VALUES('60','12','4) Press add account group to add the new account group to the list of accounts.','help/img/AGroup3.png');
INSERT INTO `tbl_help_items` VALUES('61','12','5) Press yes to add the new account group to the list of account groups','help/img/AGroup4.png');
INSERT INTO `tbl_help_items` VALUES('62','12','6) A window with success or error will pop up after confirming the adding of the account group/category','help/img/AGroup5.png');
INSERT INTO `tbl_help_items` VALUES('63','13','1)	Press actions to open the actions button to open the edit account groups','help/img/AGroup6.png');
INSERT INTO `tbl_help_items` VALUES('64','13','2)	After pressing the actions button press update account to open the update account window.','help/img/AGroup7.png');
INSERT INTO `tbl_help_items` VALUES('65','13','3) Fill up all the required fields for updating the account group','help/img/AGroup8.png');
INSERT INTO `tbl_help_items` VALUES('66','13','4) Press update account group to update the account group details','help/img/AGroup9.png');
INSERT INTO `tbl_help_items` VALUES('67','13','5) Press yes to confirm to update the account group details','help/img/AGroup10.png');
INSERT INTO `tbl_help_items` VALUES('68','13','6) A window will pop up after the account group has been successfully updated.','help/img/AGroup11.png');
INSERT INTO `tbl_help_items` VALUES('69','14','1) Press journal category management to go to the account group management page','help/img/Journal_Category.png');
INSERT INTO `tbl_help_items` VALUES('70','14','2) Press add journal types to add new journal categories to classify the journal entries','help/img/Jcategory1.png');
INSERT INTO `tbl_help_items` VALUES('71','14','3) Fill up the necessary field for adding an journal category as shown by the photo','help/img/JCategory2.png');
INSERT INTO `tbl_help_items` VALUES('72','14','4) Press add journal category group to add the new journal category group to the list of journal categories.','help/img/JCategory3.png');
INSERT INTO `tbl_help_items` VALUES('73','14','5) Press yes to add the new journal category to the list of account categories for confirmation','help/img/JCategory4.png');
INSERT INTO `tbl_help_items` VALUES('74','14','6)	A window with success or error will pop up after confirming the adding of the account group','help/img/JCategory12.png');
INSERT INTO `tbl_help_items` VALUES('75','15','1) Press the actions button to open the available actions for updating the journal categories','help/img/JCategory5.png');
INSERT INTO `tbl_help_items` VALUES('76','15','2) Press update journal category to open the update journal category','help/img/JCategory6.png');
INSERT INTO `tbl_help_items` VALUES('77','15','3) Fill up all the required fields of the journal category details.','help/img/JCategory7.png');
INSERT INTO `tbl_help_items` VALUES('78','15','4) Press update journal category to confirm to update the journal categories','help/img/JCategory8.png');
INSERT INTO `tbl_help_items` VALUES('79','15','5) Press yes to proceed updating the journal category details','help/img/JCategory9.png');
INSERT INTO `tbl_help_items` VALUES('80','15','6) A window will show if the journal category successfully updates','help/img/JCategory11.png');
INSERT INTO `tbl_help_items` VALUES('81','16','1) Press fiscal year management to go to the fiscal year management page','help/img/FYearManage.png');
INSERT INTO `tbl_help_items` VALUES('82','16','2) Press Add fiscal year to add a new fiscal year/ calendar year','help/img/FiscalYear1.png');
INSERT INTO `tbl_help_items` VALUES('83','16','3) Fill up all required fields in add new fiscal year','help/img/FiscalYear2.png');
INSERT INTO `tbl_help_items` VALUES('84','16','4) After filling up the required fields press add to add the new fiscal period','help/img/FiscalYear3.png');
INSERT INTO `tbl_help_items` VALUES('85','16','5) Press yes to confirm to add the fiscal year','help/img/FiscalYear4.png');
INSERT INTO `tbl_help_items` VALUES('86','16','6) A window with success or error will pop up after confirming the fiscal year','help/img/FiscalYear5.png');
INSERT INTO `tbl_help_items` VALUES('87','17','1) Press the activate button to activate a fiscal year','help/img/FiscalYear8.png');
INSERT INTO `tbl_help_items` VALUES('88','17','2) Press yes to confirm to set a new fiscal year and archive the currently working year','help/img/FiscalYear9.png');
INSERT INTO `tbl_help_items` VALUES('89','17','3) Press ok to logout of the system to set up the new fiscal year','help/img/FiscalYear7.png');
INSERT INTO `tbl_help_items` VALUES('90','18','1) Press Backup and restore to go to the backup and restore page','help/img/Backup_Restore.png');
INSERT INTO `tbl_help_items` VALUES('91','18','2) Press backup database to back up the database','help/img/Backup2.png');
INSERT INTO `tbl_help_items` VALUES('92','18','3)	Press save to save the database as a sql backup file','help/img/Backup3.png');
INSERT INTO `tbl_help_items` VALUES('93','18','4) A window indicating the backup is successful is shown','help/img/Backup9.png');
INSERT INTO `tbl_help_items` VALUES('94','19','1) Press choose file to choose the sql file to restore the database with','help/img/Backup4.png');
INSERT INTO `tbl_help_items` VALUES('95','19','2) Press the database sql file you want to restore from','help/img/Backup5.png');
INSERT INTO `tbl_help_items` VALUES('96','19','3) Press open to select the database you want to backup','help/img/Backup6.png');
INSERT INTO `tbl_help_items` VALUES('97','19','4) Press restore DB to restore the database','help/img/Backup2.png');
INSERT INTO `tbl_help_items` VALUES('98','19','5) Press yes to confirm to restore the database','help/img/Backup7.png');
INSERT INTO `tbl_help_items` VALUES('99','19','6) A window will pop up after restoring the database','help/img/Backup8.png');
INSERT INTO `tbl_help_items` VALUES('100','20','1) Press update status to update the status of the journal entries to rejected or approved.','help/img/Approve1.png');
INSERT INTO `tbl_help_items` VALUES('101','20','2) Fill up the required fields which is a datepicker and a dropdown to approve or reject the entry','help/img/Approve2.png');
INSERT INTO `tbl_help_items` VALUES('102','20','3)	Press update status to update the entry and go into the confirmation page','help/img/Approve3.png');
INSERT INTO `tbl_help_items` VALUES('103','20','4) Press yes to approve the journal entry status of the journal entry','help/img/Approve4.png');
INSERT INTO `tbl_help_items` VALUES('104','20','5) A window confirming that the journal entry is updated will be shown.','help/img/Approve6.png');
INSERT INTO `tbl_help_items` VALUES('105','21','1) Press update entry to edit the journal entry before approval or after entry is rejected','help/img/EditAdd2.png');
INSERT INTO `tbl_help_items` VALUES('106','21','2) Press the dropdown to choose from account titles from the chart of accounts','help/img/EditAdd3.png');
INSERT INTO `tbl_help_items` VALUES('107','21','3) Press the input field on the to edit its amount','help/img/EditAdd4.png');
INSERT INTO `tbl_help_items` VALUES('108','21','4) Press save entry to save the updates on the entry.','help/img/EditAdd6.png');
INSERT INTO `tbl_help_items` VALUES('109','21','5) This will show the page where the journal entries are currently being added','help/img/EditAdd5.png');
INSERT INTO `tbl_help_items` VALUES('110','22','1) Press update entry to edit the journal entries before approval','help/img/EditJournal1.png');
INSERT INTO `tbl_help_items` VALUES('111','22','2) Fill up all the required fields to update the entered journal entries','help/img/EditJournal2.png');
INSERT INTO `tbl_help_items` VALUES('112','22','3) Press Save Entry to save the journal entry and update it','help/img/EditJournal3.png');
INSERT INTO `tbl_help_items` VALUES('113','22','4) Press yes to confirm that you will be updating the journal entry','help/img/EditJournal4.png');
INSERT INTO `tbl_help_items` VALUES('114','22','5) A confirmation window will pop up indicating that you have updated the journal entry','help/img/EditJournal5.png');
INSERT INTO `tbl_help_items` VALUES('115','23','1) Press actions to open the actions for updating the account types','help/img/UpdTypes.png');
INSERT INTO `tbl_help_items` VALUES('116','23','2) Press update account button in order to update the account types','help/img/UpdTypes2.png');
INSERT INTO `tbl_help_items` VALUES('117','23','3)	Fill up all the required fields as indicated by the arrows','help/img/UpdTypes3.png');
INSERT INTO `tbl_help_items` VALUES('118','23','4) Press update account types to prepare the account types for being updated','help/img/UpdTypes4.png');
INSERT INTO `tbl_help_items` VALUES('119','23','5) Press yes to confirm updating the account types','help/img/UpdTypes5.png');
INSERT INTO `tbl_help_items` VALUES('120','23','6)	A window will pop up after successfully updating the account type','help/img/UpdTypes6.png');
INSERT INTO `tbl_help_items` VALUES('121','24','1) The system needs a username and password access the system, you must login with your username and password as stated by the system administrator.','help/img/Login3.png');
INSERT INTO `tbl_help_items` VALUES('122','24','2) Press Login to access the journal entry voucher management system','help/img/Login4.png');



CREATE TABLE `tbl_journal_category` (
  `category_id` int(8) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `category_description` text NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tbl_journal_category` VALUES('2','Cash Receipts and Deposits','This category is for the collection Processes of the Water District');
INSERT INTO `tbl_journal_category` VALUES('3','Check Disbursement','Records payment transactions of the organization');
INSERT INTO `tbl_journal_category` VALUES('6','Miscellaneous',' For billings, adjustments and materials');



CREATE TABLE `tbl_journal_entry` (
  `journal_voucher_id` int(8) NOT NULL AUTO_INCREMENT,
  `journal_voucher_no` varchar(10) NOT NULL,
  `journal_date` date NOT NULL,
  `description` text NOT NULL,
  `journal_status` varchar(100) NOT NULL,
  `uid` int(8) NOT NULL,
  `category_id` int(10) NOT NULL,
  `fiscal_id` int(11) NOT NULL,
  PRIMARY KEY (`journal_voucher_id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tbl_journal_entry` VALUES('25','23-0001','2023-01-25','To take up billing','Approved','1','6','2');
INSERT INTO `tbl_journal_entry` VALUES('26','23-0002','2023-02-22','To take up collections','Approved','2','2','2');
INSERT INTO `tbl_journal_entry` VALUES('27','23-0003','2023-03-23','To take up deposits','Approved','2','2','2');
INSERT INTO `tbl_journal_entry` VALUES('28','23-0004','2023-05-24','To take up purchase of PPEs on account','Approved','2','3','2');
INSERT INTO `tbl_journal_entry` VALUES('29','23-0005','2023-05-30','To take up establishment of PCF','Approved','2','3','2');
INSERT INTO `tbl_journal_entry` VALUES('30','23-0006','2023-07-31','To take up payroll','Approved','2','3','2');
INSERT INTO `tbl_journal_entry` VALUES('31','23-0007','2023-10-27','To take up purchase on account for fittings, materials, chemicals and accountable forms','Approved','2','6','2');
INSERT INTO `tbl_journal_entry` VALUES('32','23-0008','2023-11-13','To take up financial assistance from LWUA','Approved','2','2','2');
INSERT INTO `tbl_journal_entry` VALUES('33','23-0009','2023-12-01','To take up replenishment of Petty Cash Fund','Approved','2','3','2');
INSERT INTO `tbl_journal_entry` VALUES('34','23-0010','2023-12-31','To record retained earnings for the year of 2023','Approved','2','6','2');
INSERT INTO `tbl_journal_entry` VALUES('41','23-0011','2023-12-29','To collect cash-collecting cash on hand','Approved','2','6','2');
INSERT INTO `tbl_journal_entry` VALUES('42','23-0012','2023-12-31','To take up collections','Approved','2','2','2');
INSERT INTO `tbl_journal_entry` VALUES('43','24-0001','2024-11-05','To purchases Furnitures','Approved','2','6','3');
INSERT INTO `tbl_journal_entry` VALUES('44','24-0002','2024-11-06','To take up billing','Approved','1','6','3');
INSERT INTO `tbl_journal_entry` VALUES('45','24-0003','2024-11-06','To purchase ICT Equipment','Approved','2','2','3');
INSERT INTO `tbl_journal_entry` VALUES('46','24-0004','2024-11-06','To pay payable','Approved','2','2','3');
INSERT INTO `tbl_journal_entry` VALUES('47','24-0005','2024-11-11','To take up collections','Pending','1','2','3');



CREATE TABLE `tbl_journal_items` (
  `journal_item_id` int(8) NOT NULL AUTO_INCREMENT,
  `journal_voucher_id` int(10) NOT NULL,
  `account_code` int(8) NOT NULL,
  `journal_amount` decimal(10,2) NOT NULL,
  `journal_adjustment` varchar(100) NOT NULL,
  PRIMARY KEY (`journal_item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tbl_journal_items` VALUES('62','25','10301010','12180500.00','Debit');
INSERT INTO `tbl_journal_items` VALUES('63','25','40202090','11814085.00','Credit');
INSERT INTO `tbl_journal_items` VALUES('64','25','40202230','366415.00','Credit');
INSERT INTO `tbl_journal_items` VALUES('65','26','10101010','11449670.00','Debit');
INSERT INTO `tbl_journal_items` VALUES('66','26','10301010','11449670.00','Credit');
INSERT INTO `tbl_journal_items` VALUES('67','27','10102020','10877186.50','Debit');
INSERT INTO `tbl_journal_items` VALUES('68','27','10101010','10877186.50','Credit');
INSERT INTO `tbl_journal_items` VALUES('69','28','10607010','15000.00','Debit');
INSERT INTO `tbl_journal_items` VALUES('70','28','10605030','25700.00','Debit');
INSERT INTO `tbl_journal_items` VALUES('71','28','10606010','80550.00','Debit');
INSERT INTO `tbl_journal_items` VALUES('72','28','20201010','7031.25','Credit');
INSERT INTO `tbl_journal_items` VALUES('73','28','10102020','114218.75','Credit');
INSERT INTO `tbl_journal_items` VALUES('74','29','10101020','15000.00','Debit');
INSERT INTO `tbl_journal_items` VALUES('75','29','10102020','15000.00','Credit');
INSERT INTO `tbl_journal_items` VALUES('76','30','50101010','4380000.00','Debit');
INSERT INTO `tbl_journal_items` VALUES('77','30','20201020','394200.00','Credit');
INSERT INTO `tbl_journal_items` VALUES('78','30','20201030','87600.00','Credit');
INSERT INTO `tbl_journal_items` VALUES('79','30','20201040','109500.00','Credit');
INSERT INTO `tbl_journal_items` VALUES('80','30','10102020','3788700.00','Credit');
INSERT INTO `tbl_journal_items` VALUES('81','31','10404020','125000.00','Debit');
INSERT INTO `tbl_journal_items` VALUES('82','31','10404120','48600.00','Debit');
INSERT INTO `tbl_journal_items` VALUES('83','31','10404990','235100.00','Debit');
INSERT INTO `tbl_journal_items` VALUES('84','31','20101010','408700.00','Credit');
INSERT INTO `tbl_journal_items` VALUES('85','32','10102020','500000.00','Debit');
INSERT INTO `tbl_journal_items` VALUES('86','32','20101040','500000.00','Credit');
INSERT INTO `tbl_journal_items` VALUES('87','33','50203010','4671.00','Debit');
INSERT INTO `tbl_journal_items` VALUES('88','33','50203090','3950.00','Debit');
INSERT INTO `tbl_journal_items` VALUES('89','33','50205010','360.00','Debit');
INSERT INTO `tbl_journal_items` VALUES('90','33','50299020','1050.00','Debit');
INSERT INTO `tbl_journal_items` VALUES('91','33','50299030','2760.00','Debit');
INSERT INTO `tbl_journal_items` VALUES('92','33','50213030','1610.00','Debit');
INSERT INTO `tbl_journal_items` VALUES('93','33','10102020','14401.00','Credit');
INSERT INTO `tbl_journal_items` VALUES('94','34','40202090','11814085.00','Debit');
INSERT INTO `tbl_journal_items` VALUES('95','34','40202230','366415.00','Debit');
INSERT INTO `tbl_journal_items` VALUES('96','34','50101010','4380000.00','Credit');
INSERT INTO `tbl_journal_items` VALUES('97','34','50203010','4671.00','Credit');
INSERT INTO `tbl_journal_items` VALUES('98','34','50203090','3950.00','Credit');
INSERT INTO `tbl_journal_items` VALUES('99','34','50205010','360.00','Credit');
INSERT INTO `tbl_journal_items` VALUES('100','34','50213030','1610.00','Credit');
INSERT INTO `tbl_journal_items` VALUES('101','34','50299020','1050.00','Credit');
INSERT INTO `tbl_journal_items` VALUES('102','34','50299030','2760.00','Credit');
INSERT INTO `tbl_journal_items` VALUES('103','34','30701010','7786099.00','Credit');
INSERT INTO `tbl_journal_items` VALUES('117','41','10102020','30000.00','Debit');
INSERT INTO `tbl_journal_items` VALUES('118','41','10101010','30000.00','Credit');
INSERT INTO `tbl_journal_items` VALUES('119','42','10101010','10000.00','Debit');
INSERT INTO `tbl_journal_items` VALUES('120','42','10101020','10000.00','Credit');
INSERT INTO `tbl_journal_items` VALUES('121','43','10607010','15000.00','Debit');
INSERT INTO `tbl_journal_items` VALUES('122','43','20101010','15000.00','Credit');
INSERT INTO `tbl_journal_items` VALUES('123','44','10101010','50000.00','Debit');
INSERT INTO `tbl_journal_items` VALUES('124','44','10102020','50000.00','Credit');
INSERT INTO `tbl_journal_items` VALUES('125','45','10605030','50000.00','Debit');
INSERT INTO `tbl_journal_items` VALUES('126','45','20101010','50000.00','Credit');
INSERT INTO `tbl_journal_items` VALUES('127','46','20101010','30000.00','Debit');
INSERT INTO `tbl_journal_items` VALUES('128','46','10102020','30000.00','Credit');
INSERT INTO `tbl_journal_items` VALUES('129','47','10101010','60000.00','Debit');
INSERT INTO `tbl_journal_items` VALUES('130','47','10102020','60000.00','Credit');



CREATE TABLE `tbl_main_account_type` (
  `main_type_id` int(10) NOT NULL,
  `main_type_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `reports_included` varchar(100) NOT NULL,
  PRIMARY KEY (`main_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tbl_main_account_type` VALUES('1','Assets','Something a business has or owns ','Balance Sheet');
INSERT INTO `tbl_main_account_type` VALUES('4','Income','Value of the goods we have sold or the services we have performed','Income Statement');
INSERT INTO `tbl_main_account_type` VALUES('5','Less:Expenses','Costs of doing business\r\n','Income Statement');
INSERT INTO `tbl_main_account_type` VALUES('6','Liabilities and Equity','This is to record all liabilities and equity','Balance Sheet');



CREATE TABLE `tbl_notifications` (
  `notification_id` int(11) NOT NULL AUTO_INCREMENT,
  `notification_text` text NOT NULL,
  `notification_status` varchar(120) NOT NULL,
  `datetime` datetime NOT NULL,
  `uid` int(11) NOT NULL,
  PRIMARY KEY (`notification_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tbl_notifications` VALUES('1','Notification Example','Read','2024-10-31 08:03:40','2');
INSERT INTO `tbl_notifications` VALUES('5','Journal Entry Number 23-0011 has been rejected','Read','2024-11-03 18:10:50','2');
INSERT INTO `tbl_notifications` VALUES('6','Journal Entry Number 23-0012 has been rejected','Read','2024-11-04 14:10:09','2');
INSERT INTO `tbl_notifications` VALUES('7','Journal Entry with 23-0012  has been rejected','Read','2024-11-05 11:55:55','2');
INSERT INTO `tbl_notifications` VALUES('8','Journal Entry with 23-0011  has been rejected','Read','2024-11-05 11:56:21','2');
INSERT INTO `tbl_notifications` VALUES('9','Journal Entry Number 24-0001 has been approved','Read','2024-11-06 06:40:46','2');
INSERT INTO `tbl_notifications` VALUES('10','Journal Entry Number 24-0002  has been rejected','Read','2024-11-06 09:17:38','1');
INSERT INTO `tbl_notifications` VALUES('11','Journal Entry Number 24-0003 has been approved','Unread','2024-11-06 13:35:50','2');
INSERT INTO `tbl_notifications` VALUES('12','Journal Entry Number 24-0002 has been approved','Unread','2024-11-06 13:36:21','1');
INSERT INTO `tbl_notifications` VALUES('13','Journal Entry Number 24-0004 has been approved','Unread','2024-11-06 13:49:40','2');
INSERT INTO `tbl_notifications` VALUES('14','Journal Entry with 24-0005  has been rejected','Unread','2024-11-25 13:43:01','1');



CREATE TABLE `tbl_signatories` (
  `signatory_id` int(11) NOT NULL AUTO_INCREMENT,
  `signatory_fname` varchar(120) NOT NULL,
  `signatory_mname` varchar(120) NOT NULL,
  `signatory_lname` varchar(120) NOT NULL,
  `signatory_position` varchar(120) NOT NULL,
  `signatory_status` varchar(80) NOT NULL,
  `signatory_date` date NOT NULL,
  PRIMARY KEY (`signatory_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tbl_signatories` VALUES('1','Victor','R.','Obillo','General Manager','Inactive','2023-11-01');
INSERT INTO `tbl_signatories` VALUES('2','Diluc','T.','Alberich','General Manager','Inactive','2023-01-01');
INSERT INTO `tbl_signatories` VALUES('3','Hector','L','Garcia','General Manager','Inactive','2022-01-30');
INSERT INTO `tbl_signatories` VALUES('4','Marie Ann','G','Fontanilla','General Manager','Active','2024-11-06');



CREATE TABLE `tbl_trial_balance` (
  `trial_balance_id` int(10) NOT NULL AUTO_INCREMENT,
  `account_code` int(8) NOT NULL,
  `total_debit` decimal(10,2) NOT NULL,
  `total_credit` decimal(10,2) NOT NULL,
  `trial_balance_date` date NOT NULL,
  `ledger_id` int(10) NOT NULL,
  `fiscal_id` int(11) NOT NULL,
  PRIMARY KEY (`trial_balance_id`)
) ENGINE=InnoDB AUTO_INCREMENT=127 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tbl_trial_balance` VALUES('62','10301010','12180500.00','0.00','2023-01-25','62','2');
INSERT INTO `tbl_trial_balance` VALUES('63','40202090','0.00','11814085.00','2023-01-25','63','2');
INSERT INTO `tbl_trial_balance` VALUES('64','40202230','0.00','366415.00','2023-01-25','64','2');
INSERT INTO `tbl_trial_balance` VALUES('65','10101010','11449670.00','0.00','2023-02-22','65','2');
INSERT INTO `tbl_trial_balance` VALUES('66','10301010','0.00','11449670.00','2023-02-22','66','2');
INSERT INTO `tbl_trial_balance` VALUES('67','10102020','10877186.50','0.00','2023-03-23','67','2');
INSERT INTO `tbl_trial_balance` VALUES('68','10101010','0.00','10877186.50','2023-03-23','68','2');
INSERT INTO `tbl_trial_balance` VALUES('69','10607010','15000.00','0.00','2023-05-24','69','2');
INSERT INTO `tbl_trial_balance` VALUES('70','10605030','25700.00','0.00','2023-05-24','70','2');
INSERT INTO `tbl_trial_balance` VALUES('71','10606010','80550.00','0.00','2023-05-24','71','2');
INSERT INTO `tbl_trial_balance` VALUES('72','20201010','0.00','7031.25','2023-05-24','72','2');
INSERT INTO `tbl_trial_balance` VALUES('73','10102020','0.00','114218.75','2023-05-24','73','2');
INSERT INTO `tbl_trial_balance` VALUES('74','10101020','15000.00','0.00','2023-05-30','74','2');
INSERT INTO `tbl_trial_balance` VALUES('75','10102020','0.00','15000.00','2023-05-30','75','2');
INSERT INTO `tbl_trial_balance` VALUES('76','50101010','4380000.00','0.00','2023-07-31','76','2');
INSERT INTO `tbl_trial_balance` VALUES('77','20201020','0.00','394200.00','2023-07-31','77','2');
INSERT INTO `tbl_trial_balance` VALUES('78','20201030','0.00','87600.00','2023-07-31','78','2');
INSERT INTO `tbl_trial_balance` VALUES('79','20201040','0.00','109500.00','2023-07-31','79','2');
INSERT INTO `tbl_trial_balance` VALUES('80','10102020','0.00','3788700.00','2023-07-31','80','2');
INSERT INTO `tbl_trial_balance` VALUES('81','10404020','125000.00','0.00','2023-10-27','81','2');
INSERT INTO `tbl_trial_balance` VALUES('82','10404120','48600.00','0.00','2023-10-27','82','2');
INSERT INTO `tbl_trial_balance` VALUES('83','10404990','235100.00','0.00','2023-10-27','83','2');
INSERT INTO `tbl_trial_balance` VALUES('84','20101010','0.00','408700.00','2023-10-27','84','2');
INSERT INTO `tbl_trial_balance` VALUES('85','10102020','500000.00','0.00','2023-11-13','85','2');
INSERT INTO `tbl_trial_balance` VALUES('86','20101040','0.00','500000.00','2023-11-13','86','2');
INSERT INTO `tbl_trial_balance` VALUES('87','50203010','4671.00','0.00','2023-12-01','87','2');
INSERT INTO `tbl_trial_balance` VALUES('88','50203090','3950.00','0.00','2023-12-01','88','2');
INSERT INTO `tbl_trial_balance` VALUES('89','50205010','360.00','0.00','2023-12-01','89','2');
INSERT INTO `tbl_trial_balance` VALUES('90','50299020','1050.00','0.00','2023-12-01','90','2');
INSERT INTO `tbl_trial_balance` VALUES('91','50299030','2760.00','0.00','2023-12-01','91','2');
INSERT INTO `tbl_trial_balance` VALUES('92','50213030','1610.00','0.00','2023-12-01','92','2');
INSERT INTO `tbl_trial_balance` VALUES('93','10102020','0.00','14401.00','2023-12-01','93','2');
INSERT INTO `tbl_trial_balance` VALUES('94','40202090','11814085.00','0.00','2023-12-31','94','2');
INSERT INTO `tbl_trial_balance` VALUES('95','40202230','366415.00','0.00','2023-12-31','95','2');
INSERT INTO `tbl_trial_balance` VALUES('96','50101010','0.00','4380000.00','2023-12-31','96','2');
INSERT INTO `tbl_trial_balance` VALUES('97','50203010','0.00','4671.00','2023-12-31','97','2');
INSERT INTO `tbl_trial_balance` VALUES('98','50203090','0.00','3950.00','2023-12-31','98','2');
INSERT INTO `tbl_trial_balance` VALUES('99','50205010','0.00','360.00','2023-12-31','99','2');
INSERT INTO `tbl_trial_balance` VALUES('100','50213030','0.00','1610.00','2023-12-31','100','2');
INSERT INTO `tbl_trial_balance` VALUES('101','50299020','0.00','1050.00','2023-12-31','101','2');
INSERT INTO `tbl_trial_balance` VALUES('102','50299030','0.00','2760.00','2023-12-31','102','2');
INSERT INTO `tbl_trial_balance` VALUES('103','30701010','0.00','7786099.00','2023-12-31','103','2');
INSERT INTO `tbl_trial_balance` VALUES('113','10101010','10000.00','0.00','2023-12-31','113','2');
INSERT INTO `tbl_trial_balance` VALUES('114','10101020','0.00','10000.00','2023-12-31','114','2');
INSERT INTO `tbl_trial_balance` VALUES('115','10102020','30000.00','0.00','2023-12-31','115','2');
INSERT INTO `tbl_trial_balance` VALUES('116','10101010','0.00','30000.00','2023-12-31','116','2');
INSERT INTO `tbl_trial_balance` VALUES('117','10607010','15000.00','0.00','2024-11-05','117','3');
INSERT INTO `tbl_trial_balance` VALUES('118','20101010','0.00','15000.00','2024-11-05','118','3');
INSERT INTO `tbl_trial_balance` VALUES('119','10605030','50000.00','0.00','2024-11-06','119','3');
INSERT INTO `tbl_trial_balance` VALUES('120','20101010','0.00','50000.00','2024-11-06','120','3');
INSERT INTO `tbl_trial_balance` VALUES('121','10101010','50000.00','0.00','2024-11-06','121','3');
INSERT INTO `tbl_trial_balance` VALUES('122','10102020','0.00','50000.00','2024-11-06','122','3');
INSERT INTO `tbl_trial_balance` VALUES('123','20101010','30000.00','0.00','2024-11-06','123','3');
INSERT INTO `tbl_trial_balance` VALUES('124','10102020','0.00','30000.00','2024-11-06','124','3');
INSERT INTO `tbl_trial_balance` VALUES('125','10101010','60000.00','0.00','2024-11-25','125','3');
INSERT INTO `tbl_trial_balance` VALUES('126','10102020','0.00','60000.00','2024-11-25','126','3');



CREATE TABLE `tbl_user` (
  `uid` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `userlevel` varchar(100) NOT NULL,
  `user_status` varchar(100) NOT NULL,
  `user_info_id` int(10) NOT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tbl_user` VALUES('1','admin','$2y$10$Sia0EyxKRHkR5xlNDJeyvO.tLcIwSrZHhBYxO6beqy0GGxpGhDXhm','Administrator','Active','1');
INSERT INTO `tbl_user` VALUES('2','user2','$2y$10$8FuuJWc8QMb/p.R79jGgL.G.uAWv2TsuAr9y0X.6Rar8BpVbeiyFq','Cashier','Active','2');
INSERT INTO `tbl_user` VALUES('12','user3','$2y$10$PgpzOjA808jTeEvtwzuWeuKmANAGpX08vvAMcrdEFHm.Tbs/k.M12','Accounting Processor','Active','12');
INSERT INTO `tbl_user` VALUES('13','user6','$2y$10$qRvj7xCC3Y.79hnpKhCqUO048L3wgpJvP.ZAyibB8X0Pihlyg7TCu','Cashier','Inactive','13');



CREATE TABLE `tbl_user_info` (
  `user_info_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_fname` varchar(120) NOT NULL,
  `user_mname` varchar(120) NOT NULL,
  `user_lname` varchar(120) NOT NULL,
  `user_position` varchar(150) NOT NULL,
  PRIMARY KEY (`user_info_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tbl_user_info` VALUES('1','Marilou','R.','Pangilinan','System Administrator');
INSERT INTO `tbl_user_info` VALUES('2','Alorna','L.','Castillo','Cashier C');
INSERT INTO `tbl_user_info` VALUES('12','Joan','O.','Valdez','Accounting Processor B');
INSERT INTO `tbl_user_info` VALUES('13','Inactive','N.','Brooks','Cashier B');

