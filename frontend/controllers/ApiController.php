<?php
// ////////////////////////////////////////////////////////////////////////////
//
// Copyright (c) 2015-2016 Hangzhou Freewind Technology Co., Ltd.
// All rights reserved.
// http://www.seastart.cn
//
// ///////////////////////////////////////////////////////////////////////////
namespace frontend\controllers;

use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UnauthorizedHttpException;

/**
 * api的前端代理，用于h5页面访问
 *
 * @author Ather.Shu May 2, 2016 9:27:55 PM
 */
class ApiController extends BaseController {

    public $enableCsrfValidation = false;

    public $layout = false;

    public function behaviors() {
        return [ 
            'verbs' => [ 
                'class' => VerbFilter::className(),
                'actions' => [ 
                    'call' => [ 
                        'post',
                        'options' 
                    ] 
                ] 
            ] 
        ];
    }

    /**
     * call api
     *
     * @throws UnauthorizedHttpException
     */
    public function actionCall() {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $request = \Yii::$app->request;
        // cors 跨域
        if( $request->isOptions ) {
            return;
        }
        // api method
        $api = $request->post( 'api' );
        $version = $request->post( 'version', 'v1' );
        $method = $request->post( 'method' );
        $data = $request->post( 'data', [ ] );
        if( empty( $api ) ) {
            throw new UnauthorizedHttpException( 'api不能为空' );
        }
        if( empty( $method ) ) {
            throw new UnauthorizedHttpException( 'method不能为空' );
        }
        $method = strtolower( $method );
        // v1/users/oauth
        return $this->callApi( $api, $data, $method, $version );
    }
}