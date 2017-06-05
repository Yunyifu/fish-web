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
	catename varchar(100) not null,	-- 分类名称
	status tinyint unsigned not null default 1 COMMENT '显示状态',	-- 显示状态
	parentid int(10) unsigned NOT NULL DEFAULT '0',	-- 上级分类名称
	`create_at` int(11) UNSIGNED NOT NULL DEFAULT '0',
	primary key(id),
	key (parentid)
)engine=InnoDB default charset=utf8mb4;

/*商品信息表*/
CREATE TABLE IF NOT EXISTS `deal`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, -- 商品ID
    `title` varchar(40) NOT NULL DEFAULT '' COMMENT '信息标题',
    `type` ENUM('1','2') NOT NULL COMMENT '信息类型 1代表供应 2代表采购',
    `user_id` int unsigned not null, -- user id
    `cateid` INT UNSIGNED NOT NULL DEFAULT '0', -- 分类ID
    `num` INT UNSIGNED NOT NULL DEFAULT '0' COMMENT '商品数量', -- 商品数量
    `price` DECIMAL(10,2) NOT NULL DEFAULT '0.00', -- 商品价格
    `area` VARCHAR (50) NOT NULL DEFAULT '' COMMENT '产地', -- 产地
    `position` VARCHAR (200) NOT NULL DEFAULT '货物所在地点',
    `status` VARCHAR (20) NOT NULL DEFAULT '现货',
    `descr` TEXT, -- 描述详情
    `pics` TEXT, -- 图片展示
    `issale` ENUM('0','1') NOT NULL DEFAULT '1', -- 在售状态
    `create_at` INT UNSIGNED NOT NULL DEFAULT '0', -- 创建时间
    `update_at` INT UNSIGNED NOT NULL DEFAULT '0', -- 更新时间
    KEY product_cateid(`cateid`),
    foreign key(user_id) references user(id)
)ENGINE=InnoDB DEFAULT CHARSET='utf8';



/*订单表*/
CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned not null, -- 用户id
  `order_no` varchar(100) NOT NULL DEFAULT '', -- 订单编号
  `dealid` int unsigned NOT NULL, -- 商品编号ID
  `LLpay_id` varchar(100) NOT NULL DEFAULT '', -- 联联支付订单编号
  `username` varchar(50) NOT NULL DEFAULT '', -- 用户名称
  `order_time` varchar(20) NOT NULL DEFAULT '' COMMENT '下单时间', -- 下单时间
  `pay_time` varchar(20) NOT NULL DEFAULT '' COMMENT '支付时间', -- 支付时间
  `payment_id` tinyint(1) NOT NULL DEFAULT '1' COMMENT '支付方式，默认1代表默认支付方式', -- 支付方式，默认1代表默认支付方式
  `product_id` int(11) NOT NULL DEFAULT '0', -- 商品id
  `pay_status` tinyint(1) NOT NULL DEFAULT '0'COMMENT '支付状态0.未支付1.支付成功2.支付失败',-- 支付状态
  `status` tinyint(1) NOT NULL DEFAULT '0'COMMENT '订单状态',-- 订单状态
  `total_price` decimal(20,2) NOT NULL DEFAULT '0.00', -- 实付款
  `pay_amount` decimal(20,2) NOT NULL DEFAULT '0.00', -- 支付账号
  `create_at` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `update_at` int(11) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_no` (`order_no`),
  foreign key(user_id) references user(id),
  KEY `username`(username),
  KEY `dealid`(dealid),
  KEY `create_time` (`create_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*用户收货地址表*/
CREATE TABLE IF NOT EXISTS `address`(
  `addressid` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `firstname` VARCHAR(32) NOT NULL DEFAULT '',
  `lastname` VARCHAR(32) NOT NULL DEFAULT '',
  `company` VARCHAR(100) NOT NULL DEFAULT '',
  `address` TEXT,
  `postcode` CHAR(6) NOT NULL DEFAULT '',
  `telephone` VARCHAR(20) NOT NULL DEFAULT '',
  `user_id` INT UNSIGNED NOT NULL,
  `create_at` int(11) UNSIGNED NOT NULL DEFAULT '0',
  KEY user_id(`user_id`)
) ENGINE=InooDB DEFAULT CHARSET=utf8;

/*图片表*/
CREATE TABLE IF NOT EXISTS `image`(
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `image` varchar(100) NOT NULL DEFAULT '' COMMENT '图片地址',
  `thumb` varchar(100) NOT NULL DEFAULT '' COMMENT '缩略图地址',
) ENGINE-InooDB DEFAULT CHARSET=utf8;

/*城市表*/
