<?php
// ////////////////////////////////////////////////////////////////////////////
//
// Copyright (c) 2015-2016 Hangzhou Freewind Technology Co., Ltd.
// All rights reserved.
// http://www.seastart.cn
//
// ///////////////////////////////////////////////////////////////////////////
namespace frontend\controllers;

use common\util\Constants;
use yii\web\Controller;
use yii\web\Cookie;
use yii\web\Request;

/**
 * basecontroller
 *
 * @author Ather.Shu Jul 14, 2015 2:31:39 PM
 */
class BaseController extends Controller {

    public function beforeAction($action) {
        // 自动登录
        if( \Yii::$app->user->isGuest ) {
            $request = \Yii::$app->request;
            // cookie或者header来自动登录
            $token = $request->getCookies()->getValue( 'auth', '' );
            if( empty( $token ) ) {
                $token = $request->getHeaders()->get( 'Authorization' );
            }
            if( $token ) {
                $this->autoLoginByToken( $token );
            }
        }
        return parent::beforeAction( $action );
    }

    private function autoLoginByToken($token) {
        \Yii::$app->response->cookies->add(
                new Cookie(
                        [
                            'name' => 'auth',
                            'value' => $token,
                            // 30 days
                            'expire' => time() + 30 * 24 * 3600
                        ] ) );
        \Yii::$app->user->loginByAccessToken( $token );
    }

    /**
     * 调取后台api
     *
     * @param string $api 如：users/login
     * @param array $data
     * @param string $version 如：v1
     * @param string $method 如：get post
     * @return array
     */
    public function callApi($api, $data, $method = "get", $version = "v1") {
        /* @var $request Request */
        $request = \Yii::$app->request;
        $method = strtolower( $method );
        $auth = \Yii::$app->user->isGuest ? '' : \Yii::$app->user->identity->access_token;
        if( $method == 'get' ) {
            $getData = http_build_query( $data );
        }
        else if( $method == 'post' ) {
            $postData = json_encode( $data );
        }

        $apiUrl = \Yii::$app->params ['apiUrl'] . '/' . $version . '/' . $api;
        //var_dump($apiUrl);exit;
        $ch = curl_init();
        curl_setopt_array( $ch,
                [
                    CURLOPT_URL => $apiUrl,
                    CURLOPT_RETURNTRANSFER => true,
                    // 为了抓取跳转url（可能是微信web支付之类的）
                    CURLOPT_HEADER => true,
                    CURLOPT_HTTPHEADER => [
                        'JOKE: ' . Constants::APP_JOKE,
                        'Device: ' . 123,//Constants::DEVICE_INNER_CALL,
                        'Authorization: ' . $auth,
                        'Content-Type: application/json'
                    ]
                ] );
        switch ($method) {
            case 'post' :
                curl_setopt( $ch, CURLOPT_POST, 1 );
                curl_setopt( $ch, CURLOPT_POSTFIELDS, $postData );
                break;
            case 'put' :
                curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, "PUT" );
                curl_setopt( $ch, CURLOPT_POSTFIELDS, $postData );
                // curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-HTTP-Method-Override: PUT'));
                break;
            case 'delete' :
                curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, "DELETE" );
                break;
            default :
                curl_setopt( $ch, CURLOPT_URL, $apiUrl . "?" . $getData );
                break;
        }
        $out = curl_exec( $ch );
        // 非拦截输出的json格式的error
        $httpCode = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
        $headSize = curl_getinfo( $ch, CURLINFO_HEADER_SIZE );
        $head = substr( $out, 0, $headSize );
        $out = substr( $out, $headSize );
        curl_close( $ch );
        if( $httpCode != 200 ) {
            // 跳转（可能是微信web支付之类的）
            if( $httpCode == 301 || $httpCode == 302 ) {
                preg_match( "!\r\n(?:Location|URI): *(.*?) *\r\n!", $head, $matches );
                $location = isset( $matches [1] ) ? $matches [1] : null;
                // $location = curl_getinfo( $ch, CURLINFO_EFFECTIVE_URL );
                return \Yii::$app->response->redirect( $location, $httpCode );
            }
            return [
                'api_code' => $httpCode,
                'api_msg' => $httpCode == 404 ? "api不存在" : ('服务器错误' . $httpCode),
            ];
        }
        // 如果是登陆的话，设置cookie，并调用yii的自动登录
        if( $method == 'post' && ($api == 'users/oauth' || $api == 'users/login') ) {
            $token = json_decode( $out, true );
            if( isset( $token ['token'] ) ) {
                $this->autoLoginByToken( $token ['token'] );
            }
        }
        //如果是退出接口
        if( $method == 'post' && $api == 'users/logout' ) {
            \Yii::$app->response->cookies->remove( 'auth' );
            \Yii::$app->user->logout( );
        }
        return json_decode( $out, true );
    }
}
