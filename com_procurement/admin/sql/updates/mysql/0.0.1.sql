--
-- This file will contain Table structure for `"__helloworld`
--
DROP TABLE IF EXISTS `#__procurement`;

CREATE TABLE `#__procurement` (
	`id`				INT(11)			NOT NULL AUTO_INCREMENT,
    `asset_id`          INT(10)         UNSIGNED NOT NULL DEFAULT '0',
	`bid_number`		VARCHAR(1024) 	NOT NULL DEFAULT '',
	`bid_description`	VARCHAR(1024) 	NOT NULL DEFAULT '',
	`closing_date`		VARCHAR(1024) 	NOT NULL DEFAULT '',
	`brief_date`		VARCHAR(1024) 	NOT NULL DEFAULT '',
	`awarded_to`		VARCHAR(1024) 	NOT NULL DEFAULT '',
	`bid_amount`		VARCHAR(1024) 	NOT NULL DEFAULT '',
	`bbbee_level`		VARCHAR(1024) 	NOT NULL DEFAULT '',
	`total_points`		VARCHAR(1024) 	NOT NULL DEFAULT '',
	`published` 		tinyint(4) 		NOT NULL DEFAULT '1',
    `catid`             int(11)         NOT NULL DEFAULT '0',
    `params`            VARCHAR(1024)   NOT NULL DEFAULT '',
    `image`             VARCHAR(1024)   NOT NULL DEFAULT '',
	PRIMARY KEY (`id`)
)
	ENGINE=InnoDB
	DEFAULT CHARSET=utf8mb4
	DEFAULT COLLATE=utf8mb4_unicode_ci;