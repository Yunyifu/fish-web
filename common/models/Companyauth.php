<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "companyauth".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $gender
 * @property string $telphone
 * @property string $id_hand_pic
 * @property string $company_pic
 * @property string $factory_pic
 * @property integer $status
 * @property string $saler
 * @property integer $created_at
 * @property integer $updated_at
 */
class Companyauth extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'companyauth';
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
            [['user_id', 'name', 'gender', 'telphone', 'id_hand_pic', 'company_pic', 'factory_pic'], 'required'],
            [['user_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['gender','saler'], 'string'],
            [['name', 'telphone', 'id_hand_pic', 'company_pic', 'factory_pic'], 'string', 'max' => 100],
            [['user_id'], 'unique'],
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
            'name' => '名称',
            'gender' => '性别',
            'telphone' => '联系方式',
            'id_hand_pic' => '手持身份证照片',
            'company_pic' => '公司照片',
            'factory_pic' => '工场照片',
            'status' => '认证状态',
            'saler' => '业务员',
            'created_at' => '生成于',
            'updated_at' => '更新于',
        ];
    }
}
