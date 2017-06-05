<?php
// ////////////////////////////////////////////////////////////////////////////
//
// Copyright (c) 2015-2016 Hangzhou Freewind Technology Co., Ltd.
// All rights reserved.
// http://www.seastart.cn
//
// ///////////////////////////////////////////////////////////////////////////
namespace frontend\controllers;

use common\util\AliPayNotifyCallBack;
use common\util\Constants;
use common\util\LLPayNotifyCallBack;
use common\util\WxPayNotifyCallBack;
use yii\filters\AccessControl;

/**
 * 支付controller
 *
 * @author Ather.Shu Jul 16, 2015 9:35:15 PM
 */
class PayController extends BaseController {

    public $enableCsrfValidation = false;

    public function behaviors() {
        return [ 
            'access' => [ 
                'class' => AccessControl::className(),
                'rules' => [ 
                    [ 
                        'actions' => [ 
                            'notify' 
                        ],
                        'allow' => true,
                        'roles' => [ 
                            '?' 
                        ] 
                    ] 
                ] 
            ] 
        ];
    }

    /**
     * 支付回调
     *
     * @param int $payType
     * @param int $platform
     */
    public function actionNotify($payType, $platform) {
        // 连连支付回调
        if( $payType == Constants::PAY_TYPE_LL ) {
            $this->layout = false;
            LLPayNotifyCallBack::verify( $platform );
        }
    }
}