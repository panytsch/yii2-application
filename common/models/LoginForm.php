<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 *
 * @property null|\common\models\User $user
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
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
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @param bool $typeAdmin
     * @return bool whether the user is logged in successfully
     */
    public function login($typeAdmin = false)
    {
        if ($this->validate()) {
            $this->_user = null;
            if (empty($this->getUser($typeAdmin))) {
                return false;
            } else {
                return Yii::$app->user->login($this->_user, $this->rememberMe ? 3600 * 24 * 30 : 0);
            }
        }
        
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @param bool $typeAdmin
     * @return User|null
     */
    protected function getUser($typeAdmin = false)
    {
        if ($this->_user === null) {
            if ($typeAdmin) {
                $this->_user = User::find()
                    ->where(['username' => $this->username, 'status' => User::STATUS_ACTIVE])
                    ->andWhere(['role_id' => User::ROLE_ADMIN])
                    ->one()
                ;
            } else {
                $this->_user = User::find()
                    ->where(['username' => $this->username, 'status' => User::STATUS_ACTIVE])
                    ->one();
                ;
            }
        }
        return $this->_user;
    }
}
