ALTER TABLE `demand` CHANGE `num` `num` CHAR(20) NULL COMMENT '商品数量';
ALTER TABLE `demand` CHANGE `price` `price` CHAR(50) NOT NULL DEFAULT '0.00';
ALTER TABLE `demand` ADD `demandstatus` VARCHAR(100) NULL AFTER `price`, ADD `otherstatus` VARCHAR(100) NULL AFTER `demandstatus`;