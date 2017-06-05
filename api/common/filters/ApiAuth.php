<?php
// ////////////////////////////////////////////////////////////////////////////
//
// Copyright (c) 2015-2016 Hangzhou Freewind Technology Co., Ltd.
// All rights reserved.
// http://www.seastart.cn
//
// ///////////////////////////////////////////////////////////////////////////
namespace api\common\filters;

use common\models\UserDevice;
use common\util\Constants;
use yii\filters\auth\AuthMethod;
use yii\web\UnauthorizedHttpException;
use common\exception\InvalidTokenHttpException;
use common\exception\NeedLoginHttpException;

/**
 * api auth
 *
 * @author Ather.Shu Apr 22, 2015 7:44:18 PM
 */
class ApiAuth extends AuthMethod {

    public function beforeAction($action) {
        $request = $this->request ?  : \Yii::$app->getRequest();
        $response = $this->response ?  : \Yii::$app->getResponse();
        
        $joke = $request->getHeaders()->get( 'JOKE' );
        $device = $request->getHeaders()->get( 'Device' );
        $token = $request->getHeaders()->get( 'Authorization' );
        
        if( $joke != Constants::APP_JOKE ) {
            $this->challenge( $response );
            $this->handleFailure( $response );
            return false;
        }
        if( empty( $device ) ) {
            $this->challenge( $response );
            throw new UnauthorizedHttpException( 'no device specified' );
            return false;
        }
        // 按照token取user
        if( !empty( $token ) ) {
            $user = $this->user ?  : \Yii::$app->getUser();
            $identity = $user->loginByAccessToken( $token, get_class( $this ) );
            if( $identity === null ) {
                $this->challenge( $response );
                throw new InvalidTokenHttpException();
                return false;
            }
        }
        
        $loginBlockFlag = false;
        $controller = $action->controller;
        // 设置上次活动时间
        if( !empty( $identity ) ) {
            $udevice = UserDevice::findOne( [ 
                'access_token' => $token 
            ] );
            $udevice->last_active = time();
            $udevice->save();
            $controller->userDevice = $udevice;
            
            if( $udevice->device != $device ) {
                $this->challenge( $response );
                throw new UnauthorizedHttpException( 'token not belong to this device' );
                return false;
            }
        }
        if( $controller->needLoginActions == '*' ) {
            $loginBlockFlag = empty( $identity );
        } else if( is_array( $controller->needLoginActions ) ) {
            foreach ( $controller->needLoginActions as $tmpAction ) {
                if( $action->id == $tmpAction && empty( $identity ) ) {
                    $loginBlockFlag = true;
                    break;
                }
            }
        }
        if( $loginBlockFlag ) {
            $this->challenge( $response );
            throw new NeedLoginHttpException();
            return false;
        }
        return true;
    }

    public function authenticate($user, $request, $response) {
        return null;
    }
}