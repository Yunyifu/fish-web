<?php

namespace common\models;

use backend\models\AdminUser;
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
    public $dealers;

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
            [['user_id','title'], 'required'],
            [['category_id', 'status', 'created_at', 'updated_at','dealer_id'], 'integer'],
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
            'title' => '信息的标题',
            'thumb' => '缩略图',
            'user_id' => '用户ID',
            'category_id' => '分类',
            'num' => '采购数量',
            'price' => '意向采购价格',
            'area' => '地理位置',
            'demandstatus' => '货物状态要求',
            'otherstatus' => '其他要求',
            'position' => '地址',
            'status' => '状态',
            'desc' => '描述',
            'pic' => 'Pic',
            'created_at' => '发布时间',
            'updated_at' => 'Updated At',
            'dealers' => '交易员'
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
            'dealer' => function(){
                return $this->dealer;

            }
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

    /**
     * 获取交易员的名称和电话
     * @return string
     *
     */
    public function getDealer(){
        $dealer_id = $this->dealer_id;
        $dealer = AdminUser::find()->where(['id' => $dealer_id])->one();
        return isset($dealer->phone)?$dealer->phone:'';
    }

    public function getPubtime(){
      if ($this->updated_at) {
        if (time() - $this->updated_at < 3600) {
          $minute = floor( (time() - $this->updated_at)/60 );
          return  $minute . '分钟前发布';
        }
        if (time() - $this->updated_at < 86400) {
          $hour = floor( (time() - $this->updated_at)/3600 );
          return  $hour . '小时前发布';
        }
        $day = floor( (time() - $this->updated_at)/86400 );
        return $day . '天前发布';
      }
    }
}
