<?php
// ////////////////////////////////////////////////////////////////////////////
//
// Copyright (c) 2015-2016 Hangzhou Freewind Technology Co., Ltd.
// All rights reserved.
// http://www.seastart.cn
//
// ///////////////////////////////////////////////////////////////////////////
namespace common\exception;

use yii\web\HttpException;
/**
 * token无效
 * @author Ather.Shu Jul 26, 2016 12:02:29 PM
 */
class InvalidTokenHttpException extends HttpException {
    public function __construct($message = "身份失效，请登陆.", $code = 0, \Exception $previous = null)
    {
        parent::__construct(598, $message, $code, $previous);
    }
}