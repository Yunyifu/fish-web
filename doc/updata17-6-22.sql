/* 补充用户充值日志表*/
create table if not exists user_charge_log (
	id int unsigned not null auto_increment,	-- log id
	user_id int unsigned not null,	-- 用户id
	user_balance int unsigned not null,
	amount decimal(15,2) not null default 0,	-- 金额
	`status` tinyint unsigned not null default 0,	-- 支付状态
	pay_type tinyint unsigned not null,	-- 支付类型
	pay_platform tinyint unsigned not null,	-- 支付发起平台
	pay_trade_no varchar(100),	-- 第三方流水号
	remark varchar(500),	-- 备注
	remark_imgs varchar(1000),
	created_at int unsigned,	-- 创建时间
	updated_at int unsigned,	-- 最后修改时间
	primary key(id),
	foreign key(user_id) references user(id) on delete cascade on update cascade
)engine=InnoDB default charset=utf8;

/*
用户充值表
 */
create table if not exists user_charge(
  id int unsigned not null auto_increment,
  user_id int unsigned not null,
  amount int unsigned not null,
)