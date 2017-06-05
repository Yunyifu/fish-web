<?php
/*
 * 配置文件
 * 版本：1.2
 * 日期：2014-06-13
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 */
class LLPayConfig {

    private static $llpay_config;
    
    //商户业务类型 虚拟商品：101001 实物商品：109001 账户充值：108001
    const TRADE_TYPE_VIRTUAL_GOODS = "101001";
    const TRADE_TYPE_REAL_GOODS = "109001";
    const TRADE_TYPE_CHARGE = "108001";
    
    public static function buildChargeRiskItem($userId, $phone, $regTime) {
        $item = [
            "frms_ware_category" => '1002',
            "user_info_mercht_userno" => $userId,
            "user_info_bind_phone" => $phone,
            "user_info_dt_register" => date("YmdHis", $regTime),
        ];
        return json_encode($item);
    }
    
    public static function buildRealGoodsRiskItem($userId, $phone, $regTime, $addrPhone, $addrProv, $addrCity) {
        $item = [
            "frms_ware_category" => '4008',
            "user_info_mercht_userno" => $userId,
            "user_info_bind_phone" => $phone,
            "user_info_dt_register" => date("YmdHis", $regTime),
            "delivery_addr_province" => $addrProv,
            "delivery_addr_city" => $addrCity,
            "delivery_phone" => $addrPhone,
            "logistics_mode" => '2',
            "delivery_cycle" => 'Other'
        ];
        return json_encode($item);
        //return "{\"user_info_bind_phone\":\"13958069593\",\"user_info_dt_register\":\"20131030122130\",\"risk_state\":\"1\",\"frms_ware_category\":\"1009\"}";
    }

    public static function getConfig() {
        if( !isset( self::$llpay_config ) ) {
            $llpay_config = [ ];
            // ↓↓↓↓↓↓↓↓↓↓请在这里配置您的基本信息↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
            // 商户编号是商户在连连钱包支付平台上开设的商户号码，为18位数字，如：201408071000001543
            $llpay_config ['oid_partner'] = '201606121000899504';
            
            // 秘钥格式注意不能修改（左对齐，右边有回车符），加密方式为rsa时使用
            $llpay_config ['RSA_PRIVATE_KEY'] = file_get_contents(__DIR__ . '/key/tb_llpay_private_key.pem');
            
            // 安全检验码，以数字和字母组成的字符，加密方式为md5时使用
            $llpay_config ['key'] = '201606121000899504_ftmd5_20160629';
            
            // ca证书路径地址，用于curl中ssl校验
            // 请保证cacert.pem文件在当前文件夹目录中
            $llpay_config ['cacert'] = __DIR__ . '/cacert.pem';
            
            // ↑↑↑↑↑↑↑↑↑↑请在这里配置您的基本信息↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑
            
            // 版本号
            $llpay_config ['version'] = '1.2';
            
            // 签名方式 不需修改
            $llpay_config ['sign_type'] = strtoupper( 'RSA' );
            
            // 字符编码格式 目前支持 gbk 或 utf-8
            $llpay_config ['input_charset'] = strtolower( 'utf-8' );
            
            // 访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
            $llpay_config ['transport'] = 'http';
            self::$llpay_config = $llpay_config;
        }
        return self::$llpay_config;
    }
}
?>