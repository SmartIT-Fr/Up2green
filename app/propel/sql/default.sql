
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- user
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`username` VARCHAR(255),
	`username_canonical` VARCHAR(255),
	`email` VARCHAR(255),
	`email_canonical` VARCHAR(255),
	`enabled` TINYINT(1),
	`salt` VARCHAR(255) NOT NULL,
	`password` VARCHAR(255) NOT NULL,
	`last_login` DATETIME,
	`locked` TINYINT(1),
	`expired` TINYINT(1),
	`expires_at` DATETIME,
	`confirmation_token` VARCHAR(255),
	`password_requested_at` DATETIME,
	`credentials_expired` TINYINT(1),
	`credentials_expire_at` DATETIME,
	`roles` TEXT,
	PRIMARY KEY (`id`),
	UNIQUE INDEX `user_U_1` (`username_canonical`),
	UNIQUE INDEX `user_U_2` (`email_canonical`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- group
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `group`;

CREATE TABLE `group`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255) NOT NULL,
	`roles` TEXT,
	PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- user_group
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `user_group`;

CREATE TABLE `user_group`
(
	`user_id` INTEGER NOT NULL,
	`group_id` INTEGER NOT NULL,
	PRIMARY KEY (`user_id`,`group_id`),
	INDEX `user_group_FI_2` (`group_id`),
	CONSTRAINT `user_group_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`),
	CONSTRAINT `user_group_FK_2`
		FOREIGN KEY (`group_id`)
		REFERENCES `group` (`id`)
) ENGINE=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
