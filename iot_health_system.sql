-- Adminer 4.8.1 MySQL 8.0.31 dump


DROP TABLE IF EXISTS `devices`;
CREATE TABLE `devices` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `serial_number` varchar(255) NOT NULL,
  `pairing_id` varchar(255) NOT NULL,
  `last_updated` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);

INSERT INTO `devices` (`id`, `serial_number`, `pairing_id`, `last_updated`) VALUES
(1,	'MLX90614/MAX30102',	'10',	'1672594066');

DROP TABLE IF EXISTS `hb_spo2`;
CREATE TABLE `hb_spo2` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` varchar(255) NOT NULL,
  `hr` varchar(255),
  `spo` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);


DROP TABLE IF EXISTS `heartbeat_sensors`;
CREATE TABLE `heartbeat_sensors` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `sensor_value` varchar(255),
  `spo_value` varchar(255),
  `created_at` varchar(255),
  PRIMARY KEY (`id`)
);


DROP TABLE IF EXISTS `patients`;
CREATE TABLE `patients` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `telegram_id` varchar(255),
  `name` varchar(255) NOT NULL,
  `age` int NOT NULL,
  `ic_no` varchar(255) NOT NULL,
  `hp_no` varchar(255) NOT NULL,
  `address` text,
  `diabetes` varchar(255) NOT NULL,
  `hbpressure` varchar(255) NOT NULL,
  `asthma` varchar(255) NOT NULL,
  `do_operation` varchar(255) NOT NULL,
  `fever` varchar(255),
  `cough` varchar(255),
  `shortness_breath` varchar(255),
  `fatique` varchar(255),
  `body_aches` varchar(255),
  `loss_taste` varchar(255),
  `sore_throats` varchar(255),
  `diarrhea` varchar(255),
  `nausea_vomitting` varchar(255),
  `day_sick` varchar(255),
  `heart_diseases` varchar(255),
  `other_diseases` varchar(255),
  `is_approved` varchar(255),
  `registered_at` varchar(255),
  PRIMARY KEY (`id`)
);


DROP TABLE IF EXISTS `tasks`;
CREATE TABLE `tasks` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `completed_at` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
);


DROP TABLE IF EXISTS `temp_sensors`;
CREATE TABLE `temp_sensors` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `temp_value` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);


DROP TABLE IF EXISTS `temperature`;
CREATE TABLE `temperature` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` varchar(255) NOT NULL,
  `temp` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);


DROP TABLE IF EXISTS `wifi`;
CREATE TABLE `wifi` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `ssid` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);


-- 2023-01-06 16:55:59
