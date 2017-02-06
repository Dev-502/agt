
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- videos
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `videos`;

CREATE TABLE `videos`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `eid` VARCHAR(50) NOT NULL,
    `url` VARCHAR(200) NOT NULL,
    `episode` VARCHAR(100) NOT NULL,
    `q360` TEXT NOT NULL,
    `q480` TEXT NOT NULL,
    `q720` TEXT NOT NULL,
    `q1080` TEXT NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
