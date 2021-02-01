код базы Users
CREATE TABLE `users` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`Username` VARCHAR(50) NOT NULL DEFAULT '' COLLATE 'utf8_general_ci',
	`email` VARCHAR(35) NOT NULL COLLATE 'utf8_general_ci',
	`password` VARCHAR(35) NOT NULL COLLATE 'utf8_general_ci',
	`date` DATETIME NOT NULL,
	PRIMARY KEY (`id`) USING BTREE,
	UNIQUE INDEX `email` (`email`) USING BTREE
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
;


код базы messages
CREATE TABLE `messages` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`id_user` INT(11) NOT NULL,
	`name` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	`text` TEXT(65535) NOT NULL COLLATE 'utf8_general_ci',
	`datetime` DATETIME NOT NULL,
	`image` VARCHAR(255) NOT NULL DEFAULT 'netu' COLLATE 'utf8_general_ci',
	PRIMARY KEY (`id`) USING BTREE
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB