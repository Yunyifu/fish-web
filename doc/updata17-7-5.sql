ALTER TABLE `goods` ADD `dealer_id` INT(10) NULL DEFAULT NULL COMMENT '交易员id' AFTER `rank`;
ALTER TABLE `demand` ADD `dealer_id` INT(10) NULL DEFAULT NULL COMMENT '交易员id' AFTER `updated_at`;