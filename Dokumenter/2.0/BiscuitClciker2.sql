-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema biscuitclicker2
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema biscuitclicker2
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `biscuitclicker2` DEFAULT CHARACTER SET utf8 ;
USE `biscuitclicker2` ;

-- -----------------------------------------------------
-- Table `biscuitclicker2`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biscuitclicker2`.`user` (
  `id_user` INT NOT NULL AUTO_INCREMENT,
  `DisplayName` VARCHAR(255) NOT NULL DEFAULT 'ClickerEnthuisat',
  `username` VARCHAR(255) NOT NULL,
  `pwd` LONGTEXT NOT NULL,
  `date` DATE NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `clearance` INT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_user`),
  UNIQUE INDEX `DisplayName_UNIQUE` (`DisplayName` ASC),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biscuitclicker2`.`biscuit_progress`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biscuitclicker2`.`biscuit_progress` (
  `id_progress` INT NOT NULL AUTO_INCREMENT,
  `id_foregin_user` INT NOT NULL,
  `biscuit_count` BIGINT NOT NULL DEFAULT 0,
  `prestige_count` BIGINT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_progress`),
  INDEX `fk_biscuit_progress_user_idx` (`id_foregin_user` ASC),
  CONSTRAINT `fk_biscuit_progress_user`
    FOREIGN KEY (`id_foregin_user`)
    REFERENCES `biscuitclicker2`.`user` (`id_user`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biscuitclicker2`.`upgrades`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biscuitclicker2`.`upgrades` (
  `id_upgrades` INT NOT NULL AUTO_INCREMENT,
  `upgrade_navn` VARCHAR(255) NOT NULL,
  `upgrade_headline` VARCHAR(255) NOT NULL,
  `upgrade_unlocked` TINYINT NOT NULL DEFAULT 0,
  `upgrade_value` BIGINT NOT NULL,
  `upgrade_cost` BIGINT NOT NULL,
  `upgrade_des` LONGTEXT NOT NULL,
  PRIMARY KEY (`id_upgrades`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biscuitclicker2`.`user_has_upgrades`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biscuitclicker2`.`user_has_upgrades` (
  `user_has_upgrade_id` INT NOT NULL,
  `upgrade_in_question_id` INT NOT NULL,
  `upgrade_antall` BIGINT NOT NULL,
  PRIMARY KEY (`user_has_upgrade_id`, `upgrade_in_question_id`),
  INDEX `fk_user_has_upgrades_upgrades1_idx` (`upgrade_in_question_id` ASC),
  INDEX `fk_user_has_upgrades_user1_idx` (`user_has_upgrade_id` ASC),
  CONSTRAINT `fk_user_has_upgrades_user1`
    FOREIGN KEY (`user_has_upgrade_id`)
    REFERENCES `biscuitclicker2`.`user` (`id_user`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_has_upgrades_upgrades1`
    FOREIGN KEY (`upgrade_in_question_id`)
    REFERENCES `biscuitclicker2`.`upgrades` (`id_upgrades`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biscuitclicker2`.`items`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biscuitclicker2`.`items` (
  `id_items` INT NOT NULL AUTO_INCREMENT,
  `item_navn` VARCHAR(255) NOT NULL,
  `item_increase` INT NOT NULL,
  `item_rarity` VARCHAR(45) NOT NULL,
  `item_beskrivelse` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id_items`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `biscuitclicker2`.`user_has_items`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `biscuitclicker2`.`user_has_items` (
  `user_has_item_id` INT NOT NULL,
  `item_in_question_id` INT NOT NULL,
  `items_obtained` TINYINT NOT NULL DEFAULT 0,
  PRIMARY KEY (`user_has_item_id`, `item_in_question_id`),
  INDEX `fk_user_has_items_items1_idx` (`item_in_question_id` ASC),
  INDEX `fk_user_has_items_user1_idx` (`user_has_item_id` ASC),
  CONSTRAINT `fk_user_has_items_user1`
    FOREIGN KEY (`user_has_item_id`)
    REFERENCES `biscuitclicker2`.`user` (`id_user`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_has_items_items1`
    FOREIGN KEY (`item_in_question_id`)
    REFERENCES `biscuitclicker2`.`items` (`id_items`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;



-- --------------------------------------------------------
-- Triggers
-- --------------------------------------------------------
DELIMITER //

CREATE TRIGGER trigger_upgrades_new_update
AFTER INSERT ON `biscuitclicker2`.`upgrades`
FOR EACH ROW
BEGIN
    -- Trigger body with multiple SQL statements
    INSERT INTO `biscuitclicker2`.`user_has_upgrades` (`user_has_upgrade_id`, `upgrade_in_question_id`, `upgrade_antall`)
    SELECT id_user, NEW.id_upgrades, 0 FROM `biscuitclicker20`.`user`;
END//

CREATE TRIGGER trigger_upgrades_new_user
AFTER INSERT ON `biscuitclicker2`.`user`
FOR EACH ROW
BEGIN
    -- Trigger body with multiple SQL statements
    INSERT INTO `biscuitclicker2`.`user_has_upgrades` (`user_has_upgrade_id`, `upgrade_in_question_id`, `upgrade_antall`)
    SELECT NEW.id_user, id_upgrades, 0 FROM `biscuitclicker2`.`upgrades`;
END//

CREATE TRIGGER trigger_items_new_item
AFTER INSERT ON `biscuitclicker2`.`items`
FOR EACH ROW
BEGIN
    -- Trigger body with multiple SQL statements
    INSERT INTO `biscuitclicker2`.`user_has_items` (`user_has_item_id`, `item_in_question_id`, `items_obtained`)
    SELECT id_user, NEW.id_items, 0 FROM `biscuitclicker2`.`user`;
END//

CREATE TRIGGER trigger_items_new_user
AFTER INSERT ON `biscuitclicker2`.`user`
FOR EACH ROW
BEGIN
    -- Trigger body with multiple SQL statements
    INSERT INTO `biscuitclicker2`.`user_has_items` (`user_has_item_id`, `item_in_question_id`, `items_obtained`)
    SELECT NEW.id_user, id_items, 0 FROM `biscuitclicker2`.`items`;
END//
DELIMITER ;
-- --------------------------------------------------------
-- Data
-- --------------------------------------------------------
INSERT INTO upgrades (upgrade_navn, upgrade_headline, upgrade_unlocked, upgrade_value, upgrade_cost, upgrade_des) VALUES ('Better sleep', 'Get better sleep', 0, 0.5, 50, "Sleeping more makes you make more. <br><span class='bold-text'> Gain 0.5 Cookie pr second</span>");
INSERT INTO upgrades (upgrade_navn, upgrade_headline, upgrade_unlocked, upgrade_value, upgrade_cost, upgrade_des) VALUES ('Dinner every day', 'Eat more', 0, 2, 200, "With the biscuits your making, you can finally but some good food. <br><span class='bold-text'> Gain 2 Cookie pr second</span>");
INSERT INTO upgrades (upgrade_navn, upgrade_headline, upgrade_unlocked, upgrade_value, upgrade_cost, upgrade_des) VALUES ('Education', 'Actually learn lol', 0, 20, 1000, "Go back to elementary school and learn the basics. <br><span class='bold-text'> Gain 20 Cookie pr second</span>");
INSERT INTO upgrades (upgrade_navn, upgrade_headline, upgrade_unlocked, upgrade_value, upgrade_cost, upgrade_des) VALUES ('Extra lessons', 'Extra lessons', 0, 50, 2000, "You lack behind, but with hard work you slowly make way. <br><span class='bold-text'> Gain 50 Cookie pr second</span>");
INSERT INTO upgrades (upgrade_navn, upgrade_headline, upgrade_unlocked, upgrade_value, upgrade_cost, upgrade_des) VALUES ('Collage', 'Big step', 0, 200, 5000, "You go to Collage, your friends respect your leave and run the store <br><span class='bold-text'> Gain 200 Cookie pr second</span>");
INSERT INTO upgrades (upgrade_navn, upgrade_headline, upgrade_unlocked, upgrade_value, upgrade_cost, upgrade_des) VALUES ('Working Graduate', 'Smart boi', 0, 2000, 10000, "You come back with more knowlegde than ever before <br><span class='bold-text'> Gain 2000 Cookie pr second</span>");
INSERT INTO upgrades (upgrade_navn, upgrade_headline, upgrade_unlocked, upgrade_value, upgrade_cost, upgrade_des) VALUES ('Political effects', 'Joe Biden', 0, 9, 10, "The new political polich changes bisnis as a whole <br><span class='bold-text'> Gain 9 Cookie pr second</span>");
INSERT INTO upgrades (upgrade_navn, upgrade_headline, upgrade_unlocked, upgrade_value, upgrade_cost, upgrade_des) VALUES ('Chance to expand', 'I will take it!', 0, 10000, 5000000, "You buy local emptu spaces to expand <br><span class='bold-text'> Gain 9 Cookie pr second</span>");
INSERT INTO upgrades (upgrade_navn, upgrade_headline, upgrade_unlocked, upgrade_value, upgrade_cost, upgrade_des) VALUES ('Cooperation', 'Stonks', 0, 200000, 100000000, "You make deals with other bisnisess, and become one big cooperation <br><span class='bold-text'> Gain 9 Cookie pr second</span>");
INSERT INTO upgrades (upgrade_navn, upgrade_headline, upgrade_unlocked, upgrade_value, upgrade_cost, upgrade_des) VALUES ('Mr. Biscuit WorldWide', 'Become Apple', 0, 200000, 100000000, "This is the name of your offical popular World wide cookies<br><span class='bold-text'> Gain 9 Cookie pr second</span>");


INSERT INTO items (item_navn, item_increase, item_rarity, item_beskrivelse) VALUES ('Disbled Kid', 0, 'Trash', 'Poor guy');
INSERT INTO items (item_navn, item_increase, item_rarity, item_beskrivelse) VALUES ('Sakura (Fra Naurto)', 0, 'Trash', 'Annoying Customer');
INSERT INTO items (item_navn, item_increase, item_rarity, item_beskrivelse) VALUES ('Santa Claus', 0, 'Trash', 'Sadly, did not come to give gifts.');
  INSERT INTO items (item_navn, item_increase, item_rarity, item_beskrivelse) VALUES ('Black hole', 25, 'Rare', 'You learned how to refine energy and able to extract the energy of a black hole.');
  INSERT INTO items (item_navn, item_increase, item_rarity, item_beskrivelse) VALUES ('Skibidi Toilet', 25, 'Rare', 'Premium Toilet.');
  INSERT INTO items (item_navn, item_increase, item_rarity, item_beskrivelse) VALUES ('Whip from the good old times.', 25, 'Rare', 'The best motivator for any type of workplace.');
  INSERT INTO items (item_navn, item_increase, item_rarity, item_beskrivelse) VALUES ('Chainsaw man', 25, 'Rare', 'Honest worker, but dumb.');
  INSERT INTO items (item_navn, item_increase, item_rarity, item_beskrivelse) VALUES ('W Rizz.', 25, 'Rare', 'W Rizz.');
  INSERT INTO items (item_navn, item_increase, item_rarity, item_beskrivelse) VALUES ('Mommy', 25 , 'Rare', 'How the hell is my mom in the game?');
    INSERT INTO items (item_navn, item_increase, item_rarity, item_beskrivelse) VALUES ('H Magnus H', 250, 'Epic', 'Add him on Epic Games.');
    INSERT INTO items (item_navn, item_increase, item_rarity, item_beskrivelse) VALUES ("Dad's Milk", 250, 'Epic', 'Your dad came home with premium milk.');
    INSERT INTO items (item_navn, item_increase, item_rarity, item_beskrivelse) VALUES ('Water bending', 250, 'Epic', 'Avatar reference.');
      INSERT INTO items (item_navn, item_increase, item_rarity, item_beskrivelse) VALUES ('Nihodi ', 5000, 'Legendary', 'Good job. You won.');
      INSERT INTO items (item_navn, item_increase, item_rarity, item_beskrivelse) VALUES ('Life.', 2000, 'Legendary', 'You finally go outside.');


INSERT INTO user (DisplayName, username, pwd, clearance) VALUES ('BiscuitAdmin', 'admin', 'admin123', 1);
INSERT INTO user (DisplayName, username, pwd) VALUES ('Clicker', 'bruker', 'bruker123');


-- --------------------------------------------------------
-- Users
-- --------------------------------------------------------

CREATE USER 'adminClicker'@'localhost' IDENTIFIED BY 'admin123';
GRANT ALL PRIVILEGES ON *.* TO 'adminClicker'@'localhost' IDENTIFIED BY 'admin123';

CREATE USER 'userClicker'@'localhost' IDENTIFIED BY 'user123';
GRANT SELECT, INSERT ON biscuitclicker2.* TO 'userClicker'@'localhost' IDENTIFIED BY 'user123';


