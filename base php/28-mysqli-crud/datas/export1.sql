-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema basecrud
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `basecrud` ;

-- -----------------------------------------------------
-- Schema basecrud
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `basecrud` DEFAULT CHARACTER SET utf8mb4 ;
USE `basecrud` ;

-- -----------------------------------------------------
-- Table `basecrud`.`rubriques`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `basecrud`.`rubriques` ;

CREATE TABLE IF NOT EXISTS `basecrud`.`rubriques` (
  `idrubriques` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `rub_title` VARCHAR(200) NOT NULL,
  `rub_text` VARCHAR(800) NULL,
  PRIMARY KEY (`idrubriques`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `basecrud`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `basecrud`.`users` ;

CREATE TABLE IF NOT EXISTS `basecrud`.`users` (
  `idusers` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_login` VARCHAR(80) NOT NULL,
  `user_pwd` VARCHAR(255) NOT NULL,
  `user_name` VARCHAR(180) NOT NULL,
  PRIMARY KEY (`idusers`),
  UNIQUE INDEX `user_login_UNIQUE` (`user_login` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `basecrud`.`articles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `basecrud`.`articles` ;

CREATE TABLE IF NOT EXISTS `basecrud`.`articles` (
  `idarticles` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `art_title` VARCHAR(200) NOT NULL,
  `art_text` TEXT NOT NULL,
  `art_date` DATETIME NULL DEFAULT NOW(),
  `users_idusers` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idarticles`),
  INDEX `fk_articles_users1_idx` (`users_idusers` ASC),
  CONSTRAINT `fk_articles_users1`
    FOREIGN KEY (`users_idusers`)
    REFERENCES `basecrud`.`users` (`idusers`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `basecrud`.`articles_has_rubriques`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `basecrud`.`articles_has_rubriques` ;

CREATE TABLE IF NOT EXISTS `basecrud`.`articles_has_rubriques` (
  `articles_idarticles` INT UNSIGNED NOT NULL,
  `rubriques_idrubriques` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`articles_idarticles`, `rubriques_idrubriques`),
  INDEX `fk_articles_has_rubriques_rubriques1_idx` (`rubriques_idrubriques` ASC),
  INDEX `fk_articles_has_rubriques_articles_idx` (`articles_idarticles` ASC),
  CONSTRAINT `fk_articles_has_rubriques_articles`
    FOREIGN KEY (`articles_idarticles`)
    REFERENCES `basecrud`.`articles` (`idarticles`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_articles_has_rubriques_rubriques1`
    FOREIGN KEY (`rubriques_idrubriques`)
    REFERENCES `basecrud`.`rubriques` (`idrubriques`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
