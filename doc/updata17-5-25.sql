ALTER TABLE `demand` CHANGE `num` `num` VARCHAR(10) NULL DEFAULT NULL COMMENT '商品数量';
ALTER TABLE `demand` ADD `demandstatus` VARCHAR(50) NULL DEFAULT NULL AFTER `price`;
ALTER TABLE `demand` ADD `otherstatus` VARCHAR(1000) NOT NULL AFTER `demandstatus`;
ALTER TABLE `demand` CHANGE `otherstatus` `otherstatus` VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;