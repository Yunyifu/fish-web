<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_oauth".
 *
 * @property integer $id
 * @property integer $type
 * @property integer $user_id
 * @property string $external_uid
 * @property string $external_name
 * @property string $token
 * @property string $refresh_token
 * @property string $other 
 *
 * @property User $user
 */
class UserOauth extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_oauth';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'user_id', 'external_uid', 'external_name'], 'required'],
            [['type', 'user_id'], 'integer'],
            [['external_uid'], 'string', 'max' => 100],
            [['external_name'], 'string', 'max' => 50],
            [['token', 'refresh_token', 'other'], 'string', 'max' => 500],
            [['type', 'external_uid'], 'unique', 'targetAttribute' => ['type', 'external_uid'], 'message' => 'The combination of Type and External Uid has already been taken.'],
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
            'type' => 'Type',
            'user_id' => 'User ID',
            'external_uid' => 'External Uid',
            'external_name' => 'External Name',
            'token' => 'Token',
            'refresh_token' => 'Refresh Token',
            'other' => 'Other',
        ];
    }
    
    public function fields() {
        return ['type', 'external_uid', 'external_name'];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
