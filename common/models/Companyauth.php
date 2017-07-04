<?php

namespace common\models;

use Yii;

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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'name', 'gender', 'telphone', 'id_hand_pic', 'company_pic', 'factory_pic'], 'required'],
            [['user_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['gender'], 'string'],
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
            'user_id' => 'User ID',
            'name' => 'Name',
            'gender' => 'Gender',
            'telphone' => 'Telphone',
            'id_hand_pic' => 'Id Hand Pic',
            'company_pic' => 'Company Pic',
            'factory_pic' => 'Factory Pic',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
