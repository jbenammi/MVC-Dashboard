-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema dashboard
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema dashboard
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `dashboard` DEFAULT CHARACTER SET utf8 ;
USE `dashboard` ;

-- -----------------------------------------------------
-- Table `dashboard`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dashboard`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(45) NULL,
  `last_name` VARCHAR(45) NULL,
  `email` VARCHAR(100) NULL,
  `password` VARCHAR(100) NULL,
  `admin_rights` TINYINT(1) NULL,
  `created_on` DATETIME NULL,
  `updated_on` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dashboard`.`messages`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dashboard`.`messages` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `message` LONGTEXT NULL,
  `created_on` DATETIME NULL,
  `updated_on` DATETIME NULL,
  `users_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_messages_users_idx` (`users_id` ASC),
  CONSTRAINT `fk_messages_users`
    FOREIGN KEY (`users_id`)
    REFERENCES `dashboard`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dashboard`.`comments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dashboard`.`comments` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `comment` VARCHAR(255) NULL,
  `created_on` DATETIME NULL,
  `updated_on` DATETIME NULL,
  `messages_id` INT NOT NULL,
  `users_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_comments_messages1_idx` (`messages_id` ASC),
  INDEX `fk_comments_users1_idx` (`users_id` ASC),
  CONSTRAINT `fk_comments_messages1`
    FOREIGN KEY (`messages_id`)
    REFERENCES `dashboard`.`messages` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comments_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `dashboard`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
