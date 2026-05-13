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









COMMIT;
