<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'name' => '渔鱼网 管理后台',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
        'admin' => [
            "class" => 'mdm\admin\Module',
        ],
        'redactor' => [
            'class' => 'backend\components\RedactorModule',
            'uploadDir' => '../../frontend/web/uploads',  // 比如这里可以填写 ./uploads
            //'uploadUrl' => 'http://frontend.fish-web.com/uploads',
            'imageAllowExtensions'=>['jpg','png','gif']
        ],
    ],
    'aliases' => [
        "@mdm/admin" => "@vendor/mdmsoft/yii2-admin",
    ],
    'controllerNamespace' => 'backend\controllers',
    'components' => [
        'user' => [
            'identityClass' => 'backend\models\AdminUser',
            'enableAutoLogin' => false,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ["guest"],
        ]
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            //'*'
            //这里是允许访问的action
            //controller/action
        ]
    ],
    'params' => $params,
];
