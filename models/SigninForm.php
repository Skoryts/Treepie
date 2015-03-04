<?php

namespace app\models;

use app\components\helpers\Constant;
use Yii;
use yii\base\Model;

class SigninForm extends Model
{
	public $email;
	public $password;
	public $rememberMe = true;

	private $_user = false;

	public function rules()
	{
		return [
			[['email', 'password'], 'required'],
			[['email'], 'email'],
			['password', 'validatePassword'],
		];
	}

	public function validatePassword($attribute, $params)
	{
		if (!$this->hasErrors()) {
			$user = $this->getUser();

			if (!$user || !$user->validatePassword($this->password)) {
				$this->addError($attribute, Yii::t('app', 'Incorrect email or password.'));
			}
		}
	}

	public function signin()
	{
		if ($this->validate()) {
			return Yii::$app->user->login($this->getUser(), Constant::REMEMBER_ME_TIME);
		} else {
			return false;
		}
	}

	public function getUser()
	{
		if ($this->_user === false) {
			$this->_user = User::findByEmail($this->email);
		}

		return $this->_user;
	}
}
