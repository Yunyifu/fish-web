<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "infomation".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $title
 * @property string $thumb
 * @property string $author
 * @property string $content
 * @property integer $listorder
 * @property integer $created_at
 * @property integer $updated_at
 */
class News extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [TimestampBehavior::className()];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'infomation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'listorder', 'created_at', 'updated_at'], 'integer'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 50],
            [['thumb'], 'string', 'max' => 100],
            [['author'], 'string', 'max' => 12],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '用户 ID',
            'title' => '标题',
            'thumb' => '缩略图',
            'author' => '作者',
            'content' => '内容',
            'listorder' => '排序',
            'created_at' => '发布时间（默认自动生成）',
            'updated_at' => '更新时间（默认自动生成）',
        ];
    }

    public function  fields()
    {
        return ['id' => 'id',
            'user_id' => 'user_id',
            'title' => 'title',
            'thumb' => 'thumb',
            'author' => 'author',
            'content' => 'content',
            'listorder' => 'Listorder',
            'created_at' => 'Created At',
            'abs' => function(){
                return $this->getAbs();
            }
        ];

    }

    /**
     * 获取摘要信息
     */
    public function  getAbs(){
        $cut = 440;//默认截取的字数
        $abs = $this->content;
        $abs = strip_tags($abs);//去除HTML标记
        $abs = mb_strimwidth($abs,0,$cut,'...');

        return $abs;

    }
}
