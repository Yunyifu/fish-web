<?php

namespace common\models;

use backend\models\AdminUser;
use common\util\Constants;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "goods".
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
 * @property integer $rank
 *
 * @property Category $category
 * @property User $user
 * @property Order[] $orders
 */
class Goods extends \yii\db\ActiveRecord
{

    public $dealers;

    public function behaviors()
    {
        return [
            TimestampBehavior::className()
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id','title','category_id','desc'], 'required'],
            [['user_id', 'category_id', 'num', 'status', 'created_at', 'updated_at','rank'], 'integer'],
            [['price'], 'number'],
            [['desc'], 'string'],
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
            'id' => 'id',
            'title' => '标题',
            'thumb' => '缩略图',
            'user_id' => '用户id',
            'category_id' => '分类id',
            'num' => '数量',
            'price' => '价格',
            'area' => '产地',
            'position' => '货物所在地',
            'status' => '状态',
            'desc' => '描述',
            'pic' => '图片',
            'created_at' => '创建于',
            'updated_at' => '更新于',
            'rank' => '排序号(从小到大 默认9999)',
            'dealers' => '交易员',


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
            'pic' => function(){
                return empty($this->pic) ? [] : explode(Constants::IMG_DELIMITER,$this->pic);
            },
            'created_at' => 'created_at',
            'updated_at' => 'updated_at',
            'rank' => '排序号(从小到大 默认9999)',
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
            'rank'=>function(){
                return $this->rank;
            },
            'dealer' => function(){
                return $this->dealer;

        }
        ];
    }


    public function setStatus($good_id){
        $goods = $this->findOne($good_id);
        $goods->status = $goods->status ? 0 : 1;
        return $goods->update($goods);
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
    public function getDealer(){
        $dealer_id = $this->user->dealer_id;
        $dealer = AdminUser::find()->where(['id' => $dealer_id])->select('nickname')->one();
        return $dealer->nickname;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['goods_id' => 'id']);
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
