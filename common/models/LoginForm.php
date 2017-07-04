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
            // rememberMe must be a boolean value
            //['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($password)
    {

        //return Yii::$app->security->validatePassword($password, $this->password_hash);

        /*if (!$this->hasErrors()) {
            $data = self::find()->where('username = :user and password = :pass',["user" => $this->username,"pass" => $this->password])->one();
            if(is_null($data)){
                $this->addError("password","用户名或密码错误");
            }*/
            Yii::$app->security->validatePassword($password, $this->password_hash);

            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }

    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login($data)
    {
        /*$user = '12345';
        $password = '$2y$13$2MvuB2MiRuPoCop6r8r9ZOJkG6jRIx6scfBPmTGOWVfuFd5vBLSPa';
        if( empty( $user ) || !$this->validatePassword( $password ) ) {
            return false;
        } else {
            return true;
        }*/
        if ($this->validate()) {
            return true;
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
