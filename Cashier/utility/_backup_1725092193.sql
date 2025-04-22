

CREATE TABLE `tbl_account_class` (
  `class_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `type_code` int(11) NOT NULL,
  PRIMARY KEY (`class_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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



CREATE TABLE `tbl_account_title` (
  `account_code` int(8) NOT NULL,
  `account_name` varchar(150) NOT NULL,
  `account_type` varchar(150) NOT NULL,
  `type_code` int(10) NOT NULL,
  PRIMARY KEY (`account_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tbl_account_title` VALUES('10101010',' Cash-Collecting Officers','Current Assets','6');
INSERT INTO `tbl_account_title` VALUES('10101020','Petty Cash - General Fund','Current Assets','6');
INSERT INTO `tbl_account_title` VALUES('10101030','Local Currency on Hand','Assets','1');
INSERT INTO `tbl_account_title` VALUES('10102020','Cash in Bank, Local Currency - Current Accounts','Current Assets','6');
INSERT INTO `tbl_account_title` VALUES('10301012','Allowance for Impairment- Accounts Receivable','Current Assets','6');
INSERT INTO `tbl_account_title` VALUES('10301020','Notes Receivable','Assets','1');
INSERT INTO `tbl_account_title` VALUES('10303010','Due from NGAs','Current Assets','6');
INSERT INTO `tbl_account_title` VALUES('10303050','Due from Government Corporation','Current Assets','6');
INSERT INTO `tbl_account_title` VALUES('10399010','Receivables-Disallowances/Charges','Current Assets','6');
INSERT INTO `tbl_account_title` VALUES('10399020','Due from Officers and Employees','Current Assets','6');
INSERT INTO `tbl_account_title` VALUES('10399990','Other Receivables','Current Assets','6');
INSERT INTO `tbl_account_title` VALUES('10404020','Accountable Forms, Plates and Stickers Inventory','Current Assets','6');
INSERT INTO `tbl_account_title` VALUES('10404120','Chemical and Filtering Supplies Inventory','Current Assets','6');
INSERT INTO `tbl_account_title` VALUES('10404130','Construction Materials Inventory','Current Assets','6');
INSERT INTO `tbl_account_title` VALUES('10404990','Other Supplies and Materials Inventory','Current Assets','6');
INSERT INTO `tbl_account_title` VALUES('10601010','Land','Non-Current Assets','7');
INSERT INTO `tbl_account_title` VALUES('10603040','Water Supply Systems','Non-Current Assets','7');
INSERT INTO `tbl_account_title` VALUES('10603041','Accumulated Depreciation-Water Supply System','Non-Current Assets','7');
INSERT INTO `tbl_account_title` VALUES('10604010','Buildings','Non-Current Assets','7');
INSERT INTO `tbl_account_title` VALUES('10604011','Accumulated Depreciation- Building','Non-Current Assets','7');
INSERT INTO `tbl_account_title` VALUES('10604990','Other Structures','Non-Current Assets','7');
INSERT INTO `tbl_account_title` VALUES('10604991','Accumulated Depreciation-Other Structures','Non-Current Assets','7');
INSERT INTO `tbl_account_title` VALUES('10605020','Office Equipment','Non-Current Assets','7');
INSERT INTO `tbl_account_title` VALUES('10605021','Accumulated Depreciation-Office Equipment','Non-Current Assets','7');
INSERT INTO `tbl_account_title` VALUES('10605030','ICT Equipment','Non-Current Assets','7');
INSERT INTO `tbl_account_title` VALUES('10605031','Accumulated Depreciation-ICT Equipment','Non-Current Assets','7');
INSERT INTO `tbl_account_title` VALUES('10605070','Communications Equipment','Non-Current Assets','7');
INSERT INTO `tbl_account_title` VALUES('10605071','Accumulated Depreciation-Communications Equipment','Non-Current Assets','7');
INSERT INTO `tbl_account_title` VALUES('10605990','Other Machine and Equipment','Non-Current Assets','7');
INSERT INTO `tbl_account_title` VALUES('10605991','Accumulated Depreciation-Other Machinery and Equipment','Non-Current Assets','7');
INSERT INTO `tbl_account_title` VALUES('10606010','Motor Vehicles','Non-Current Assets','7');
INSERT INTO `tbl_account_title` VALUES('10606011','Accumulated Depreciation-Motor Vehicles','Non-Current Assets','7');
INSERT INTO `tbl_account_title` VALUES('10606990','Other Transportation Equipment','Non-Current Assets','7');
INSERT INTO `tbl_account_title` VALUES('10606991','Accumulated Depreciation-Other Transportation Equipment','Non-Current Assets','7');
INSERT INTO `tbl_account_title` VALUES('10607010','Furnitures and Fixtures','Non-Current Assets','7');
INSERT INTO `tbl_account_title` VALUES('10607011','Accumulated Depreciation- Furnitures and Fixtures','Non-Current Assets','7');
INSERT INTO `tbl_account_title` VALUES('19902020','Prepaid Rent','Current Assets','6');
INSERT INTO `tbl_account_title` VALUES('20101010','Accounts Payable','Liability','2');
INSERT INTO `tbl_account_title` VALUES('30801010','Share Capital','Equity','3');



CREATE TABLE `tbl_account_type` (
  `type_code` int(8) NOT NULL AUTO_INCREMENT,
  `account_type` varchar(100) NOT NULL,
  `normal_balance` varchar(100) NOT NULL,
  `type_description` text NOT NULL,
  `reports_needed` varchar(100) NOT NULL,
  PRIMARY KEY (`type_code`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tbl_account_type` VALUES('1','Asset','Debit','','');
INSERT INTO `tbl_account_type` VALUES('2','Liabilities','Credit','It is used to keep track of all legally-binding debts that must be paid to someone else','Balance Sheet');
INSERT INTO `tbl_account_type` VALUES('3','Equity','Credit','Equity accounts represent the financial ownership in a company and are visible in the balance sheet immediately after the liability accounts.','Balance Sheet');
INSERT INTO `tbl_account_type` VALUES('4','Expenses','Debit','','Income Statement');
INSERT INTO `tbl_account_type` VALUES('5','Revenue','Credit','','Income Statement');
INSERT INTO `tbl_account_type` VALUES('6','Current Assets','Debit','It is any resource a company could use, turn into cash, or sell within a year.','Balance Sheet');
INSERT INTO `tbl_account_type` VALUES('7','Non-Current Assets','Debit','They are assets and property owned by a business that are not easily converted to cash within a year','Balance Sheet');
INSERT INTO `tbl_account_type` VALUES('8','Contra-Asset','Credit',' The account offsets the balance in the respective asset account that it is paired with on the balance sheet.','');
INSERT INTO `tbl_account_type` VALUES('9','Long-Term Liabilities','Credit','Long-term liabilities, also called long-term debts, are debts a company owes third-party creditors that are payable beyond 12 months.','');
INSERT INTO `tbl_account_type` VALUES('10','Personnel Services','Debit',' This is for Personnel Services Expenses','');
INSERT INTO `tbl_account_type` VALUES('11','Maintenance and Other Operating Expenses','Debit',' For Maintenance Expenses','');
INSERT INTO `tbl_account_type` VALUES('12','Non Cash Expense','Debit',' Non Cash Expenses','');
INSERT INTO `tbl_account_type` VALUES('13','Financial Expense','Debit','They are costs incurred from borrowing from lenders or creditors.','');



CREATE TABLE `tbl_fiscal_year` (
  `fiscal_id` int(11) NOT NULL AUTO_INCREMENT,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `description` text NOT NULL,
  `fiscal_status` varchar(100) NOT NULL,
  PRIMARY KEY (`fiscal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tbl_fiscal_year` VALUES('1','2024-01-01','2024-12-31','Fiscal Year 2024','Active');
INSERT INTO `tbl_fiscal_year` VALUES('2','2025-01-01','2025-12-31','Fiscal Year 2025','Inactive');



CREATE TABLE `tbl_general_ledger` (
  `ledger_id` int(8) NOT NULL AUTO_INCREMENT,
  `ledger_date` date NOT NULL,
  `account_code` int(8) NOT NULL,
  `debit` decimal(10,2) NOT NULL,
  `credit` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `journal_voucher_id` int(8) NOT NULL,
  PRIMARY KEY (`ledger_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tbl_general_ledger` VALUES('1','2024-06-12','10101010','2000.00','0.00','To record Cash Collecting','1');
INSERT INTO `tbl_general_ledger` VALUES('2','2024-06-12','10301020','0.00','2000.00','To Record Cash Collecting','1');
INSERT INTO `tbl_general_ledger` VALUES('15','2024-08-28','10101020','2000.00','0.00','To record Petty Cash - General Fund','28');
INSERT INTO `tbl_general_ledger` VALUES('16','2024-08-28','30801010','0.00','2000.00','To record Petty Cash - General Fund','28');
INSERT INTO `tbl_general_ledger` VALUES('19','2024-08-29','10101010','3000.00','0.00','To record Collecting Payments','30');
INSERT INTO `tbl_general_ledger` VALUES('20','2024-08-29','10101030','0.00','3000.00','To record Collecting Payments','30');



CREATE TABLE `tbl_journal_category` (
  `category_id` int(8) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `category_description` text NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tbl_journal_category` VALUES('1','Billing','For the Billing Processes');
INSERT INTO `tbl_journal_category` VALUES('2','Collection','This category is for the collection Processes of the Water District');
INSERT INTO `tbl_journal_category` VALUES('3','Disbursement','Records payment transactions of the organization');
INSERT INTO `tbl_journal_category` VALUES('4','Adjustments/Accrual','Used for adjusting entries and accrued transactions');
INSERT INTO `tbl_journal_category` VALUES('5','Materials','Used for materials in the inventory');



CREATE TABLE `tbl_journal_entry` (
  `journal_voucher_id` int(8) NOT NULL AUTO_INCREMENT,
  `journal_voucher_no` varchar(10) NOT NULL,
  `journal_date` date NOT NULL,
  `description` text NOT NULL,
  `uid` int(8) NOT NULL,
  `category_id` int(10) NOT NULL,
  PRIMARY KEY (`journal_voucher_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tbl_journal_entry` VALUES('1','24-0001','2024-06-12','To record Collecting Payments','1','1');
INSERT INTO `tbl_journal_entry` VALUES('2','24-0002','2024-06-13','To record Petty Cash ','1','3');
INSERT INTO `tbl_journal_entry` VALUES('28','24-0003','2024-08-28','To record Petty Cash - General Fund','1','1');
INSERT INTO `tbl_journal_entry` VALUES('29','24-0004','2024-08-29','To record Collecting Payments','1','1');
INSERT INTO `tbl_journal_entry` VALUES('30','24-0005','2024-08-01','To record Collecting Payments','1','1');



CREATE TABLE `tbl_journal_items` (
  `journal_item_id` int(8) NOT NULL AUTO_INCREMENT,
  `journal_voucher_id` int(10) NOT NULL,
  `account_code` int(8) NOT NULL,
  `journal_amount` decimal(10,2) NOT NULL,
  `journal_adjustment` varchar(100) NOT NULL,
  PRIMARY KEY (`journal_item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tbl_journal_items` VALUES('1','1','10101010','2000.00','Debit');
INSERT INTO `tbl_journal_items` VALUES('2','1','10301020','2000.00','Credit');
INSERT INTO `tbl_journal_items` VALUES('3','2','10101010','1500.00','Debit');
INSERT INTO `tbl_journal_items` VALUES('4','2','10101020','1500.00','Credit');
INSERT INTO `tbl_journal_items` VALUES('35','21','10101010','2000.00','Debit');
INSERT INTO `tbl_journal_items` VALUES('36','21','30801010','2000.00','Credit');
INSERT INTO `tbl_journal_items` VALUES('37','22','10101010','4000.00','Debit');
INSERT INTO `tbl_journal_items` VALUES('38','22','20101010','4000.00','Credit');
INSERT INTO `tbl_journal_items` VALUES('39','23','10101010','1200.00','Debit');
INSERT INTO `tbl_journal_items` VALUES('40','23','10101010','1000.00','Credit');
INSERT INTO `tbl_journal_items` VALUES('41','23','10101010','200.00','Credit');
INSERT INTO `tbl_journal_items` VALUES('42','24','10101030','2000.00','Debit');
INSERT INTO `tbl_journal_items` VALUES('43','24','20101010','2000.00','Credit');
INSERT INTO `tbl_journal_items` VALUES('47','28','10101020','2000.00','Debit');
INSERT INTO `tbl_journal_items` VALUES('48','28','30801010','2000.00','Credit');
INSERT INTO `tbl_journal_items` VALUES('49','29','10101010','2000.00','Debit');
INSERT INTO `tbl_journal_items` VALUES('50','29','10101020','2000.00','Credit');
INSERT INTO `tbl_journal_items` VALUES('51','30','10101010','3000.00','Debit');
INSERT INTO `tbl_journal_items` VALUES('52','30','10101030','3000.00','Credit');



CREATE TABLE `tbl_trial_balance` (
  `trial_balance_id` int(10) NOT NULL AUTO_INCREMENT,
  `account_code` int(8) NOT NULL,
  `total_debit` decimal(10,2) NOT NULL,
  `total_credit` decimal(10,2) NOT NULL,
  `trial_balance_date` date NOT NULL,
  `ledger_id` int(10) NOT NULL,
  PRIMARY KEY (`trial_balance_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tbl_trial_balance` VALUES('1','10101020','2000.00','0.00','2024-08-28','15');
INSERT INTO `tbl_trial_balance` VALUES('2','30801010','0.00','2000.00','2024-08-28','16');
INSERT INTO `tbl_trial_balance` VALUES('5','10101010','3000.00','0.00','2024-08-29','19');
INSERT INTO `tbl_trial_balance` VALUES('6','10101030','0.00','3000.00','2024-08-29','20');



CREATE TABLE `tbl_user` (
  `uid` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `userlevel` varchar(100) NOT NULL,
  `user_status` varchar(100) NOT NULL,
  `user_info_id` int(10) NOT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tbl_user` VALUES('1','admin','$2y$10$Sia0EyxKRHkR5xlNDJeyvO.tLcIwSrZHhBYxO6beqy0GGxpGhDXhm','Administrator','Active','1');
INSERT INTO `tbl_user` VALUES('2','user2','$2y$10$8FuuJWc8QMb/p.R79jGgL.G.uAWv2TsuAr9y0X.6Rar8BpVbeiyFq','Cashier','Active','2');



CREATE TABLE `tbl_user_info` (
  `user_info_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_fname` varchar(120) NOT NULL,
  `user_mname` varchar(120) NOT NULL,
  `user_lname` varchar(120) NOT NULL,
  PRIMARY KEY (`user_info_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `tbl_user_info` VALUES('1','Jack','Lopez','Gates');
INSERT INTO `tbl_user_info` VALUES('2','Jenny','Lopes','Reyes');

