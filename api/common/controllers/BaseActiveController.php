<?php
// ////////////////////////////////////////////////////////////////////////////
//
// Copyright (c) 2015-2016 Hangzhou Freewind Technology Co., Ltd.
// All rights reserved.
// http://www.seastart.cn
//
// ///////////////////////////////////////////////////////////////////////////
namespace api\common\controllers;

use yii\rest\ActiveController;
use api\common\filters\ApiAuth;

/**
 * base active controller
 *
 * @author Ather.Shu Apr 22, 2015 8:45:52 PM
 */
class BaseActiveController extends ActiveController {

    public function behaviors() {
        $behaviors = parent::behaviors();
        $behaviors ['authenticator'] = [ 
            'class' => ApiAuth::className() 
        ];
        return $behaviors;
        
    }
}