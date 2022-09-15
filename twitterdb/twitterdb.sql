-- MySQL Script generated by MySQL Workbench
-- Wed Sep 14 23:53:14 2022
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

CREATE SCHEMA IF NOT EXISTS `twitterdb` DEFAULT CHARACTER SET utf8 ;
USE `twitterdb` ;

-- -----------------------------------------------------
-- Table `twitterdb`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `twitterdb`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(45) NULL,
  `last_name` VARCHAR(45) NULL,
  `username` VARCHAR(45) NULL,
  `password` VARCHAR(45) NULL,
  `profile_picture_url` VARCHAR(255) NULL,
  `cover_picture_url` VARCHAR(255) NULL,
  `created_at` DATE NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `twitterdb`.`tweets`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `twitterdb`.`tweets` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `text` VARCHAR(280) NULL,
  `created_at` DATE NULL,
  `users_id` INT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `twitterdb`.`tweets_pictues`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `twitterdb`.`tweets_pictues` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `picture_url` VARCHAR(255) NULL,
  `tweets_id` INT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `twitterdb`.`blockers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `twitterdb`.`blockers` (
  `users_id` INT NOT NULL,
  `user_blocking` INT NOT NULL,
  `created_at` DATE NULL,
  PRIMARY KEY (`users_id`, `user_blocking`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `twitterdb`.`followers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `twitterdb`.`followers` (
  `users_id` INT NOT NULL,
  `user_following` INT NOT NULL,
  `created_at` DATE NULL,
  PRIMARY KEY (`users_id`, `user_following`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `twitterdb`.`tweets_likes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `twitterdb`.`tweets_likes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `created_at` DATE NULL,
  `tweets_id` INT NOT NULL,
  `users_id` INT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;