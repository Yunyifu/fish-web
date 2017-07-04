<?php
namespace common\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

/**
 * Login form
 */
class LoginForm extends ActiveRecord
{
    public $username;
    public $password;
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
            [['username'], 'integer'],
            //[['username'], 'islength11'],
            // rememberMe must be a boolean value
            //['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
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
    public function validatePassword($attribute, $params)
    {

        //return Yii::$app->security->validatePassword($password, $this->password_hash);

        /*if (!$this->hasErrors()) {
            $data = self::find()->where('username = :user and password = :pass',["user" => $this->username,"pass" => $this->password])->one();
            if(is_null($data)){
                $this->addError("password","用户名或密码错误");
            }*/
          /*  Yii::$app->security->validatePassword($password, $this->password_hash);

            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($password, 'Incorrect username or password.');
            }*/
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, '手机号或密码错误');
            }
        }

    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        /*$user = 'admin';
        $password = '$2y$13$sg1ZbHqQq.He6MjaKJdfL.VumDY963aJc9mr3M9ZuRIGc3Kpr14Q2';
        if( empty( $user ) || !$this->validatePassword( $password ) ) {
            return false;
        } else {
            return true;
        }*/
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
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
