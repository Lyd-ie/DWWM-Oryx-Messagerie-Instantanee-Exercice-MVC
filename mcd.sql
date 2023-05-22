-- MySQL Script generated by MySQL Workbench
-- Thu May 11 10:01:07 2023
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema messagerie
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema messagerie
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `messagerie` DEFAULT CHARACTER SET utf8 ;
USE `messagerie` ;

-- -----------------------------------------------------
-- Table `messagerie`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `messagerie`.`users` (
  `user_id` INT NOT NULL AUTO_INCREMENT,
  `user_name` VARCHAR(50) NULL,
  `user_password` VARCHAR(150) NULL,
  `user_email` VARCHAR(255) NULL,
  PRIMARY KEY (`user_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `messagerie`.`rooms`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `messagerie`.`rooms` (
  `room_id` INT NOT NULL AUTO_INCREMENT,
  `room_name` VARCHAR(50) NULL,
  PRIMARY KEY (`room_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `messagerie`.`messages`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `messagerie`.`messages` (
  `msg_id` INT NOT NULL AUTO_INCREMENT,
  `msg_text` LONGTEXT NULL,
  `msg_user_id` INT NOT NULL,
  `msg_date` INT NULL,
  `msg_room_id` INT NOT NULL,
  `msg_color` VARCHAR(8) NULL,
  PRIMARY KEY (`msg_id`, `msg_user_id`, `msg_room_id`),
  CONSTRAINT `fk_messages_users`
    FOREIGN KEY (`msg_user_id`)
    REFERENCES `messagerie`.`users` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_messages_rooms1`
    FOREIGN KEY (`msg_room_id`)
    REFERENCES `messagerie`.`rooms` (`room_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_messages_users_idx` ON `messagerie`.`messages` (`msg_user_id` ASC) VISIBLE;

CREATE INDEX `fk_messages_rooms1_idx` ON `messagerie`.`messages` (`msg_room_id` ASC) VISIBLE;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;