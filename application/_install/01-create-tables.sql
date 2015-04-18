SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `present_frame` ;
CREATE SCHEMA IF NOT EXISTS `present_frame` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `present_frame` ;

-- -----------------------------------------------------
-- Table `present_frame`.`languages`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `present_frame`.`languages` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `short` VARCHAR(2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `present_frame`.`pages`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `present_frame`.`pages` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(24) NOT NULL,
  `content` TEXT NOT NULL,
  `first` TINYINT(1) NULL DEFAULT false,
  `languages_id` INT NOT NULL,
  `pages_id` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_pages_languages1_idx` (`languages_id` ASC),
  INDEX `fk_pages_pages1_idx` (`pages_id` ASC),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC),
  CONSTRAINT `fk_pages_languages1`
    FOREIGN KEY (`languages_id`)
    REFERENCES `present_frame`.`languages` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pages_pages1`
    FOREIGN KEY (`pages_id`)
    REFERENCES `present_frame`.`pages` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `present_frame`.`categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `present_frame`.`categories` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `sys_name` VARCHAR(45) NOT NULL,
  `priority` INT NOT NULL DEFAULT 0,
  `parent_id` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_categories_categories2_idx` (`parent_id` ASC),
  UNIQUE INDEX `sys_name_UNIQUE` (`sys_name` ASC),
  CONSTRAINT `fk_categories_categories2`
    FOREIGN KEY (`parent_id`)
    REFERENCES `present_frame`.`categories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `present_frame`.`presentations`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `present_frame`.`presentations` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `desc` VARCHAR(500) NULL,
  `order` INT NOT NULL,
  `languages_id` INT NOT NULL,
  `categories_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_presentations_languages1_idx` (`languages_id` ASC),
  INDEX `fk_presentations_categories1_idx` (`categories_id` ASC),
  CONSTRAINT `fk_presentations_languages1`
    FOREIGN KEY (`languages_id`)
    REFERENCES `present_frame`.`languages` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_presentations_categories1`
    FOREIGN KEY (`categories_id`)
    REFERENCES `present_frame`.`categories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `present_frame`.`slides`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `present_frame`.`slides` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `order` INT NOT NULL,
  `content` TEXT NOT NULL,
  `presentations_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_slides_presentations1_idx` (`presentations_id` ASC),
  CONSTRAINT `fk_slides_presentations1`
    FOREIGN KEY (`presentations_id`)
    REFERENCES `present_frame`.`presentations` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `present_frame`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `present_frame`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(32) NOT NULL,
  `email` VARCHAR(50) NOT NULL,
  `pass_hash` VARCHAR(255) NOT NULL,
  `create_time` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `admin` TINYINT(1) NULL DEFAULT false,
  `disabled` TINYINT(1) NULL DEFAULT false,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC),
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `present_frame`.`comments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `present_frame`.`comments` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `comment` VARCHAR(300) NOT NULL,
  `posted` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `users_id` INT NOT NULL,
  `presentations_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_comments_users1_idx` (`users_id` ASC),
  INDEX `fk_comments_presentations1_idx` (`presentations_id` ASC),
  CONSTRAINT `fk_comments_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `present_frame`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comments_presentations1`
    FOREIGN KEY (`presentations_id`)
    REFERENCES `present_frame`.`presentations` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `present_frame`.`translations`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `present_frame`.`translations` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `translation` VARCHAR(100) NOT NULL,
  `languages_id` INT NOT NULL,
  `translations_id` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_ui_translations_languages1_idx` (`languages_id` ASC),
  INDEX `fk_ui_translations_ui_translations1_idx` (`translations_id` ASC),
  CONSTRAINT `fk_ui_translations_languages1`
    FOREIGN KEY (`languages_id`)
    REFERENCES `present_frame`.`languages` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ui_translations_ui_translations1`
    FOREIGN KEY (`translations_id`)
    REFERENCES `present_frame`.`translations` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `present_frame`.`category_translation`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `present_frame`.`category_translation` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `languages_id` INT NOT NULL,
  `categories_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_category_translation_languages1_idx` (`languages_id` ASC),
  INDEX `fk_category_translation_categories1_idx` (`categories_id` ASC),
  CONSTRAINT `fk_category_translation_languages1`
    FOREIGN KEY (`languages_id`)
    REFERENCES `present_frame`.`languages` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_category_translation_categories1`
    FOREIGN KEY (`categories_id`)
    REFERENCES `present_frame`.`categories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
