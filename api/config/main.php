<?php
use common\util\Utils;
$params = array_merge( require (__DIR__ . '/../../common/config/params.php'), require (__DIR__ . '/../../common/config/params-local.php'), 
        require (__DIR__ . '/params.php'), require (__DIR__ . '/params-local.php') );

return [ 
    'id' => 'app-api',
    'basePath' => dirname( __DIR__ ),
    'bootstrap' => [ 
        'log' 
    ],

    'modules' => [ 
        'v1' => [ 
            'class' => 'api\modules\v1\Module' 
        ] 
    ],
    'controllerNamespace' => 'api\controllers',
    'components' => [ 
        'user' => [ 
            'identityClass' => 'common\models\User',
            'enableSession' => false,
            'enableAutoLogin' => false 
        ],
        'request' => [ 
            'parsers' => [ 
                'application/json' => 'yii\web\JsonParser' 
            ],
        ],
        'response' => [ 
            'class' => 'yii\web\Response',
            'charset' => 'UTF-8',
            'on beforeSend' => function ($event) {
                /* @var $response yii\web\Response */
                $response = $event->sender;

                Utils::formatApiResponse($response);
            } 
        ],
        'errorHandler' => [ ],
        'urlManager' => [
            //'enableStrictParsing'=>true,
            'rules' => [ 
                // [
                // 'class' => 'yii\rest\UrlRule',
                // 'controller' => [
                // 'v1/user'
                // ]
                // ]

                // 手机号是否已注册
                'GET v1/users/check-mobile' => 'v1/user/check-mobile',

                // 获取手机验证码
                'POST v1/users/code' => 'v1/user/code',
                // 手机号密码登录
                'POST v1/users/login' => 'v1/user/login',
                // 手机号注册登录、第三方注册登录
                'POST v1/users/oauth' => 'v1/user/o-auth-login',
                // 手机号重置密码
                'POST v1/users/reset-pwd' => 'v1/user/reset-pwd',
                // 退出
                'POST v1/users/logout' => 'v1/user/logout',
                // 绑定（换绑）第三方
                'POST v1/users/bind' => 'v1/user/bind',
                // 获取当前登录用户信息
                'GET v1/users' => 'v1/user/index',
                // 修改当前用户信息
                'POST v1/users' => 'v1/user/update',
                // 获取当前用户发布的供应信息
                'POST v1/user/mygoods/' => 'v1/user/mygoods',
                // 获取当前用户发布的需求信息
                'POST v1/user/mydemand/' => 'v1/user/mydemand',
                // 获取当前用户已卖出信息
                'GET v1/user/sell' => 'v1/user/sell',
                // 获取当前用户已购买信息
                'GET v1/user/buy' => 'v1/user/buy',
                // 删除用户发布的信息
                'POST v1/user/delete' => 'v1/user/delete',
                // 获取当前用户信息
                'GET v1/deal/index' => 'v1/deal/index',
                //添加分类
                'POST V1/category/add' => 'v1/category/add',
                //获取商品首页信息列表
                'GET v1/goods/index' => 'v1/goods/index',
                //'POST v1/goods/index' => 'v1/goods/index',
                //根据ID获取商品信息
                'GET v1/goods/detail/<goodsId:.+>' => 'v1/goods/detail',
                //搜索商品
                'POST v1/goods/search/' => 'v1/goods/search',
                //添加商品信息
                'POST v1/goods/add/' => 'v1/goods/add',
                'POST v1/goods/setstatus/' => 'v1/goods/setstatus',
                //更新商品信息
                'POST v1/goods/update/' => 'v1/goods/update',
                //获取供应信息首页
                'GET v1/demand/index' => 'v1/demand/index',
                //'POST v1/demand/index' => 'v1/demand/index',
                //根据ID获取供应信息
                'GET v1/demand/detail/<demandId:.+>' => 'v1/demand/detail',
                //搜索供应信息
                'POST v1/demand/search/' => 'v1/demand/search',
                'GET v1/demand/search/' => 'v1/demand/search',
                //添加需求信息
                'POST v1/demand/add/' => 'v1/demand/add',
                //更新商品信息
                'POST v1/demand/update/' => 'v1/demand/update',
                //地区
                'GET v1/region/province' => 'v1/Region/province',
                'GET v1/region/cities/<province:.+>' => 'v1/Region/cities',
                'GET v1/region/regions/<city:.+>' => 'v1/Region/regions',
                //分类
                'GET v1/category/firstcate' => 'v1/category/firstcate',
                'GET v1/category/secondcate/<cateId:.+>' => 'v1/category/secondcate',
                //图片上传
                'POST v1/upload/upload' => 'v1/upload/upload',
                //首页banner接口
                'GET v1/home/index' => 'v1/home/index',
                //首页供应信息精选接口
                'GET v1/home/hotgoods' => 'v1/home/hotgoods',
                //认证信息添加
                'POST v1/auth/add' => 'v1/auth/add',
                //公司认证信息添加
                'POST v1/companyauth/add' => 'v1/companyauth/add',
                //点击第一个支付生成订单
                'POST v1/order/add' => 'v1/order/add',
                //点击第二个支付确认订单
                'POST v1/order/confirm' => 'v1/order/confirm',

            ] 
        ] 
    ],
    'params' => $params 
];
