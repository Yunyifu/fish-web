<?php
// ////////////////////////////////////////////////////////////////////////////
//
// Copyright (c) 2015-2016 Hangzhou Freewind Technology Co., Ltd.
// All rights reserved.
// http://www.seastart.cn
//
// ///////////////////////////////////////////////////////////////////////////
namespace common\util;

use yii\base\UserException;

/**
 * pay util
 *
 * @author Ather.Shu Apr 7, 2016 1:33:48 PM
 */
class PayUtil {

    /**
     * 生成连连支付订单
     *
     * @param string $userId 用户id
     * @param string $riskItem 风控参数
     * @param string $platform 发起支付的渠道
     * @param string $title 付款标题
     * @param string $tradeNo 单号
     * @param string $remark 备注
     * @param int $amount 元
     * @return string
     */
    public static function llOrder($userId, $riskItem, $platform, $title, $tradeNo, $remark, $amount, $tradeType = \LLPayConfig::TRADE_TYPE_REAL_GOODS) {
        $llpay_config = \LLPayConfig::getConfig();
        // 通用参数
        $params = [ 
            "oid_partner" => trim( $llpay_config ['oid_partner'] ),
            "sign_type" => trim( $llpay_config ['sign_type'] ),
            // 订单有效期30分钟
            "valid_order" => "30",
            "user_id" => "$userId",
            // 商户业务类型 虚拟商品：101001 实物商品：109001 账户充值：108001
            "busi_partner" => $tradeType,
            "no_order" => $tradeNo,
            "dt_order" => date( 'YmdHis', time() ),
            "name_goods" => $title,
            "info_order" => $remark,
            "money_order" => $amount,
            "notify_url" => \Yii::$app->params ['frontUrl'] . "/pay/notify/" . Constants::PAY_TYPE_LL . "/" . $platform,
            "risk_item" => $riskItem 
        ];
        // 不同支付平台的特定参数
        // 请求应用标识 app_request 1-Android 2-ios 3-WAP
        if( $platform == Constants::PLATFORM_WEB ) {
            $params ["app_request"] = "3";
            $params ["risk_item"] = preg_replace( '/"/', '\"', $riskItem );
            // 支付完成回调地址
            $params ["url_return"] = \Yii::$app->params ['frontUrl'] . '/h5/me_order.html';
        } else {
            $params ["app_request"] = $platform == Constants::PLATFORM_ANDROID ? "1" : "2";
        }
        // web生成url或者app生成参数数组
        $llpaySubmit = new \LLpaySubmit( $llpay_config );
        if( $platform == Constants::PLATFORM_WEB ) {
            return $llpaySubmit->llpay_gateway_new . "?req_data=" . rawurlencode( $llpaySubmit->buildRequestParaToString( $params ) );
        } else {
            return $llpaySubmit->buildRequestPara( $params );
        }
    }

    /**
     * 检查支付异步回调
     *
     * @param string $sn 订单编号或者充值编号
     * @param number $fee 金额
     * @param string $extraInfo 支付额外信息
     * @param string $payTradeNo 第三方交易id
     * @param int $payType 支付类型
     * @param int $payPlatform 支付发起平台
     * @throws UserException
     * @return boolean
     */
    public static function checkNotify($sn, $fee, $extraInfo, $payTradeNo, $payType, $payPlatform) {
        // 是否充值 CHARGE_EXTRA_FLAG
        if( $extraInfo === Constants::CHARGE_EXTRA_FLAG ) {
        }         // 订单支付
        else {
        }
        return true;
    }

    /**
     * 申请退款
     *
     * @param int $payType 原始第三方支付类型
     * @param int $payPlatform 原始第三方支付发起平台
     * @param string $payTradeNo 原始第三方交易id
     * @param string $refundNo 退款单号（统一为支付宝格式：退款日期(8 位当天 日期)+流水号(3~24 位, 流水号可以接受数字或英文字符,建议使用数字,但不可接受“000”)）<br>
     *        对订单退款：date("Ymd") . "order" . $order->id<br>
     *        支付遇到问题（金额不等于需支付金额）自动退款：date("Ymd") . "nf" . $sn . rand(1, 100)
     * @param number $totalAmount 原始交易总金额，元
     * @param number $refundAmount 退款金额，元
     * @param string $reason 退款原因
     */
    public static function refund($payType, $payPlatform, $payTradeNo, $refundNo, $totalAmount, $refundAmount, $reason = "协商退款") {
        if( $payType == Constants::PAY_TYPE_LL ) {
            $llpay_config = \LLPayConfig::getConfig();
            // 通用参数
            $params = [ 
                "oid_partner" => trim( $llpay_config ['oid_partner'] ),
                "sign_type" => trim( $llpay_config ['sign_type'] ),
                "no_refund" => $refundNo,
                "dt_refund" => date( 'YmdHis', time() ),
                "money_refund" => $refundAmount,
                "oid_paybill" => $payTradeNo,
                "notify_url" => \Yii::$app->params ['frontUrl'] . "/pay/refund-notify/" . Constants::PAY_TYPE_LL 
            ];
            // 建立请求
            try {
                $llpaySubmit = new \LLpaySubmit( $llpay_config );
                $result = json_decode( $llpaySubmit->buildRequestJSON( $params, $llpaySubmit->llpay_refund_gateway ), true );
                // var_export( $result );
                if( $result ['ret_code'] != "0000" ) {
                    throw new UserException( $result ['ret_msg'] );
                }
            } catch ( \Exception $e ) {
                throw $e;
            }
        }
    }
}