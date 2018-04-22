CREATE TABLE `categories` (
  `categoryid` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  PRIMARY KEY (`categoryid`));

INSERT INTO `categories` (`name`) VALUES ('Desert Mantis');
INSERT INTO `categories` (`name`) VALUES ('Temperate Mantis');
INSERT INTO `categories` (`name`) VALUES ('Tropical Mantis');
INSERT INTO `categories` (`name`) VALUES ('Subtropical Mantis');
INSERT INTO `categories` (`name`) VALUES ('Equatorial Mantis');

CREATE TABLE `insect_categories` (
  `insectid` VARCHAR(45) NOT NULL,
  `categoryid` INT NULL
);

