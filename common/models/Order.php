<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property integer $type
 * @property integer $goods_id
 * @property string $sn
 * @property integer $status
 * @property integer $before_refund_status
 * @property integer $refund_status
 * @property string $refund_amount
 * @property string $refund_balance
 * @property string $refund_paid
 * @property string $refund_reason
 * @property string $goods_amount
 * @property integer $pay_type
 * @property integer $pay_platform
 * @property string $pay_trade_no
 * @property string $goods_name
 * @property string $goods_price
 * @property integer $seller_id
 * @property integer $buyer_id
 * @property string $buyer_name
 * @property string $buyer_mobile
 * @property string $seller_mobile
 * @property string $buyer_addr
 * @property string $message
 * @property integer $pay_time
 * @property integer $post_pay_time
 * @property integer $created_at
 * @property integer $updated_at
 * @property Goods $goods
 * @property User $seller
 * @property User $buyer
 * @property OrderLog[] $orderLogs
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public function behaviors()
    {
        return [
            TimestampBehavior::className()
        ];
    }
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'goods_id', 'status', 'before_refund_status', 'refund_status', 'pay_type', 'pay_platform', 'seller_id', 'buyer_id', 'pay_time', 'post_pay_time', 'created_at', 'updated_at'], 'integer'],
            [['sn', 'goods_amount'], 'required'],
            [['refund_amount', 'refund_balance', 'refund_paid', 'goods_amount', 'goods_price'], 'number'],
            [['refund_reason'], 'string'],
            [['buyersee'], 'integer'],
            [['sellersee'], 'integer'],
            [['sn', 'buyer_name', 'buyer_mobile'], 'string', 'max' => 50],
            [['pay_trade_no'], 'string', 'max' => 100],
            [['goods_name', 'buyer_addr'], 'string', 'max' => 1000],
            [['message'], 'string', 'max' => 500],
            [['goods_id'], 'exist', 'skipOnError' => true, 'targetClass' => Goods::className(), 'targetAttribute' => ['goods_id' => 'id']],
            [['seller_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['seller_id' => 'id']],
            [['buyer_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['buyer_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => '种类',
            'goods_id' => '商品 ID',
            'sn' => '订单号',
            'status' => '订单状态',
            'before_refund_status' => '申请退款前订单状态',
            'refund_status' => '退款状态',
            'refund_amount' => '退款总金额',
            'refund_balance' => '余额退款金额',
            'refund_paid' => '第三方退款金额',
            'refund_reason' => '退款理由',
            'goods_amount' => '订单金额',
            'pay_type' => '第三方支付类型',
            'pay_platform' => '支付发起平台',
            'pay_trade_no' => '第三方流水号',
            'goods_name' => '商品名称',
            'goods_price' => '价格',
            'seller_id' => '卖家ID',
            'buyer_id' => '买家ID',
            'buyer_name' => '买家姓名',
            'buyer_mobile' => '买家手机',
            'buyer_addr' => '买家地址',
            'message' => '买家留言',
            'pay_time' => '支付成功时间',
            'post_pay_time' => '尾款支付时间',
            'created_at' => '生成于',
            'updated_at' => '更新于',
            'buyersee'=>'买家可见',
            'sellersee'=>'卖家可见',
        ];
    }

    public function fields(){
        return [
            'id' => 'id',
            'type' => 'type',
            'goods_id' => 'goods_id',
            'sn' => 'sn',
            'status' => 'status',
            'order_amount' => 'goods_amount',
            'pay_trade_no' => 'pay_trade_no',
//            'goods_name' => function(){
//                return $this->goods->title;
//            },
            'goods_desc' => function(){
                return $this->goods->desc;
            },
            'goods_price' => function(){
                return $this->goods->price;
            },
            'goods_pic'=>function(){
                return $this->goods->pic;
            },
            'buyer_name' => function(){
                return $this->buyer->username;
            },
            'seller_name' => function(){
                return $this->seller->username;
            },
            'nick_name' => function(){
                return $this->seller->nickname;
            },
            'avatar' => function(){
                return $this->seller->avatar;
            },
            'buyer_mobile' => function(){
                return $this->buyer->username;
                //return substr_replace($this->buyer->username,'****',3,6);
            },
            'seller_mobile' => function(){
                return substr_replace($this->seller->mobile,'****',3,6);
            },
            'buyer_addr' => 'buyer_addr',
            'message' => 'message',
            'pay_time' => 'pay_time',
            'created_at' => 'created_at',
            'updated_at' => 'updated_at',

        ];
    }


    public function getBuyerName()
    {
        return $this->buyer?substr_replace($this->buyer->username,'****',3,6):'用户已删除';
    }
    public function getSellerName()
    {
        return $this->seller?substr_replace($this->seller->username,'****',3,6):'用户已删除';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoods()
    {
        return $this->hasOne(Goods::className(), ['id' => 'goods_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeller()
    {
        return $this->hasOne(User::className(), ['id' => 'seller_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBuyer()
    {
        return $this->hasOne(User::className(), ['id' => 'buyer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderLogs()
    {
        return $this->hasMany(OrderLog::className(), ['order_id' => 'id']);
    }

    public function getStatusTextBuyer(){
      switch ($this->status) {
        case 0:
          $text = '<span class="green">订单待支付</span>';
          break;
        case 1:
          $text = '<span class="red">订单已取消</span>';
          break;
        case 2:
          $text = '<span class="green">订单已支付</span>';
          break;
        case 3:
          $text = '<span class="green">订单服务中</span>';
          break;
        case 4:
          $text = '<span class="green">订单已发货</span>';
          break;
        case 5:
          $text = '<span class="green">订单已完成</span>';
          break;
        case 6:
          $text = '<span class="green">退货中</span>';
          break;
        default:
          return '<span>状态异常</span>';
          break;
      }
      return $text;
    }
    public function getStatusTextSeller(){
      switch ($this->status) {
        case 0:
          $text = '<span class="green">订单待支付</span>';
          break;
        case 1:
          $text = '<span class="red">订单已取消</span>';
          break;
        case 2:
          $text = '<span class="green">订单已支付</span>';
          break;
        case 3:
          $text = '<span class="green">订单服务中</span>';
          break;
        case 4:
          $text = '<span class="green">订单已发货</span>';
          break;
        case 5:
          $text = '<span class="green">订单已完成</span>';
          break;
        case 6:
          $text = '<span class="green">退货中</span>';
          break;
        default:
          return '<span class="red">状态异常</span>';
          break;
      }
      return $text;
    }

    public function getAmount(){
        return '<span class="red">'.$this->goods_amount.'</span>';
    }
}
