<?php

namespace common\models;

use Yii;

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
 * @property string $buyer_addr
 * @property string $message
 * @property integer $pay_time
 * @property integer $post_pay_time
 * @property integer $created_at
 * @property integer $updated_at
 *
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
            'type' => 'Type',
            'goods_id' => 'Goods ID',
            'sn' => 'Sn',
            'status' => 'Status',
            'before_refund_status' => 'Before Refund Status',
            'refund_status' => 'Refund Status',
            'refund_amount' => 'Refund Amount',
            'refund_balance' => 'Refund Balance',
            'refund_paid' => 'Refund Paid',
            'refund_reason' => 'Refund Reason',
            'goods_amount' => 'Goods Amount',
            'pay_type' => 'Pay Type',
            'pay_platform' => 'Pay Platform',
            'pay_trade_no' => 'Pay Trade No',
            'goods_name' => 'Goods Name',
            'goods_price' => 'Goods Price',
            'seller_id' => 'Seller ID',
            'buyer_id' => 'Buyer ID',
            'buyer_name' => 'Buyer Name',
            'buyer_mobile' => 'Buyer Mobile',
            'buyer_addr' => 'Buyer Addr',
            'message' => 'Message',
            'pay_time' => 'Pay Time',
            'post_pay_time' => 'Post Pay Time',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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
}
