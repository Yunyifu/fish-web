<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "auth".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $gender
 * @property string $telphone
 * @property string $id_hand_pic
 * @property string $ship_auth_pic
 * @property string $ship_pic
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $user
 */
class Auth extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auth';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'name', 'gender', 'telphone', 'id_hand_pic', 'ship_auth_pic', 'ship_pic'], 'required'],
            [['user_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['gender'], 'string'],
            [['name', 'telphone', 'id_hand_pic', 'ship_auth_pic', 'ship_pic'], 'string', 'max' => 1000],
            [['user_id'], 'unique'],
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
            'name' => 'Name',
            'gender' => 'Gender',
            'telphone' => 'Telphone',
            'id_hand_pic' => 'Id Hand Pic',
            'ship_auth_pic' => 'Ship Auth Pic',
            'ship_pic' => 'Ship Pic',
            'status' => 'Status',
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
