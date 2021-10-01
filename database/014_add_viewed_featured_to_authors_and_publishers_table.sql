ALTER TABLE `authors`
    ADD COLUMN `featured` TINYINT(1) NOT NULL DEFAULT '0' AFTER `status`,
    ADD COLUMN `viewed` INT(10) UNSIGNED NOT NULL DEFAULT '0' AFTER `url`;

ALTER TABLE `publishers`
    ADD COLUMN `featured` TINYINT(1) NOT NULL DEFAULT '0' AFTER `status`,
    ADD COLUMN `viewed` INT(10) UNSIGNED NOT NULL DEFAULT '0' AFTER `url`;