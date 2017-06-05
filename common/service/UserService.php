<?php
// ////////////////////////////////////////////////////////////////////////////
//
// Copyright (c) 2015-2016 Hangzhou Freewind Technology Co., Ltd.
// All rights reserved.
// http://www.seastart.cn
//
// ///////////////////////////////////////////////////////////////////////////
namespace common\service;

use common\models\User;
use yii\web\UnauthorizedHttpException;
use common\models\UserDevice;
use yii\base\UserException;
use common\util\Constants;
use common\util\CacheUtil;
use common\models\UserOauth;
use yii\base\InvalidParamException;

/**
 * use service
 *
 * @author Ather.Shu Nov 12, 2016 6:30:00 PM
 */
class UserService {

    /**
     * 注册用户
     *
     * @param array $datas
     * @throws InvalidParamException
     * @throws UnauthorizedHttpException
     * @throws UserException
     * @throws Exception
     * @return \common\models\User|NULL
     */
    public static function register($datas) {
        // $type, $externalUid, $externalName, $token, $other
        // $password, $gender, $referee, $avatar
        $needParams = [ 
            'type',
            'externalUid',
            'externalName',
            'token',
            'other',
            'password',
            'gender',
            'avatar',
            'referee' 
        ];
        foreach ( $needParams as $param ) {
            if( !array_key_exists( $param, $datas ) ) {
                throw new InvalidParamException();
            }
        }
        extract( $datas );
        
        if( empty( $type ) || empty( $externalUid ) || empty( $externalName ) || empty( $token ) || !array_key_exists( $type, Constants::$OAUTHS ) ) {
            throw new UnauthorizedHttpException('注册信息不不完整');
        }
        if( $type == Constants::OAUTH_MOBILE ) {
            $ocode = CacheUtil::getCache( Constants::CACHE_USER_MOBILE_CODE, [ 
                'mobile' => $externalUid
            ] );
            if( empty( $ocode ) || $ocode != $token ) {
                throw new UserException( '验证码错误' );
            }
        } else if( $type == Constants::OAUTH_WEIXIN_APP || $type == Constants::OAUTH_WEIXIN_GZH ) {
            if( empty( $other ) ) {
                throw new UserException( '微信用户unionid不能为空' );
            }
        }
        
        $user = User::findByOAuth( $type, $externalUid );
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            // 不存在此user，则注册之
            if( empty( $user ) ) {
                $pwd = '123456';
                $nickname = $externalName;
                if( $type == Constants::OAUTH_MOBILE ) {
                    $pwd = $password;
                    // 如果手机注册并且需要使用密码登录，请打开以下代码
                    if( empty( $pwd ) ) {
                        throw new UserException( '请设置初始密码' );
                    }
                    // 手机注册，用户名就是手机号，昵称随机
                    $username = $externalUid;
                    $nickname = "用户" . time() . rand( 1, 1000 );
                } else {
                    $username = "user_" . time() . rand( 1, 1000 );
                }
                // nickname如果不允许重复，请打开以下代码
                if( User::findOne( [ 
                    'nickname' => $nickname 
                ] ) != null ) {
                    $nickname .= substr( md5( time() ), 0, 3 );
                }
                
                // 微信公众号与微信app互通监测
                if( $type == Constants::OAUTH_WEIXIN_APP || $type == Constants::OAUTH_WEIXIN_GZH ) {
                    $oauth = UserOauth::findOne( 
                            [ 
                                'type' => ($type == Constants::OAUTH_WEIXIN_APP ? Constants::OAUTH_WEIXIN_GZH : Constants::OAUTH_WEIXIN_APP),
                                'other' => $other 
                            ] );
                    // 用户账号已存在
                    if( !empty( $oauth ) ) {
                        $user = $oauth->user;
                    }
                }
                if( empty( $user ) ) {
                    if( empty( $pwd ) || strlen( $pwd ) < 6 ) {
                        throw new UserException( '密码长度不能小于6' );
                    }
                    $user = new User();
                    $user->load( 
                            [ 
                                'username' => $username,
                                'nickname' => $nickname,
                                'password' => $pwd,
                                'referee_id' => $referee,
                                'gender' => $gender,
                                'avatar' => $avatar 
                            ], '' );
                    $user->setPassword( $pwd );
                    $user->generateAuthKey();
                    
                    if( !$user->save() ) {
                        if( $user->hasErrors() ) {
                            throw new UserException( array_values( $user->getFirstErrors() ) [0] );
                        } else {
                            throw new UserException( "user保存失败" );
                        }
                    }
                    // 如果需要注册第三方im账号，打开以下代码
                    // // 通知阿里百川im
                    // if( !$user->hasErrors() ) {
                    // try {
                    // AliBcManager::addImUser( $user );
                    // } catch ( \Exception $e ) {
                    // }
                    // }
                    // 如果需要抓取第三方头像，打开以下代码
                    // if( $avatar ) {
                    // \Yii::$app->queue->push( GrabAvatarJob::class, [
                    // 'avatar' => $avatar,
                    // 'uid' => $user->id
                    // ] );
                    // }
                }
                
                $oauth = new UserOauth();
                $oauth->user_id = $user->id;
                $oauth->type = $type;
                $oauth->external_uid = $externalUid;
                $oauth->external_name = $externalName;
                $oauth->token = $token;
                $oauth->other = $other;
                
                if( !$oauth->save() ) {
                    if( $oauth->hasErrors() ) {
                        throw new UserException( array_values( $oauth->getFirstErrors() ) [0] );
                    } else {
                        throw new UserException( "useroauth保存失败" );
                    }
                }
            }
            
            $transaction->commit();
        } catch ( \Exception $e ) {
            $transaction->rollBack();
            throw $e;
        }
        return $user;
    }

    /**
     * 重新绑定第三方
     * 
     * @param User $user
     * @param array $datas
     * @throws InvalidParamException
     * @throws UnauthorizedHttpException
     * @throws UserException
     * @throws Exception
     * @return \common\models\UserOauth
     */
    public static function bind($user, $datas) {
        $needParams = [ 
            'type',
            'externalUid',
            'externalName',
            'token',
            'other' 
        ];
        foreach ( $needParams as $param ) {
            if( !array_key_exists( $param, $datas ) ) {
                throw new InvalidParamException('1');
            }
        }
        extract( $datas );
        
        if( empty( $type ) || empty( $externalUid ) || empty( $externalName ) || empty( $token ) || !array_key_exists( $type, Constants::$OAUTHS ) ) {
            throw new UnauthorizedHttpException('2');
        }
        if( $type == Constants::OAUTH_MOBILE ) {
            $ocode = CacheUtil::getCache( Constants::CACHE_USER_MOBILE_CODE, [ 
                'mobile' => $externalUid 
            ] );
            if( empty( $ocode ) || $ocode != $token ) {
                throw new UserException( '验证码错误' );
            }
        }
        
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            if( UserOauth::find()->where( [ 
                'external_uid' => $externalUid,
                'type' => $type 
            ] )->andWhere( [ 
                '!=',
                'user_id',
                $user->id 
            ] )->count() > 0 ) {
                throw new UserException( $externalName . '已注册或已绑定其他用户' );
            }
            // 微信公众号与微信app互通监测
            if( $type == Constants::OAUTH_WEIXIN_APP || $type == Constants::OAUTH_WEIXIN_GZH ) {
                $oauth = UserOauth::findOne( 
                        [ 
                            'type' => ($type == Constants::OAUTH_WEIXIN_APP ? Constants::OAUTH_WEIXIN_GZH : Constants::OAUTH_WEIXIN_APP),
                            'other' => $other 
                        ] );
                // 用户账号已存在
                if( !empty( $oauth ) && $oauth->user->id != $user->id ) {
                    throw new UserException( $externalName . '已注册或已绑定其他用户' );
                }
            }
            
            $oauth = $user->getUserOauths()->andWhere( [ 
                'type' => $type 
            ] )->one();
            if( !isset( $oauth ) ) {
                $oauth = new UserOauth();
                $oauth->user_id = $user->id;
                $oauth->type = $type;
            }
            $oauth->external_uid = $externalUid;
            $oauth->external_name = $externalName;
            $oauth->token = $token;
            $oauth->other = $other;
            
            if( !$oauth->save() ) {
                throw new UserException( '绑定未成功' );
            }
            $transaction->commit();
            return $oauth;
        } catch ( \Exception $e ) {
            $transaction->rollBack();
            throw $e;
        }
    }

    /**
     * 登录某账号的某设备
     *
     * @param User $user
     * @param string $device 设备唯一名
     * @throws UnauthorizedHttpException
     * @throws UserException
     * @throws Exception
     */
    public static function loginDevice($user, $device) {
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            // 是否已被封禁
            if( $user->status == User::STATUS_DELETED ) {
                if( $user->block_until > time() ) {
                    throw new UnauthorizedHttpException( '您的账号已被封禁' );
                } else {
                    $user->status = User::STATUS_ACTIVE;
                    $user->block_until = null;
                    $user->save();
                }
            }
            // 下线其他设备
            if( $device != Constants::DEVICE_INNER_CALL ) {
                $onlineDevices = $user->getUserDevices()->andWhere( [ 
                    'loggedout' => 0 
                ] )->andWhere( [ 
                    '!=',
                    'device',
                    Constants::DEVICE_INNER_CALL 
                ] )->all();
                foreach ( $onlineDevices as $userDevice ) {
                    $userDevice->logout();
                }
            }
            
            $userDevice = $user->getUserDevices()->andWhere( [ 
                'device' => $device 
            ] )->one();
            if( empty( $userDevice ) ) {
                $userDevice = new UserDevice();
                $userDevice->device = $device;
                $userDevice->user_id = $user->id;
            }
            // 登录重置token
            $userDevice->access_token = User::generateAccessToken();
            $userDevice->loggedout = 0;
            $userDevice->last_active = time();
            if( !$userDevice->save() ) {
                if( $userDevice->hasErrors() ) {
                    throw new UserException( array_values( $userDevice->getFirstErrors() ) [0] );
                } else {
                    throw new UserException( "userdevice保存失败" );
                }
            }
            
            $transaction->commit();
            return $userDevice;
        } catch ( \Exception $e ) {
            $transaction->rollBack();
            throw $e;
        }
    }
}