<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_address".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $receiver
 * @property string $mobile
 * @property integer $province
 * @property integer $city
 * @property integer $region
 * @property string $address
 * @property string $zipcode
 * @property integer $dft
 *
 * @property User $user
 * @property Region $province0
 * @property Region $city0
 * @property Region $region0
 */
class UserAddress extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'receiver', 'mobile', 'province', 'city', 'region', 'address'], 'required'],
            [['user_id', 'province', 'city', 'region', 'dft'], 'integer'],
            [['receiver', 'mobile', 'zipcode'], 'string', 'max' => 50],
            [['address'], 'string', 'max' => 1000],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['province'], 'exist', 'skipOnError' => true, 'targetClass' => Region::className(), 'targetAttribute' => ['province' => 'id']],
            [['city'], 'exist', 'skipOnError' => true, 'targetClass' => Region::className(), 'targetAttribute' => ['city' => 'id']],
            [['region'], 'exist', 'skipOnError' => true, 'targetClass' => Region::className(), 'targetAttribute' => ['region' => 'id']],
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
            'receiver' => 'Receiver',
            'mobile' => 'Mobile',
            'province' => 'Province',
            'city' => 'City',
            'region' => 'Region',
            'address' => 'Address',
            'zipcode' => 'Zipcode',
            'dft' => 'Dft',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvince0()
    {
        return $this->hasOne(Region::className(), ['id' => 'province']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity0()
    {
        return $this->hasOne(Region::className(), ['id' => 'city']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion0()
    {
        return $this->hasOne(Region::className(), ['id' => 'region']);
    }
}
