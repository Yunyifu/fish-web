ALTER TABLE `companyauth` ADD `saler` CHAR(20) NULL DEFAULT NULL COMMENT '业务员姓名' AFTER `status`;
ALTER TABLE `auth` ADD `saler` CHAR(20) NULL DEFAULT NULL COMMENT '业务员姓名' AFTER `status`;