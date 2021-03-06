ALTER TABLE `user` ADD `dealer` INT(10) UNSIGNED NOT NULL AFTER `factory`, ADD INDEX (`dealer`);
ALTER TABLE `user` ADD FOREIGN KEY (`dealer`) REFERENCES `admin_user`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `admin_user` ADD `phone` CHAR(20) NULL DEFAULT NULL COMMENT '交易员电话' AFTER `group`;