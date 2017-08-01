<?php
// ////////////////////////////////////////////////////////////////////////////
//
// ATHER.SHU WWW.ASAREA.CN
// All Rights Reserved.
// email: shushenghong@gmail.com
//
// ///////////////////////////////////////////////////////////////////////////
namespace api\common\controllers;

use common\models\UserChargeLog;
use common\util\Constants;
use common\util\PayUtil;
use common\util\Utils;
use yii\base\UserException;
use yii\web\UnauthorizedHttpException;
use common\models\Order;

/**
 * 支付controller
 *
 * @author Ather.Shu Apr 7, 2016 12:41:10 PM
 */
class PayController extends BaseController {

    public $needLoginActions = "*";

    /**
     * @api {get} /pay/charge 充值
     * @apiVersion 0.1.0
     * @apiGroup pay
     *
     * @apiParam {string} payType 支付渠道 默认连连支付，可不填此参数
     * @apiParam {string} platform 终端 platform="ios" 或者android 或者web
     * @throws UnauthorizedHttpException
     * @throws UserException
     */
    public function actionCharge($payType = 'll', $platform) {
        $this->checkPayInfo( $payType, $platform );
        //从配置中获取默认保证金金额
        $deposit = \Yii::$app->params['param2'];

        $amount = \Yii::$app->request->post( 'amount', $deposit );
        if( $amount <= 0 ) {
            throw new UserException( '金额需大于0' );
        }
        $uid = $this->getUser()->id;

        $log = new UserChargeLog();
        $log->user_id = $uid;
        $log->amount = $amount;
        $log->pay_type = $payType;
        $log->pay_platform = $platform;
        $log->status = Constants::CHARGE_STATUS_NOT_PAY;
        if( !$log->save() ) {
            throw new UserException( '充值log失败' );
        }

        $tradeNo = Utils::encryptId( $log->id, Constants::ENC_TYPE_CHARGE );
        $remark = Constants::CHARGE_EXTRA_FLAG;
        
        if( $payType == Constants::PAY_TYPE_LL ) {
            $riskItem = \LLPayConfig::buildChargeRiskItem( $uid, $this->getUser()->mobile, $this->getUser()->created_at );
            return PayUtil::llOrder( $uid, $riskItem, $platform, "充值", $tradeNo, $remark, $amount, \LLPayConfig::TRADE_TYPE_CHARGE );
        }
    }

    /**
     * @api {get} /pay/pay 支付
     * @apiVersion 0.1.0
     * @apiGroup pay
     * @apiParam {string} orderId 交易订单id
     * @apiParam {string} payType 支付渠道,不传此参数的话，默认是连连支付 payType="ll"
     * @apiParam {string} platform 终端 platform="ios" 或者android
     * @apiParam {string} acct_name 开户姓名
     * @apiParam {string} id_no 身份证号
     */
    public function actionPay($orderId, $payType='ll', $platform,$acct_name ,$id_no) {
        // 检查支付信息
        $this->checkPayInfo( $payType, $platform );
        // 检查订单信息
        $user = $this->getUser();
        if(empty($user)){
            throw new UserException( '您还未登陆' );
        }
        /** @var  $order Order */
        $order = Order::findOne($orderId);
        if( empty( $order ) ) {
            throw new UserException( '交易不存在' );
        } else if( $order->buyer_id != $user->id ) {
            throw new UnauthorizedHttpException( '该交易不属于你' );
        } else if( $order->status != Constants::ORDER_STATUS_NOT_PAY ) {
            throw new UnauthorizedHttpException( '该交易状态无法支付' );
        }
        if( $payType == Constants::PAY_TYPE_LL ) {
            /* @var $order Order */
            $riskItem = \LLPayConfig::buildRealGoodsRiskItem( $user->id, $user->mobile, $user->created_at, $order->buyer_mobile, 
                    1, 1 );
            return PayUtil::llOrder( $user->id, $riskItem, $platform, "订单" . $order->sn, $orderId . rand( 10, 99 ), $order->sn, $order->goods_amount,$acct_name ,$id_no );
        }
    }

    /**
     * 检查pay info是否正确
     *
     * @apiParam {string} payType 支付渠道
     * @apiParam {string} platform 终端
     * @throws UnauthorizedHttpException
     */
    private function checkPayInfo(&$payType, &$platform) {
        $index = array_search( $payType, Constants::$PAY_TYPES );
        if( $index === false ) {
            throw new UnauthorizedHttpException( '支付类型不对' );
        } else {
            $payType = $index;
        }
        
        $index = array_search( $platform, Constants::$PLATFORMS );
        if( $index === false ) {
            throw new UnauthorizedHttpException( '平台不对' );
        } else {
            $platform = $index;
        }
    }
}