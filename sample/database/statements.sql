
CREATE SCHEMA `datamapper` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;


CREATE  TABLE `datamapper`.`user` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `email` VARCHAR(255) NULL ,
  `name` VARCHAR(2555) NULL ,
  PRIMARY KEY (`id`) )
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

INSERT INTO `datamapper`.`user` (`id`, `email`, `name`) VALUES (1, 'drasko.gomboc@gmail.com', 'Draško Gomboc');

