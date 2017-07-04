<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;



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
 * @property string $saler
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
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'name', 'gender', 'telphone', 'id_hand_pic', 'ship_auth_pic', 'ship_pic'], 'required'],
            [['user_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['gender','saler'], 'string'],
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
            'user_id' => '用户ID',
            'name' => '用户姓名',
            'gender' => '用户性别',
            'telphone' => '用户电话',
            'id_hand_pic' => '手持身份照',
            'ship_auth_pic' => '船舶证书',
            'ship_pic' => '船舶照片',
            'status' => '审核状态',
            'saler' => '业务员',
            'created_at' => '生成于',
            'updated_at' => '更新于',
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
