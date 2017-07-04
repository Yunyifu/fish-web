<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "banner".
 *
 * @property string $id
 * @property string $file_path
 * @property string $link_path
 * @property string $created_at
 * @property string $updated_at
 * @property string $rank
 * @property string $title
 * @property string $type
 */
class Banner extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'banner';
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
            [['file_path', 'link_path', 'rank', 'title'], 'required'],
            [['created_at', 'updated_at', 'rank', 'type'], 'integer'],
            [['file_path', 'link_path'], 'string', 'max' => 1000],
            [['title'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '图片ID',
            'file_path' => '图片路径',
            'link_path' => '链接地址(主页大图banner需要)',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'rank' => '排序(从小到大)',
            'title' => '图片标题描述',
            'type' => '种类',
        ];
    }
}
