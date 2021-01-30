CREATE TABLE `messages` (
                            `id` INT(11) NOT NULL AUTO_INCREMENT,
                            `id_user` INT(11) NOT NULL,
                            `text` text NOT NULL COLLATE 'utf8_general_ci',
                            `datetime` VARCHAR(255) NOT NULL COLLATE 'utf8_general_ci',
                            PRIMARY KEY (`id`) USING BTREE
)
    COLLATE='utf8_general_ci'
ENGINE=InnoDB;

CREATE TABLE `users` (
                         `id` INT(11) NOT NULL AUTO_INCREMENT,
                         `Username` INT(11) NOT NULL,
                         `email` VARCHAR(35) NOT NULL COLLATE 'utf8_general_ci',
                         `password` VARCHAR(35) NOT NULL COLLATE 'utf8_general_ci',
                         `datetime` VARCHAR(255) NOT NULL COLLATE 'utf8_general_ci',
                         PRIMARY KEY (`id`) USING BTREE
)
    COLLATE='utf8_general_ci'
ENGINE=InnoDB
;

