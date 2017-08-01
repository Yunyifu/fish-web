<?php
namespace common\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use common\service\UserService;
use common\util\Constants;
use common\util\CacheUtil;
/**
 * Login form
 */
class RegisterForm extends ActiveRecord
{
    public $username;
    public $password;
    public $repass;
    public $validation;
    public $rememberMe = true;

    private $_user;

    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            ['username',function($attr,$params){
                if(preg_match("/^1[34578]{1}\d{9}$/",$attr)){
                    return true;
                }else{
                    //$this->addError('username','请填写正确的手机号');
                }
            }],
            [['username','validation'], 'integer'],
            ['repass','compare','compareAttribute' => 'password','message' => '两次密码不一致']

        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => '用户手机号',
            'password' => '密码',
            'validation' => '验证码',
        ];
    }



    public function register(){
      $ocode = CacheUtil::getCache( Constants::CACHE_USER_MOBILE_CODE, [
          'mobile' => $this->username,
      ] );
      //return $ocode;
        $datas = [
            'type' => 1 ,
            'externalUid' => $this->username,
            //'username' => $this->getParam( 'username' ),
            'externalName' => $this->username,
            //'nickname' => $this->getParam( 'nickname' ),
            'token' => $this->validation,
            'other' => 'other',
            'password' => $this->password,
            'gender' =>  0 ,
            'avatar' => 'http://dev.image.alimmdn.com/1/default.jpg@294w_196h_1l',
            'referee' => null,
        ];

        $user = UserService::register($datas);
        //$user = $this->createUser(['username'=>$this->username, 'password'=>$this->password, 'validation'=>$this->validation]);
        //$user->save(false);
        return Yii::$app->user->login($user,  3600 * 24 * 30 );
    }
/*    public function islength11(){
        $data = $this->username;
        if(strlen($data) == 11){
            return true;
        }else{
            $this->addError('username', '手机号或密码错误');
        }
    }*/

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */

    /**
     * 创建用户
     * @param array $data ['username', 'nickname', 'password']
     * @return boolean|\common\models\User
     */
    public static function createUser($data) {
        $user = new User();
        if(!is_array($data)) {
            $user->addError('username', '数据为空');

        }
        else if(!isset($data['password']) || strlen($data['password']) < 6) {
            $user->addError('password', '密码长度不能小于6');

        }
        else {
            $user->load($data, '');
            $user->setPassword($data['password']);
            $user->generateAuthKey();
            $user->nickname = '用户'.time();
            $user->save();
        }
        return $user;
    }
    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}
