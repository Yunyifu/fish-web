<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_charge_log".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $user_balance
 * @property string $amount
 * @property integer $status
 * @property integer $pay_type
 * @property integer $pay_platform
 * @property string $pay_trade_no
 * @property string $remark
 * @property string $remark_imgs
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $user
 */
class UserChargeLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_charge_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'pay_type', 'pay_platform'], 'required'],
            [['user_id', 'user_balance', 'status', 'pay_type', 'pay_platform', 'created_at', 'updated_at'], 'integer'],
            [['amount'], 'number'],
            [['pay_trade_no'], 'string', 'max' => 100],
            [['remark'], 'string', 'max' => 500],
            [['remark_imgs'], 'string', 'max' => 1000],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'user_balance' => 'User Balance',
            'amount' => 'Amount',
            'status' => 'Status',
            'pay_type' => 'Pay Type',
            'pay_platform' => 'Pay Platform',
            'pay_trade_no' => 'Pay Trade No',
            'remark' => 'Remark',
            'remark_imgs' => 'Remark Imgs',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
