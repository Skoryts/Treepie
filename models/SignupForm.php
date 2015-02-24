<?php

namespace app\models;

use app\components\helpers\Constant;
use app\components\helpers\Rbac;
use yii\base\Model;
use Yii;

class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;

    public function rules()
    {
        return [
            [['email', 'username'], 'filter', 'filter' => 'trim'],
            [['email', 'username'], 'required'],
            [['email'], 'email'],
            [['email', 'username'], 'string', 'max' => 255],

            ['email', 'unique',
                'targetClass' => '\app\models\User',
                'message' => Yii::t('app', 'This email address has already been taken.')],

            ['password', 'required'],
            ['password', 'string', 'min' => 1],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => Yii::t('app', 'Username'),
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),
        ];
    }

    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->save()) {
                $auth = Yii::$app->authManager;
                $auth->assign($auth->getRole(Rbac::ROLE_USER), $user->getId());
                Yii::$app->user->login($user, Constant::REMEMBER_ME_TIME);

                return $user;
            }
        }

        return null;
    }
}