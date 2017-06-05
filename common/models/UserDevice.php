<?php

namespace common\models;



/**
 * This is the model class for table "user_device".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $device
 * @property string $access_token api登录token
 * @property string $push_cid
 * @property integer $loggedout 是否已退出
 * @property integer $last_active
 *
 * @property User $user
 */
class UserDevice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_device';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'device', 'access_token'], 'required'],
            [['user_id', 'loggedout', 'last_active'], 'integer'],
            [['device', 'access_token', 'push_cid'], 'string', 'max' => 100]
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
            'device' => 'Device',
            'access_token' => 'Access Token',
            'push_cid' => 'Push Cid',
            'loggedout' => 'Loggedout',
            'last_active' => 'Last Active',
        ];
    }
    
    public function fields() {
        return ['device', 'last_active'];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    
    public function logout() {
        if($this->loggedout) {
            return;
        }
        // 重新生成access token、清空推送cid
        $this->access_token = User::generateAccessToken();
        $this->push_cid = '';
        $this->loggedout = 1;
        $this->save();
    }
}
