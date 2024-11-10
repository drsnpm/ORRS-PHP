SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE `orrs_admin` (
  `admin_id` int(20) NOT NULL,
  `admin_fname` varchar(200) NOT NULL,
  `admin_lname` varchar(200) NOT NULL,
  `admin_email` varchar(200) NOT NULL,
  `admin_uname` varchar(200) NOT NULL,
  `admin_pwd` varchar(200) NOT NULL,
  `admin_dpic` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

INSERT INTO `orrs_admin` (`admin_id`, `admin_fname`, `admin_lname`, `admin_email`, `admin_uname`, `admin_pwd`, `admin_dpic`) VALUES
(1, 'Darshan ', 'PM', 'darshanmoger54@gmail.com', 'drsn_pm', '64ec7e5aed6d5e33835484fe5e01b44dba8c0ee5', 'admin-icn.png');

CREATE TABLE `orrs_employee` (
  `emp_id` int(20) NOT NULL,
  `emp_fname` varchar(200) NOT NULL,
  `emp_lname` varchar(200) NOT NULL,
  `emp_nat_idno` varchar(200) NOT NULL,
  `emp_phone` varchar(200) NOT NULL,
  `emp_addr` varchar(200) NOT NULL,
  `emp_uname` varchar(200) NOT NULL,
  `emp_email` varchar(200) NOT NULL,
  `emp_pwd` varchar(200) NOT NULL,
  `emp_dpic` varchar(200) NOT NULL,
  `emp_dept` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

INSERT INTO `orrs_employee` (`emp_id`, `emp_fname`, `emp_lname`, `emp_nat_idno`, `emp_phone`, `emp_addr`, `emp_uname`, `emp_email`, `emp_pwd`, `emp_dpic`, `emp_dept`) VALUES
(1, 'Keshav ', 'PM', '945037207784', '6360364431', 'Bhatkal', 'KPM', 'keshav@gmail.com', '1f82ea75c5cc526729e2d581aeb3aeccfef4407e', 'defaultimg.jpg', 'Train Captain');

CREATE TABLE `orrs_train` (
  `id` int(20) NOT NULL,
  `number` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `route` varchar(200) NOT NULL,
  -- `current` varchar(200) NOT NULL,
  -- `destination` varchar(200) NOT NULL,
  -- `time` varchar(200) NOT NULL,
  `date` varchar(200) NOT NULL,
  `departure_time` varchar(200) NOT NULL,
  `arrival_time` varchar(200) NOT NULL,
  `passengers` varchar(200) NOT NULL,
  `fare` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

INSERT INTO `orrs_train` (`id`, `number`, `name`, `route`, `date`, `departure_time`, `arrival_time`, `passengers`, `fare`) VALUES
(6, 'T01', 'Basava Express', 'Banglore - Manglore', '30-03-2024', '7:00 AM', '12:00 PM', '195', '500'),
(10, 'T02','Brindavan Express', 'Banglore - Chennai', '10-04-2024', '12:00 PM', '4:00 PM', '200', '400'),
(11, 'T03', 'Shatabdi Express', 'Banglore - Kolkatta', '30-03-2024', '12:00 AM', '7:00 AM', '185', '800'),
(12, 'T04', 'Manglore Express', 'Manglore - Hubbalii', '03-04-2024', '8:30 AM', '11:30 AM', '255', '200'),
(13, 'T05', 'Udupi Express', 'Udupi - Davangere', '10-04-2024', '11:30 AM', '7:00 PM', '330', '250'),
(14, 'T06', 'Kundapura Express', 'Kundapura - Manglore', '11-04-2024', '9:30 AM', '11:30 AM', '200', '128'),
(15, 'T07', 'Bhatkal Express', 'Bhatkal - Banglore', '12-04-2024','6:00 PM', '7:00 AM', '190', '230'),
(16, 'T08', 'Banglore Express', 'Banglore - Udupi', '17-04-2024', '11:30 AM', '9:30 PM', '210', '198'),
(17, 'T09', 'Rani Chennamma Express', 'Banglore - Bihaar', '20-04-2024', '7:00 PM', '9:30 AM', '100', '1000');


-- INSERT INTO `orrs_train` (`id`, `name`, `route`, `current`, `destination`, `time`, `passengers`, `number`, `fare`) VALUES
-- (6, 'Basava Express', 'Banglore - Manglore', 'Banglore', 'Manglore', '2023-02-03T17:00', '195', 'T01', '500'),
-- (10, 'Brindavan Express', 'Banglore - Chennai', 'Banglore', 'Chennai', '2023-02-02T11:00', '200', 'T02', '400'),
-- (11, 'Shatabdi Express', 'Banglore - Kolkatta', 'Banglore', 'Kolkatta', '2023-01-30T20:45', '185', 'T03', '800'),
-- (12, 'Manglore Express', 'Manglore - Hubbalii', 'Manglore', 'Hubballi', '2023-01-30T20:45', '255', 'T04', '200'),
-- (13, 'Udupi Express', 'Udupi - Davangere', 'Udupi', 'Davangere', '2023-01-31T9:00', '330', 'T05', '250'),
-- (14, 'Kundapura Express', 'Kundapura - Manglore', ' Kundapura', 'Manglore', '2023-01-31T10:00', '200', 'T06', '128'),
-- (15, 'Bhatkal Express', 'Bhatkal - Banglore', 'Bhatkal', 'Banglore', '2023-01-30T23:45', '190', 'T07', '230'),
-- (16, 'Banglore Express', 'Banglore - Udupi', 'Banglore', 'Udupi', '2023-01-30T16:00 ', '210', 'T08', '198'),
-- (17, 'Rani Chennamma Express', 'Banglore - Bihaar', 'Banglore', 'Bihaar', '2023-01-31T12:45', '100', 'T09', '1000');

CREATE TABLE `orrs_passenger` (
  `pass_id` int(20) NOT NULL,
  `pass_fname` varchar(200) NOT NULL,
  `pass_lname` varchar(200) NOT NULL,
  `pass_phone` varchar(200) NOT NULL,
  `pass_addr` varchar(200) NOT NULL,
  `pass_email` varchar(200) NOT NULL,
  `pass_pwd` varchar(200) NOT NULL,
  `pass_dpic` varchar(200) NOT NULL,
  `pass_uname` varchar(200) NOT NULL,
  `pass_bday` varchar(200) NOT NULL,
  `pass_bio` longtext NOT NULL,
  `pass_train_number` varchar(200) NOT NULL,
  `pass_train_name` varchar(200) NOT NULL,
  `pass_train_route` varchar(200) NOT NULL,
  `pass_dep_date` varchar(200) NOT NULL,
  `pass_dep_station_time` varchar(200) NOT NULL,
  `pass_arr_station_time` varchar(200) NOT NULL,
  `pass_train_fare` varchar(200) NOT NULL,
  `pass_fare_payment_code` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;




INSERT INTO `orrs_passenger` (`pass_id`, `pass_fname`, `pass_lname`, `pass_phone`, `pass_addr`, `pass_email`, `pass_pwd`, `pass_dpic`, `pass_uname`, `pass_bday`, `pass_bio`, `pass_train_number`, `pass_train_name`, `pass_train_route`, `pass_dep_date`, `pass_dep_station_time`, `pass_arr_station_time`, `pass_train_fare`, `pass_fare_payment_code`) VALUES
(4, 'Abhi', 'J', '9901052881', 'Shivmogga', 'abhi@gmail.com', '1f82ea75c5cc526729e2d581aeb3aeccfef4407e', 'defaultimg.jpg', 'abhi', '', '',  '','',  '', '','', '', '', ''),
(5, 'Karthik', 'K', '8088930547', 'Ranebennuru', 'karthik@gmail.com', '1f82ea75c5cc526729e2d581aeb3aeccfef4407e', 'defaultimg.jpg', 'karthik', '', '',  '','',  '', '','', '', '', ''),
(6, 'Hemanth', 'Rao', '8050630558', 'Chikkamagalooru', 'hemanth@gmail.com', '1f82ea75c5cc526729e2d581aeb3aeccfef4407e', 'defaultimg.jpg', 'hemanth', '', '',  '','',  '', '','', '', '', ''),
(7, 'Darshan', 'VS', '9611780900', 'Banglore', 'vs@gmail.com', '1f82ea75c5cc526729e2d581aeb3aeccfef4407e', 'defaultimg.jpg', 'darshan',  '', '',  '','',  '', '','', '', '', ''),
(8, 'Darshan', 'CS', '8147497665', 'Shivmogga', 'cs@gmail.com', '1f82ea75c5cc526729e2d581aeb3aeccfef4407e', 'defaultimg.jpg', 'darshan',  '', '',  '','',  '', '','', '', '', ''),
(9, 'Darshan', 'K', '9900503318', 'Davangere', 'k@gmail.com', '1f82ea75c5cc526729e2d581aeb3aeccfef4407e', 'defaultimg.jpg', 'darshan',  '', '',  '','',  '', '','', '', '', ''),
(10, 'Darshan', 'PM', '8088944065', 'Bhatkal', 'pm@gmail.com', '1f82ea75c5cc526729e2d581aeb3aeccfef4407e', 'defaultimg.jpg', 'darshan', '', '',  '','',  '', '','', '', '', ''),
(11, 'Adhi', 'Khadam', '7896547777', 'Gulbarga', 'adhi@gmail.com', '1f82ea75c5cc526729e2d581aeb3aeccfef4407e', 'defaultimg.jpg', 'adhi',  '', '',  '','',  '', '','', '', '', ''),
(12, 'Naren', 'DP', '4570001569', 'Davangere', 'naren@gmail.com', '1f82ea75c5cc526729e2d581aeb3aeccfef4407e', 'defaultimg.jpg', 'naren',  '', '',  '','',  '', '','', '', '', ''),
(13, 'Manja', 'BH', '1475458500', 'Shivmogga', 'bh@gmail.com', '1f82ea75c5cc526729e2d581aeb3aeccfef4407e', 'defaultimg.jpg', 'manja',  '', '',  '','',  '', '','', '', '', ''),
(14, 'Manja', 'K', '123650014', 'Tumkur', 'skiddy@gmail.com', '1f82ea75c5cc526729e2d581aeb3aeccfef4407e', 'defaultimg.jpg', 'manja',  '', '',  '','',  '', '','', '', '', ''),
(15, 'Sujay', 'Patil', '5478540000', 'Shivmogga', 'sujay@gmail.com', '1f82ea75c5cc526729e2d581aeb3aeccfef4407e', 'defaultimg.jpg', 'sujay', '', '',  '','',  '', '','', '', '', ''),
(16, 'Rohit', 'Shetty', '3745698850', 'Kundapura', 'rohit@gmail.com', '1f82ea75c5cc526729e2d581aeb3aeccfef4407e', 'defaultimg.jpg', 'rohit', '', '',  '','',  '', '','', '', '', ''),
(17, 'Nithin', 'BR', '6547778540', 'Durga', 'nithin@gmail.com', '1f82ea75c5cc526729e2d581aeb3aeccfef4407e', 'defaultimg.jpg', 'nithin', '', '',  '','',  '', '','', '', '', ''),
(18, 'Ankith', 'Jaa', '6478540000', 'Bihaar', 'ankith@gmail.com', '1f82ea75c5cc526729e2d581aeb3aeccfef4407e', 'defaultimg.jpg', 'ankith', '', '',  '','',  '', '','', '', '', ''),
(19, 'Deepak', 'Patil', '7696965450', 'Durga', 'deepak@gmail.com', '1f82ea75c5cc526729e2d581aeb3aeccfef4407e', 'defaultimg.jpg', 'deepak',  '', '',  '','',  '', '','', '', '', ''),
(20, 'Mayur', 'Naik', '4750001458', 'Kumuta', 'mayur@gmail.com', '1f82ea75c5cc526729e2d581aeb3aeccfef4407e', 'defaultimg.jpg', 'mayur', '', '',  '','',  '', '','', '', '', '');



-- INSERT INTO `orrs_passenger` (`pass_id`, `pass_fname`, `pass_lname`, `pass_phone`, `pass_addr`, `pass_email`, `pass_pwd`, `pass_dpic`, `pass_uname`, `pass_bday`, `pass_bio`, `pass_train_number`, `pass_train_name`, `pass_dep_station`, `pass_dep_time`, `pass_arr_station`, `pass_train_fare`, `pass_fare_payment_code`, `emp_id`) VALUES
-- (4, 'Abhi', 'J', '9901052881', 'Shivmogga', 'abhi@gmail.com', '1f82ea75c5cc526729e2d581aeb3aeccfef4407e', 'defaultimg.jpg', 'abhi', '', '', 'T01', 'Basava Express', 'Banglore', '2023-02-03T17:00', 'Manglore', '500', 'CAS0014587', 1),
-- (5, 'Karthik', 'K', '8088930547', 'Ranebennuru', 'karthik@gmail.com', '1f82ea75c5cc526729e2d581aeb3aeccfef4407e', 'defaultimg.jpg', 'karthik', '', '', 'T02', 'Brindavan Express', 'Banglore', '2023-01-30T20:45', 'Chennai', '400', '2458700041', 1),
-- (6, 'Hemanth', 'Rao', '8050630558', 'Chikkamagalooru', 'hemanth@gmail.com', '1f82ea75c5cc526729e2d581aeb3aeccfef4407e', 'defaultimg.jpg', 'hemanth', '', '', 'T03', 'Shatabdi Express', 'Banglore', '2023-02-05T7:45', 'Kolkatta', '800', '56452120', 1),
-- (7, 'Darshan', 'VS', '9611780900', 'Banglore', 'vs@gmail.com', '1f82ea75c5cc526729e2d581aeb3aeccfef4407e', 'defaultimg.jpg', 'darshan', '', '', 'T03', 'Shatabdi Express', 'Banglore', '2023-01-30T20:45', 'Kolkatta', '800', '456452120', 1),
-- (8, 'Darshan', 'CS', '8147497665', 'Shivmogga', 'cs@gmail.com', '1f82ea75c5cc526729e2d581aeb3aeccfef4407e', 'defaultimg.jpg', 'darshan', '', '', 'T01', 'Basava Express', 'Banglore', '2023-02-03T17:00', 'Manglore', '500', 'CAS0014522', 1),
-- (9, 'Darshan', 'K', '9900503318', 'Davangere', 'k@gmail.com', '1f82ea75c5cc526729e2d581aeb3aeccfef4407e', 'defaultimg.jpg', 'darshan', '', '', 'T02', 'Brindavan Express', 'Banglore', '2023-02-02T11:00', 'Chennai', '400', '102458741', 1),
-- (10, 'Darshan', 'PM', '8088944065', 'Bhatkal', 'pm@gmail.com', '1f82ea75c5cc526729e2d581aeb3aeccfef4407e', 'defaultimg.jpg', 'darshan', '', '', 'T07', 'Bhatkal Express', 'Bhatkal', '2023-01-30T23:45', 'Banglore', '230', '99323377',1),
-- (11, 'Adhi', 'Khadam', '7896547777', 'Gulbarga', 'adhi@gmail.com', '1f82ea75c5cc526729e2d581aeb3aeccfef4407e', 'defaultimg.jpg', 'adhi', '', '', 'T03', 'Shatabdi Express', 'Banglore', '2023-01-30T20:45', 'Kolkatta', '800', '956452120', 1),
-- (12, 'Naren', 'DP', '4570001569', 'Davangere', 'naren@gmail.com', '1f82ea75c5cc526729e2d581aeb3aeccfef4407e', 'defaultimg.jpg', 'naren', '', '', 'T07', 'Bhatkal Express', 'Bhatkal', '2023-01-30T23:45', 'Banglore', '230', '35523377', 1),
-- (13, 'Manja', 'BH', '1475458500', 'Shivmogga', 'bh@gmail.com', '1f82ea75c5cc526729e2d581aeb3aeccfef4407e', 'defaultimg.jpg', 'manja', '', '', 'T02', 'Brindavan Express', 'Banglore', '2023-02-02T11:00', 'Chennai', '400', '700041', 1),
-- (14, 'Manja', 'K', '123650014', 'Tumkur', 'skiddy@gmail.com', '1f82ea75c5cc526729e2d581aeb3aeccfef4407e', 'defaultimg.jpg', 'manja', '', '', 'T03', 'Shatabdi Express', 'Banglore', '2023-01-30T20:45', 'Kolkatta', '800', '8564552120', 1),
-- (15, 'Sujay', 'Patil', '5478540000', 'Shivmogga', 'sujay@gmail.com', '1f82ea75c5cc526729e2d581aeb3aeccfef4407e', 'defaultimg.jpg', 'sujay', '', '','T01', 'Basava Express', 'Banglore', '2023-02-03T17:00', 'Manglore', '500', 'CAS09587', 1),
-- (16, 'Rohit', 'Shetty', '3745698850', 'Kundapura', 'rohit@gmail.com', '1f82ea75c5cc526729e2d581aeb3aeccfef4407e', 'defaultimg.jpg', 'rohit', '', '', 'T02', 'Brindavan Express', 'Banglore', '2023-02-02T11:00', 'Chennai', '400', '88700041', 1),
-- (17, 'Nithin', 'BR', '6547778540', 'Durga', 'nithin@gmail.com', '1f82ea75c5cc526729e2d581aeb3aeccfef4407e', 'defaultimg.jpg', 'nithin', '', '', 'T07', 'Bhatkal Express', 'Bhatkal', '2023-01-30T23:45', 'Banglore', '230', '5323377', 1),
-- (18, 'Ankith', 'Jaa', '6478540000', 'Bihaar', 'ankith@gmail.com', '1f82ea75c5cc526729e2d581aeb3aeccfef4407e', 'defaultimg.jpg', 'ankith', '', '', 'T01', 'Basava Express', 'Banglore', '2023-02-03T17:00', 'Manglore', '500', 'CAS04414587', 1),
-- (19, 'Deepak', 'Patil', '7696965450', 'Durga', 'deepak@gmail.com', '1f82ea75c5cc526729e2d581aeb3aeccfef4407e', 'defaultimg.jpg', 'deepak', '', '', 'T03', 'Shatabdi Express', 'Banglore', '2023-01-30T20:45', 'Kolkatta', '800', '986452120', 1),
-- (20, 'Mayur', 'Naik', '4750001458', 'Kumuta', 'mayur@gmail.com', '1f82ea75c5cc526729e2d581aeb3aeccfef4407e', 'defaultimg.jpg', 'mayur', '', '', 'T01', 'Basava Express', 'Banglore', '2023-02-03T17:00', 'Manglore', '500', '10789640', 1);

CREATE TABLE `orrs_passwordresets` (
  `pwd_id` int(20) NOT NULL,
  `email` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

INSERT INTO `orrs_passwordresets` (`pwd_id`, `email`, `status`) VALUES
(1, 'skiddy@gmail.com', 'Approved'),
(2, 'narendra@gmail.com', '');

CREATE TABLE `orrs_train_tickets` (
  `ticket_id` int(20) NOT NULL,
  `pass_name` varchar(200) NOT NULL,
  `pass_email` varchar(200) NOT NULL,
  `pass_addr` varchar(200) NOT NULL,
  `train_no` varchar(200) NOT NULL,
  `train_name` varchar(200) NOT NULL,
  `pass_train_route` varchar(200) NOT NULL,
  `train_dep_date` varchar(200) NOT NULL,
  `train_dep_time` varchar(200) NOT NULL,
  `train_arr_time` varchar(200) NOT NULL,
  `train_fare` varchar(200) NOT NULL,
  `fare_payment_code` varchar(200) NOT NULL,
  `confirmation` varchar(200) NOT NULL,
  `pass_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

INSERT INTO `orrs_train_tickets` (`ticket_id`, `pass_name`, `pass_email`, `pass_addr`, `train_no`, `train_name`,  `pass_train_route`, `train_dep_date`, `train_dep_time`, `train_arr_time`, `train_fare`, `fare_payment_code`, `confirmation`, `pass_id`) VALUES
(5, 'Abhi J', 'abhi@gmail.com', 'Shivmogga', 'T01','Basava Express', 'Banglore - Manglore','2023-01-30', '07:00 AM', '12:00 PM',  '500', 'CAS0014587', '',4),
(6, 'Karthik K', 'karthik@gmail.com', 'Ranebennuru', 'T03', 'Shatabdi Express', 'Banglore - Manglore', '2023-01-30','03:00 AM', '12:00 PM',  '800', '102458700041', 'Approved', 5),
(7, 'Karthik K', 'karthik@gmail.com', 'Ranebennuru','T05', 'Udupi Express', 'Banglore - Manglore', '2023-01-30', '08:00 AM', '02:00 PM',  '250', '102458700041', '', 5),
(8, 'Hemanth Rao', 'hemanth@gmail.com', 'Chikkamagalooru', 'T01', 'Basava Express', 'Banglore - Manglore','2023-01-30', '07:30 AM', '12:00 PM',  '500', '107856452120', 'Approved', 6),
(9, 'Mayur Naik', 'mayur@gmail.com', 'Kumuta', 'T08', 'Banglore Express', 'Banglore - Manglore', '2023-01-30', '07:00 AM', '12:00 PM', '198', '100000789640', 'Approved', 20);

ALTER TABLE `orrs_admin`
  ADD PRIMARY KEY (`admin_id`);

ALTER TABLE `orrs_employee`
  ADD PRIMARY KEY (`emp_id`);

ALTER TABLE `orrs_train_tickets`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `pass_id` (`pass_id`);

ALTER TABLE `orrs_passwordresets`
  ADD PRIMARY KEY (`pwd_id`);

ALTER TABLE `orrs_train`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `orrs_passenger`
  ADD PRIMARY KEY (`pass_id`);

ALTER TABLE `orrs_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `orrs_employee`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `orrs_train`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

ALTER TABLE `orrs_passenger`
  MODIFY `pass_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

ALTER TABLE `orrs_passwordresets`
  MODIFY `pwd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `orrs_train_tickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;