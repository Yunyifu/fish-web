<?php
// ////////////////////////////////////////////////////////////////////////////
//
// Copyright (c) 2015-2016 Hangzhou Freewind Technology Co., Ltd.
// All rights reserved.
// http://www.seastart.cn
//
// ///////////////////////////////////////////////////////////////////////////
namespace common\util;


/**
 * 常量
 *
 * @author Ather.Shu Apr 27, 2015 10:55:22 AM
 */
class Constants {
    // http请求头
    const APP_JOKE = 'yifu!';
    // access token有效期（多久不调接口） 10天
    const ACCESS_TOKEN_EXPIRES = 864000;
    // 内部调用api的device标示
    const DEVICE_INNER_CALL = "inner_api_call";
    // id加密
    const ID_CRYPT_KEY = "y11twoa99_k3y_";
    // id加密类型：用户
    const ENC_TYPE_USER = "user";
    // charge加密
    const ENC_TYPE_CHARGE = "charge";
    
    // api data加密
    const DATA_ENCRYPT_IV = "y11twoa99_iv_";
    // img分割符
    const IMG_DELIMITER = "||";
    // 上传类型
    const UPLOAD_TYPE_TEST_IMG = 1;
    const UPLOAD_TYPE_CKEDITOR = 2;
    const UPLOAD_TYPE_DEMAND = 3;
    const UPLOAD_TYPE_AUTH = 4;
    const UPLOAD_TYPE_OTHER = 5;
    
    public static $UPLOAD_TYPES = [
        self::UPLOAD_TYPE_TEST_IMG => [
            'name' => '头像',
            'max' => 5
        ],
        self::UPLOAD_TYPE_CKEDITOR => [
            'name' => 'goods图片',
            'max' => 10
        ],
        self::UPLOAD_TYPE_DEMAND => [
            'name' => 'demand图片',
            'max' => 10, //'extensions' => ['zip'],
         ],
        self::UPLOAD_TYPE_AUTH => [
            'name' => 'AUTH认证图片',
            'max' => 10, //'extensions' => ['zip'],
        ],
        self::UPLOAD_TYPE_OTHER => [
            'name' => '其它图片',
            'max' => 10, //'extensions' => ['zip'],
        ],
    ];

    // 区分充值、订单支付的标志
    const CHARGE_EXTRA_FLAG = '000';
    
    // 支付类型
    const PAY_TYPE_WX = 1;
    const PAY_TYPE_ZFB = 2;
    const PAY_TYPE_LL = 3;

    public static $PAY_TYPES = [ 
        self::PAY_TYPE_WX => "wx",
        self::PAY_TYPE_ZFB => "zfb" ,
        self::PAY_TYPE_LL => "ll"
    ];
    // 订单状态
    // 订单待支付
    const ORDER_STATUS_NOT_PAY = 0;
    // 订单已取消
    const ORDER_STATUS_CANCEL = 1;
    // 订单已支付，待确认
    const ORDER_STATUS_PAID = 2;
    // 订单服务中（卖家接单）
    const ORDER_STATUS_CONFIRMED = 3;
    // 订单已发货（服务完成，待买家确认）
    const ORDER_STATUS_DELIVERED = 4;
    // 订单已完成（买家已确认）
    const ORDER_STATUS_FINISHED = 5;
    // 退货
    const ORDER_STATUS_REFUND = 6;
    //全部订单
    const ORDER_STATUS_ALL = 10;

    public static $ORDER_STATUSES = [
        self::ORDER_STATUS_NOT_PAY => '待支付',
        self::ORDER_STATUS_CANCEL => '已取消',
        self::ORDER_STATUS_PAID => '已支付',
        self::ORDER_STATUS_CONFIRMED => '已接单，待发货',
        self::ORDER_STATUS_DELIVERED => '已接单，已发货',
        self::ORDER_STATUS_FINISHED => '已完成',
        self::ORDER_STATUS_REFUND => '退货'
    ];
    //订单退款状态
    const ORDER_REFUND_APPLY = 0;
    const ORDER_REFUND_REFUNDING = 1;
    const ORDER_REFUND_REFUNDED =2 ;
    // 平台类型
    const PLATFORM_WEB = 1;
    const PLATFORM_IOS = 2;
    const PLATFORM_ANDROID = 3;

    public static $PLATFORMS = [ 
        self::PLATFORM_WEB => "web",
        self::PLATFORM_IOS => "ios",
        self::PLATFORM_ANDROID => "android" 
    ];
    
    //OAUTH类型
    const OAUTH_MOBILE = 1;
    const OAUTH_WEIBO = 2;
    const OAUTH_QQ = 3;
    const OAUTH_WEIXIN_APP = 4;
    const OAUTH_WEIXIN_GZH = 5;
    
    public static $OAUTHS = [
        self::OAUTH_MOBILE => '手机',
        self::OAUTH_WEIBO => '微博',
        self::OAUTH_QQ => 'QQ',
        self::OAUTH_WEIXIN_APP => '微信APP',
        self::OAUTH_WEIXIN_GZH => '微信公众号',
    ];
    
    // 缓存类型
    //用户手机验证码
    const CACHE_USER_MOBILE_CODE = 1;
    //平台屏蔽关键词
    const CACHE_SYSTEM_BANWORDS = 2;
    
    //性别男女
    const GENDER_FEMALE = 0;
    const GENDER_MALE = 1;

    //认证模块性别
    const MALE = 1;
    const FEMALE = 2;

    //默认头像
    const DEFAULT_AVATAR = "/img/avatar.png";
    const BIG_BANNER = 0;
    const SMALL_BANNER =1;
    const AD_BANNER = 2 ;
    public static $banner = [
        self::BIG_BANNER => '大banner图',
        self::SMALL_BANNER => '小banner图',
        self::AD_BANNER => '广告banner图'
    ];
    const AUTH_NO_CHECK = 0;
    const AUTH_CHECKING = 1;
    const AUTH_CHECKED = 2;
    const AUTH_CHECK_REFUSED = 4;
    public static  $checkStatus =[
        self::AUTH_NO_CHECK =>"未认证",
        self::AUTH_CHECKING =>"待审核",
        self::AUTH_CHECKED =>"已认证",
        self::AUTH_CHECK_REFUSED =>"认证拒绝",
    ];
    //商品状态
    const GOODS_DOWN = 0;
    const GOODS_SELLING = 1;
    const GOODS_DEAL = 2;
    const GOODS_INQUIRY =3;
    const GOODS_UNREVIEW =4;
    public static $goodsStatus = [
        self::GOODS_DOWN => '已下架',
        self::GOODS_SELLING =>'上架',
        self::GOODS_DEAL =>'成交',
        self::GOODS_INQUIRY => '询价中',
        self::GOODS_UNREVIEW => '未审核'
    ];
    //分类状态
    const CATE_DOWN = 0;
    const CATE_SHOW = 1;
    const CATE_HOT = 2;
    public static $cateStatus = [
        self::CATE_HOT=>'热门分类',
        self::CATE_DOWN=>'下架',
        self::CATE_SHOW=>'上架',
    ];
    //后台用户类型
    const ADMIN_DEFAULT = 0;
    const ADMIN_SUPER = 1;
    const ADMIN_ADMIN = 2;
    const ADMIN_SERVICE = 3;
    const ADMIN_DEAL = 4;
    public static $admin = [
        self::ADMIN_DEFAULT => '默认用户',
        self::ADMIN_SUPER => '超级管理员',
        self::ADMIN_ADMIN => '管理员',
        self::ADMIN_SERVICE => '客服',
        self::ADMIN_DEAL => '交易顾问',
    ];
    // 充值状态
    const CHARGE_STATUS_NOT_PAY = 0;

    const CHARGE_STATUS_PAID = 1;

    public static $CHARGE_STATUSES = [
        self::CHARGE_STATUS_NOT_PAY => '待支付',
        self::CHARGE_STATUS_PAID => '充值成功'
    ];


}