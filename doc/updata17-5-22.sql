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
