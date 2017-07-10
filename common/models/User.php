<?php
namespace common\models;

use backend\models\AdminUser;
use common\util\Constants;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * 用户User model
 *
 * @property integer $id
 * @property string $username 登录名
 * @property string $password_hash 登录密码
 * @property string $nickname 昵称
 * @property string $password_reset_token 重置密码
 * @property string $auth_key cookie记住我key
 * @property integer $status 是否激活用户
 * @property integer $block_until 封禁截止日期
 * @property string $avatar 头像
 * @property integer $gender 性别
 * @property integer $birthday 生日
 * @property integer $referee_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 * 
 * @property string $mobile
 * @property UserDevice $lastActiveDevice
 * @property UserOauth[] $userOauths
 * @property Auth[] $auth
 * @property Companyauth[] $companyauth
 * @property UserDevice[] $userDevices
 * @property User $referee
 * @property User[] $subUsers
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    public $access_token='';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
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
            [['username', 'nickname', 'password_hash'], 'required','message'=>'账号密码不能为空'],
            [['username', 'nickname'], 'string', 'max' => 50],
            ['username', 'validateName'],
            [['avatar'], 'string', 'max' => 1000],
            //[['block_until', 'gender', 'birthday', 'referee_id', 'created_at', 'updated_at'], 'integer'],
            //['status', 'default', 'value' => self::STATUS_ACTIVE],
            //['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            //[['referee_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['referee_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '用户名',
            'password_hash' => '登陆密码',
            'nickname' => '昵称',
            'password_reset_token' => '重置密码',
            'auth_key' => 'Auth Key',
            'status' => '状态',
            'block_until' => '封禁截止日期',
            'avatar' => '头像',
            'gender' => '性别',
            'birthday' => '生日',
            'referee_id' => '推荐人',
            'created_at' => '创建时间',
            'updated_at' => '修改时间',
        ];
    }
    
    /**
     * username nickname要唯一
     */
    public function validateName($attribute, $params) {
        $user = self::findOne( [$attribute => $this->$attribute] );
        if(!empty($user) && $user->id != $this->id) {
            $this->addError($attribute, '已存在该' . $attribute);
        }
    }

    public function fields() {
        $selfInfo = [];
        if(\Yii::$app->user->id == $this->id) {
//          $imInfo = AliBcManager::getUserImInfo($this);
            $selfInfo = ['oauths' => 'userOauths', 'devices' => 'userDevices', 'referee'];
        }
        $commonInfo = ['id' => function() {
            return $this->id;//Utils::encryptId($this->id, Constants::ENC_TYPE_USER);
        }, 'nickname' => function() {
            return $this->nickname ? $this->nickname : '用户';
        }, 'gender', 'birthday', 'reg_time' => 'created_at',
            'fisher' =>function(){
            return empty($this->auth)?0:$this->auth->status;
        }, 'factory' => function(){
            return empty($this->companyauth)?0:$this->companyauth->status;
        },
        'avatar' => function(){
            return isset($this->avatar)?$this->avatar: "/1/default.jpg@294w_196h_1l";
        }];
        return array_merge($commonInfo, $selfInfo);
    }
    
    /**
     * 获取用户注册手机
     * @return string
     */
    public function getMobile() {
        foreach ($this->userOauths as $oauth) {
            if($oauth->type == Constants::OAUTH_MOBILE) {
                return $oauth->external_uid;
            }
        }
        return '';
    }
    /**
     * 获取头像
     * @return string
     */
//    public function getAvatar() {
//        return '123.jpg';
//        return isset($this->avatar)?$this->avatar:"/1/default.jpg@294w_196h_1l";
//    }
    /**
     * 获取最后活动设备
     * @return UserDevice|NULL
     */
    public function getLastActiveDevice() {
        $udevices = $this->userDevices;
        return UserDevice::find()->where(['user_id' => $this->id, 'loggedout' => 0])->orderBy('last_active DESC')->limit(1)->one();
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserOauths()
    {
        return $this->hasMany(UserOauth::className(), ['user_id' => 'id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserDevices()
    {
        return $this->hasMany(UserDevice::className(), ['user_id' => 'id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReferee()
    {
        return $this->hasOne(User::className(), ['id' => 'referee_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubUsers()
    {
        return $this->hasMany(User::className(), ['referee_id' => 'id']);
    }

    public function getAuth()
    {
        return $this->hasOne(Auth::className(), ['user_id' => 'id']);
    }
    public function getCompanyauth()
    {
        return $this->hasOne(Companyauth::className(), ['user_id' => 'id']);
    }
    
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $device = UserDevice::findOne(['access_token' => $token]);
        if($device && $device->loggedout == 0 && ((time() - $device->last_active) < Constants::ACCESS_TOKEN_EXPIRES ) && $device->user && $device->user->status == self::STATUS_ACTIVE) {
            return $device->user;
        }
        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }
    
    /**
     * 根据第三方uid获取user
     * @param int $type
     * @param string $externalUid
     * @return static|null
     */
    public static function findByOAuth($type, $externalUid) {
        $userOAuth = UserOauth::findOne(['external_uid' => $externalUid, 'type' => $type]);
        if($userOAuth) {
            return $userOAuth->user;
        }
        return null;
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
    
    /**
     * generate access token
     */
    public static function generateAccessToken() {
        return uniqid() . '_' . time();
    }

    /**
     * 获取交易员
     */
    public function getDealer(){
        //return 3333;
        //$dealer = $this->hasOne(AdminUser::className(), ['dealer_id' => 'id']);
        //return $this->dealer_id;
        return $this->hasOne(AdminUser::className(), ['id' => 'dealer_id']);

    }

}
