-- ---
-- Globals
-- ---
use baby_schedule;

-- SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET FOREIGN_KEY_CHECKS=0;

-- ---
-- Table 'baby'
-- 
-- ---

DROP TABLE IF EXISTS `baby`;
		
CREATE TABLE `baby` (
  `bid` TINYINT NULL AUTO_INCREMENT DEFAULT NULL,
  `name` VARCHAR(16) NULL DEFAULT NULL,
  PRIMARY KEY (`bid`),
  UNIQUE KEY (`name`)
);

-- ---
-- Table 'event'
-- 
-- ---

DROP TABLE IF EXISTS `event`;
		
CREATE TABLE `event` (
  `eid` INTEGER NULL AUTO_INCREMENT DEFAULT NULL,
  `bid` TINYINT NULL DEFAULT NULL,
  `tid` TINYINT NULL DEFAULT NULL,
  `start` DATETIME NOT NULL,
  `qnty` FLOAT NULL DEFAULT NULL,
  `qlty` TINYINT NULL DEFAULT NULL,
  `lid` TINYINT NULL DEFAULT NULL,
  PRIMARY KEY (`eid`),
  UNIQUE KEY (`bid`,`tid`,`start`)
);

-- ---
-- Table 'type'
-- 
-- ---

DROP TABLE IF EXISTS `type`;
		
CREATE TABLE `type` (
  `tid` TINYINT NULL AUTO_INCREMENT DEFAULT NULL,
  `type` VARCHAR(16) NULL DEFAULT NULL,
  PRIMARY KEY (`tid`),
  UNIQUE KEY (`type`)
);

-- ---
-- Table 'type'
-- 
-- ---

DROP TABLE IF EXISTS `location`;
		
CREATE TABLE `location` (
  `lid` TINYINT NULL AUTO_INCREMENT DEFAULT NULL,
  `location` VARCHAR(16) NULL DEFAULT NULL,
  PRIMARY KEY (`lid`),
  UNIQUE KEY (`location`)
);

-- ---
-- Foreign Keys 
-- ---

ALTER TABLE `event` ADD FOREIGN KEY (bid) REFERENCES `baby` (`bid`);
ALTER TABLE `event` ADD FOREIGN KEY (tid) REFERENCES `type` (`tid`);
ALTER TABLE `event` ADD FOREIGN KEY (lid) REFERENCES `location` (`lid`);

-- ---
-- Table Properties
-- ---

-- ALTER TABLE `baby` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `event` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `type` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ---
-- Test Data
-- ---

-- INSERT INTO `baby` (`bid`,`name`) VALUES
-- ('','');
INSERT INTO `baby` (`name`) VALUES
('Sophia'),('Charlotte');
-- INSERT INTO `baby` (`bid`,`name`) VALUES
-- ('','');
-- INSERT INTO `event` (`eid`,`bid`,`tid`,`start`,`end`,`quality`) VALUES
-- ('','','','','','');
-- INSERT INTO `type` (`tid`,`type`) VALUES
-- ('','');
INSERT INTO `type` (`type`) VALUES
('feed'),('sleep'),('awake'),('poop');

INSERT INTO `location` (`location`) VALUES
('Crib'),('RockNPlay'),('Bjorn'),('Swing'),('Held');
