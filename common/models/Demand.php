<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "demand".
 *
 * @property integer $id
 * @property string $title
 * @property string $thumb
 * @property integer $user_id
 * @property integer $category_id
 * @property integer $num
 * @property string $price
 * @property string $area
 * @property string $position
 * @property integer $status
 * @property string $desc
 * @property string $pic
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Category $category
 * @property User $user
 */
class Demand extends \yii\db\ActiveRecord
{

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'demand';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['price'], 'string'],
            [['num'], 'string'],
            [['desc'], 'string'],
            [['demandstatus'], 'string'],
            [['otherstatus'], 'string'],
            [['title'], 'string', 'max' => 100],
            [['thumb', 'pic'], 'string', 'max' => 1000],
            [['area'], 'string', 'max' => 50],
            [['position'], 'string', 'max' => 200],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
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
            'title' => 'Title',
            'thumb' => 'Thumb',
            'user_id' => 'User ID',
            'category_id' => 'Category ID',
            'num' => 'Num',
            'price' => 'Price',
            'area' => 'Area',
            'position' => 'Position',
            'status' => 'Status',
            'desc' => 'Desc',
            'pic' => 'Pic',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function fields(){
        return [
            'id' => 'id',
            'title' => 'title',
            'thumb' => 'thumb',
            'user_id' => 'user_id',
            'category_id' => 'category_id',
            'num' => 'num',
            'price' => 'price',
            'area' => 'area',
            'position' => 'position',
            'status' => 'status',
            'desc' => 'desc',
            'pic' => 'pic',
            'created_at' => 'created_at',
            'updated_at' => 'updated_at',
            'demandstatus' => 'demandstatus',
            'otherstatus' => 'otherstatus',
            'username'=>function(){
                return $this->user->username;
            },
            'nickname'=>function(){
                return $this->user->nickname;
            },
            'avatat'=>function(){
                return $this->user->avatar;
            },
            'gender'=>function(){
                return $this->user->gender;
            },
            'categoryId'=>function(){
                return $this->category->id;
            },
            'categoryName'=>function(){
                return $this->category->name;
            },
            'categoryParent_id'=>function(){
                return $this->category->parent_id;
            },

        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
