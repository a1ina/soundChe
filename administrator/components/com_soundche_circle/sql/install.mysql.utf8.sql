CREATE TABLE IF NOT EXISTS `#__soundche_circle_` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`asset_id` INT(10) UNSIGNED NOT NULL DEFAULT '0',

`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
`created_by` INT(11)  NOT NULL ,
`title` VARCHAR(50)  NOT NULL ,
`genre` VARCHAR(50)  NOT NULL ,
`body` TEXT NOT NULL ,
`img_artist` VARCHAR(255)  NOT NULL ,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT COLLATE=utf8_general_ci;

