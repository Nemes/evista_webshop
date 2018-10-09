<?php
namespace rest\versions\v1\models;

use common\models\User;
use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $email;
    public $password;

    private $_user;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // email and password are both required
            [['email', 'password'], 'required'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    public function attributeLabels() {
        return [
            'email' => 'E-mail',
            'password' => 'Jelszó',
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
                $this->addError($attribute, 'Hibás email cím vagy jelszó.');
            }
        }
    }

    /**
     * Logs in a user using the provided email and password.
     *
     * @return string This is a token for rest API if it was successful the login. Returns NULL if the login was not successful.
     */
    public function login()
    {
        $token = NULL;

        if ($this->validate()) {
            if(Yii::$app->user->login($this->getUser(), 0)){
                $this->_user->generateRestToken();
                $token = $this->_user->rest_token;
            }
        }

        return $token;
    }

    /**
     * Finds user by [[email]]
     *
     * @return Felhasznalo|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByEmail($this->email);
        }

        return $this->_user;
    }
}
