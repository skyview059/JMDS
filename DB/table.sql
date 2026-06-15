SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS `donations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `donor_id` int NOT NULL,
  `head_id` int NOT NULL,
  `donate_type` enum('General','Personal') NOT NULL DEFAULT 'General',
  `month` date NOT NULL,
  `remark` varchar(250) DEFAULT NULL,
  `paid` int NOT NULL,
  `paid_date` date NOT NULL,
  `collected_by` int NOT NULL,
  `timestamp` timestamp NULL DEFAULT NULL,
  `status` enum('OK','Void') NOT NULL DEFAULT 'OK',
  PRIMARY KEY (`id`),
  KEY `subscriber_id` (`donor_id`),
  KEY `month` (`month`)
) ENGINE=InnoDB;


CREATE TABLE IF NOT EXISTS `donors` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ref_id` int NOT NULL,
  `area_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `amount` int NOT NULL,
  `contact` varchar(80) NOT NULL,
  `add_line1` varchar(255) NOT NULL,
  `add_line2` varchar(255) NOT NULL,
  `reg_date` date NOT NULL,
  `remark` varchar(1000) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=InnoDB;



CREATE TABLE IF NOT EXISTS `donation_heads` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;


CREATE TABLE IF NOT EXISTS `batches` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `date_start` datetime DEFAULT NULL,
  `date_end` datetime DEFAULT NULL,
  `status` enum('Running','Close','Upcoming') NOT NULL DEFAULT 'Upcoming',
  `remarks` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB





CREATE TABLE IF NOT EXISTS `vehicles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `photo` varchar(255) DEFAULT NULL,
  `number` varchar(10) DEFAULT NULL,
  `purchased_date` date DEFAULT NULL,
  `amount` int DEFAULT NULL,
  `remark` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;



COMMIT;

ALTER TABLE `drivings` CHANGE `drive_type` `drive_type` ENUM('F','R','Z') NOT NULL DEFAULT 'F' COMMENT 'F=Forward,R=Reverse Z=Jikjak';

ALTER TABLE `drivings` ADD `drive_mode` ENUM('D','AN','N') NOT NULL DEFAULT 'D' COMMENT 'D=Day, AN=Afternoon, N=Night' AFTER `drive_type`;

ALTER TABLE `drivings` ADD `road_type` ENUM('TF','DT','HW') NOT NULL DEFAULT 'DT' COMMENT 'TF=Training Field, DT=Driving Track, HW=Highway' AFTER `round_qty`;

ALTER TABLE `drivings` ADD `instructor_id` INT NULL DEFAULT NULL AFTER `road_type`;

ALTER TABLE `transactions` ADD `source_id` INT NULL DEFAULT NULL AFTER `amount`;









CREATE TABLE designations ( id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(100) NOT NULL UNIQUE );
ALTER TABLE `users` ADD `designation_id` INT NULL AFTER `role_id`;
ALTER TABLE `users` DROP `first_name`;
ALTER TABLE `users` DROP `last_name`;

ALTER TABLE `learners` CHANGE `nid` `nid` VARCHAR(20) NULL DEFAULT NULL;

--- permission  key: learner/document

DROP TABLE `db_sync`;
DROP TABLE `donation_heads`;
DROP TABLE `donors`;
DROP TABLE `donations`;
DROP TABLE `expenses`;
DROP TABLE `expense_heads`;
DROP TABLE `service_areas`;


CREATE TABLE designations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE, 
    short_name VARCHAR(20) NOT NULL             
);
INSERT INTO designations (name, short_name) VALUES 
('General', 'Gen'),
('Lieutenant General', 'Lt Gen'),
('Major General', 'Maj Gen'),
('Brigadier General', 'Brig Gen'),
('Colonel', 'Col'),
('Lieutenant Colonel', 'Lt Col'),
('Major', 'Maj'),
('Captain', 'Capt'),
('Lieutenant', 'Lt'),
('Second Lieutenant', '2nd Lt'),
('Master Warrant Officer', 'MWO'),
('Senior Warrant Officer', 'SWO'),
('Warrant Officer', 'WO'),
('Sergeant', 'Sgt'),
('Corporal', 'Cpl'),
('Lance Corporal', 'L Cpl'),
('Sainik', 'Snk');
 


ALTER TABLE `learners` ADD `gender` ENUM('Male','Female','Ignored') NULL DEFAULT NULL AFTER `name`;

ALTER TABLE `learners` DROP `district_id`;


CREATE TABLE `learner_addresses` (
  `id` bigint NOT NULL,
  `learner_id` bigint UNSIGNED NOT NULL,
  `cu_village` varchar(255) DEFAULT NULL,
  `cu_postoffice` varchar(100) DEFAULT NULL,
  `cu_postcode` varchar(10) DEFAULT NULL,
  `cu_ps` varchar(100) DEFAULT NULL,
  `cu_dist_id` bigint DEFAULT NULL,
  `pa_village` varchar(255) DEFAULT NULL,
  `pa_postoffice` varchar(100) DEFAULT NULL,
  `pa_postcode` varchar(10) DEFAULT NULL,
  `pa_ps` varchar(100) DEFAULT NULL,
  `pa_dist_id` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;








