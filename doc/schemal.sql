/**************
 * 用户相关
 *************/
/*用户表*/
create table if not exists user (
	id int unsigned not null auto_increment,	-- 用户id
	username varchar(50) not null,		-- 登录名
	password_hash varchar(100) not null, -- 登录密码
	nickname varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci not null,	-- 用户昵称，可能有一些表情符啥的
	password_reset_token varchar(100), -- 重置密码
	auth_key varchar(100) not null,	-- cookie auth
	status tinyint unsigned not null default 10,	-- 激活状态
	avatar varchar(1000),	-- 用户头像
	gender int unsigned not null default 0,  -- 性别
	block_until int unsigned,	-- 封禁截止日期
	referee_id int unsigned,	-- 推荐人id
	birthday int,  -- 生日
	created_at int unsigned,	-- 创建时间
	updated_at int unsigned,	-- 最后修改时间
	primary key(id),
	foreign key(referee_id) references user(id) on delete SET NULL on update cascade
)engine=InnoDB default charset=utf8mb4;



/*第三方登录授权表*/
create table if not exists user_oauth (
	id int unsigned not null auto_increment,	-- oauthid
	type tinyint unsigned not null,	-- oauth类型
	user_id int unsigned not null,	-- user id
	external_uid varchar(100) not null,	-- 外部uid
	external_name varchar(50) not null, -- 外部用户名
	token varchar(500) not null default '',			-- 外部token
	refresh_token varchar(500) default '', 	-- 刷新token
	other varchar(500) default '', 	-- 其他信息（主要用于unionid公众号还是app）
	primary key(id),
	foreign key(user_id) references user(id) on delete cascade on update cascade,
	unique key `external` (`type`,`external_uid`) 
)engine=InnoDB default charset=utf8mb4;

/*用户设备表*/
create table if not exists user_device (
	id int unsigned not null auto_increment,  -- deviceid
	user_id int unsigned not null, -- user id
	device varchar(100) not null,	-- device标示
	access_token varchar(100) not null, -- token
	push_cid varchar(100) not null default '', -- push client id
	loggedout boolean not null default 0,	-- 是否已退出
	last_active int unsigned,	-- 最后活动时间
	primary key(id),
	foreign key(user_id) references user(id) on delete cascade on update cascade
)engine=InnoDB default charset=utf8mb4;

/**************
 * 管理后台
 *************/
/*管理员表*/
create table if not exists admin_user (
	id int unsigned not null auto_increment,	-- 用户id
	username varchar(50) not null,		-- 登录名
	password_hash varchar(100) not null, -- 登录密码
	nickname varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci not null,	-- 用户昵称，可能有一些表情符啥的
	password_reset_token varchar(100), -- 重置密码
	auth_key varchar(100) not null,	-- cookie auth
	status tinyint unsigned not null default 10,	-- 激活状态
	`group` tinyint unsigned default 0,	-- 管理员分组
	created_at int unsigned,	-- 创建时间
	updated_at int unsigned,	-- 最后修改时间
	primary key(id),
	unique (username)
)engine=InnoDB default charset=utf8mb4;

/*商品分类表*/
create table if not exists category (
	id int(11) unsigned not null auto_increment,	-- 分类id
	`name` varchar(100) not null,	-- 分类名称
	status tinyint unsigned not null default 1 COMMENT '显示状态',	-- 显示状态
	parent_id int(10) unsigned,	-- 上级分类名称
	created_at int unsigned,	-- 创建时间
	updated_at int unsigned,	-- 最后修改时间
	primary key(id),
	FOREIGN KEY (parent_id) REFERENCES category(id) on delete cascade on update cascade
)engine=InnoDB default charset=utf8mb4;

/*商品信息表*/
CREATE TABLE IF NOT EXISTS `goods`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT, -- 商品ID
    `title` varchar(100) NOT NULL DEFAULT '' COMMENT '信息标题',
    `thumb` varchar(1000) not null COMMENT '缩略图',
    `user_id` int unsigned not null, -- user id
    `category_id` INT UNSIGNED NOT NULL DEFAULT '0', -- 分类ID
    `num` INT UNSIGNED NOT NULL DEFAULT '0' COMMENT '商品数量', -- 商品数量
    `price` DECIMAL(10,2) NOT NULL DEFAULT '0.00', -- 商品价格
    `area` VARCHAR (50) NOT NULL DEFAULT '' COMMENT '产地', -- 产地
    `position` VARCHAR (200) NOT NULL DEFAULT '' COMMENT '货物所在地点',
    `status` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT'现货',
    `desc` TEXT, -- 描述详情
    `pic` varchar(1000) not null, -- 图片展示
    created_at int unsigned,	-- 创建时间
	  updated_at int unsigned,	-- 最后修改时间
	  primary key(id),
    FOREIGN KEY category_id(`category_id`) REFERENCES category(id) on delete cascade on update cascade,
    foreign key(user_id) references user(id) on delete cascade on update cascade
)ENGINE=InnoDB DEFAULT CHARSET='utf8';

/*需求信息表*/
CREATE TABLE IF NOT EXISTS `demand`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT, -- 商品ID
    `title` varchar(100) NOT NULL DEFAULT '' COMMENT '信息标题',
    `thumb` varchar(1000) not null COMMENT '缩略图',
    `user_id` int unsigned not null, -- user id
    `category_id` INT UNSIGNED NOT NULL DEFAULT '0', -- 分类ID
    `num` INT UNSIGNED NOT NULL DEFAULT '0' COMMENT '商品数量', -- 商品数量
    `price` DECIMAL(10,2) NOT NULL DEFAULT '0.00', -- 商品价格
    `area` VARCHAR (50) NOT NULL DEFAULT '' COMMENT '产地', -- 产地
    `position` VARCHAR (200) NOT NULL DEFAULT '' COMMENT '货物所在地点',
    `status` INT UNSIGNED NOT NULL DEFAULT 0 COMMENT'现货',
    `desc` TEXT, -- 描述详情
    `pic` varchar(1000) not null, -- 图片展示
    created_at int unsigned,	-- 创建时间
	  updated_at int unsigned,	-- 最后修改时间
	  primary key(id),
    FOREIGN KEY category_id(`category_id`) REFERENCES category(id) on delete cascade on update cascade,
    foreign key(user_id) references user(id) on delete cascade on update cascade
)ENGINE=InnoDB DEFAULT CHARSET='utf8';


/*订单表*/
CREATE TABLE IF NOT EXISTS `order` (
  id int unsigned not null auto_increment,	-- 订单id
	`type` tinyint unsigned not null default 0,	-- 订单类型
	goods_id int unsigned,	-- 商品id
	goods_num int unsigned not null default 1,	-- 商品数量
	sn varchar(50) not null, 	-- 订单sn
	`time` int unsigned not null,	-- 订单时间
	status int unsigned not null default 0,	-- 订单状态
	before_refund_status int unsigned not null default 0,	-- 申请退款前订单状态
	refund_status int unsigned not null default 0,	-- 退款状态
	refund_amount decimal(15,2) not null default 0,  -- 退款总金额
	refund_balance decimal(15,2) not null default 0, -- 余额退款金额
	refund_paid decimal(15,2) not null default 0,    -- 第三方退款金额
	refund_reason text,  -- 退款理由
	goods_amount decimal(15,2) not null,		-- 商品总金额
	pay_type tinyint unsigned,	-- 第三方支付类型
	pay_platform tinyint unsigned,	-- 支付发起平台
	pay_trade_no varchar(100),	-- 第三方流水号
	goods_name varchar(1000),	-- 商品名称快照
	goods_price decimal(15,2),	-- 商品价格快照
	goods_head_imgs varchar(1000),	-- 商品head图片快照，用||隔开
	goods_desc text,	-- 商品描述快照
	goods_able_use_start int unsigned,	-- 商品可使用日期快照
	goods_able_use_end int unsigned,	-- 商品可使用日期快照
	seller_id int unsigned,	-- 卖家id
	buyer_id int unsigned,	-- 买家id
	buyer_name varchar(50),	-- 买家姓名
	buyer_mobile varchar(50),	-- 买家电话
	buyer_addr varchar(1000),	-- 买家地址（全部拼接后的地址）
	message varchar(500),	-- 买家留言
	pay_time int unsigned,	-- 支付成功时间
	deliver_time int unsigned,	-- 发货时间
	post_pay_time int unsigned,	-- 尾款支付时间
	created_at int unsigned,	-- 创建时间
	updated_at int unsigned,	-- 最后修改时间
	primary key(id),
	foreign key(goods_id) references goods(id) on delete SET NULL on update cascade,
	foreign key(seller_id) references user(id) on delete SET NULL on update cascade,
	foreign key(buyer_id) references user(id) on delete SET NULL on update cascade
)engine=InnoDB default charset=utf8;

/*订单日志表*/
create table if not exists order_log (
	id int unsigned not null auto_increment,	-- log id
	order_id int unsigned not null,		-- 订单id
	status int unsigned not null default 0,	-- 订单状态
	refund_status int unsigned not null default 0,	-- 退款状态
	remark varchar(100),	-- 备注
	created_at int unsigned,	-- 创建时间
	updated_at int unsigned,	-- 最后修改时间
	primary key(id),
	foreign key(order_id) references `order`(id) on delete cascade on update cascade
)engine=InnoDB default charset=utf8;


/*全国省市区(运行完此表后，请运行region.sql执行数据的插入)*/
CREATE TABLE if not exists `region` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0',
  `region_name` varchar(120) NOT NULL DEFAULT '',
  `region_type` tinyint(1) NOT NULL DEFAULT '2',
  `agency_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `areaid` varchar(11) DEFAULT NULL,
  `zip` varchar(11) DEFAULT NULL,
  `code` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  KEY `region_type` (`region_type`),
  KEY `agency_id` (`agency_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


/*用户收货地址表*/
create table if not exists user_address (
	id int unsigned not null auto_increment,	-- 绑定id
	user_id int unsigned not null,	-- 用户id
	receiver varchar(50) not null, -- 收件人
	mobile varchar(50) not null, 	-- 手机
	province int unsigned not null, -- 省
	city int unsigned not null,	-- 市
	region int unsigned not null,	-- 区
	address varchar(1000) not null,	-- 详细地址
	zipcode varchar(50),	-- 邮编
	dft boolean not null default false,			-- 默认地址
	primary key(id),
	foreign key(user_id) references user(id) on delete cascade on update cascade,
	foreign key(province) references region(id) on delete cascade on update cascade,
	foreign key(city) references region(id) on delete cascade on update cascade,
	foreign key(region) references region(id) on delete cascade on update cascade
)engine=InnoDB default charset=utf8;

create table if not exists banner (
	id int unsigned not null auto_increment,	-- id
	file_path varchar(1000) not null, -- 图片路径
	link_path varchar(1000) not null, -- 链接地址
  created_at int unsigned,	-- 申请时间
	updated_at int unsigned,	-- 修改时间
	rank int unsigned not null, 	-- 排序rank
	title varchar(200) not null, -- 图片备注
	`type` int unsigned,
	primary key(id)
)engine=InnoDB default charset=utf8;

/*
  充值记录表
 */
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
 Rbac权限菜单
 */
CREATE TABLE `menu` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`name` varchar(128) NOT NULL,
`parent` int(11) DEFAULT NULL,
`route` varchar(256) DEFAULT NULL,
`order` int(11) DEFAULT NULL,
`data` text,
PRIMARY KEY (`id`),
KEY `parent` (`parent`),
CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8