-- ---
-- Globals
-- ---

-- SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
-- SET FOREIGN_KEY_CHECKS=0;

-- ---
-- Table 'books'
--
-- ---

DROP TABLE IF EXISTS `books`;

CREATE TABLE `books` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'authors'
--
-- ---

DROP TABLE IF EXISTS `authors`;

CREATE TABLE `authors` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `author_name` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'copies'
--
-- ---

DROP TABLE IF EXISTS `copies`;

CREATE TABLE `copies` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `book_id` BIGINT NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'checkouts'
--
-- ---

DROP TABLE IF EXISTS `checkouts`;

CREATE TABLE `checkouts` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `copy_of_book_id` BIGINT NOT NULL,
  `patrons_id` BIGINT NOT NULL,
  `due_date` DATE NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'patrons'
--
-- ---

DROP TABLE IF EXISTS `patrons`;

CREATE TABLE `patrons` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `patron_name` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'authors_books'
--
-- ---

DROP TABLE IF EXISTS `authors_books`;

CREATE TABLE `authors_books` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `author_id` BIGINT NULL DEFAULT NULL,
  `book_id` BIGINT NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Foreign Keys
-- ---

ALTER TABLE `copies` ADD FOREIGN KEY (book_id) REFERENCES `books` (`id`);
ALTER TABLE `checkouts` ADD FOREIGN KEY (copy_of_book_id) REFERENCES `copies` (`id`);
ALTER TABLE `checkouts` ADD FOREIGN KEY (patrons_id) REFERENCES `patrons` (`id`);
ALTER TABLE `authors_books` ADD FOREIGN KEY (author_id) REFERENCES `authors` (`id`);
ALTER TABLE `authors_books` ADD FOREIGN KEY (book_id) REFERENCES `books` (`id`);

-- ---
-- Table Properties
-- ---

-- ALTER TABLE `books` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `authors` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `copies` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `checkouts` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `patrons` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `authors_books` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ---
-- Test Data
-- ---

-- INSERT INTO `books` (`id`,`title`) VALUES
-- ('','');
-- INSERT INTO `authors` (`id`,`author_name`) VALUES
-- ('','');
-- INSERT INTO `copies` (`id`,`book_id`) VALUES
-- ('','');
-- INSERT INTO `checkouts` (`id`,`copy_of_book_id`,`patrons_id`,`due_date`) VALUES
-- ('','','','');
-- INSERT INTO `patrons` (`id`,`patron_name`) VALUES
-- ('','');
-- INSERT INTO `authors_books` (`id`,`author_id`,`book_id`) VALUES
-- ('','','');
