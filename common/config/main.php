<?php
return [ 
    'vendorPath' => dirname( dirname( __DIR__ ) ) . '/vendor',
    'timeZone' => 'Asia/Shanghai',
    'language' => 'zh-CN',
    'components' => [ 
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => YII_DEBUG ? [ ] : [ 'error', 'warning' ],
                ],
             ],
        ],        
        'urlManager' => [ 
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [ ] 
        ] ,
    ]
];
