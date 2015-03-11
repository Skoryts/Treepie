<?php

namespace app\controllers;

use app\components\helpers\Constant;
use app\models\SigninForm;
use app\models\SignupForm;
use Yii;
use yii\filters\AccessControl;
use app\components\Controller;
use yii\filters\VerbFilter;

class SiteController extends Controller
{
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'only' => ['signout'],
				'rules' => [
					[
						'actions' => ['signout'],
						'allow' => true,
						'roles' => ['@'],
					],
				],
			],
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'signout' => ['post'],
				],
			],
		];
	}

	public function actions()
	{
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			],
			'captcha' => [
				'class' => 'yii\captcha\CaptchaAction',
				'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
			],
		];
	}

	public function actionSignin()
	{
		if (!\Yii::$app->user->isGuest) {
			return $this->goHome();
		}

		$model = new SigninForm();
		if ($model->load(Yii::$app->request->post()) && $model->signin()) {
			return $this->goBack();
		} else {
			return $this->render('signin', [
				'model' => $model,
			]);
		}
	}

	public function actionSignup()
	{
		if (!\Yii::$app->user->isGuest) {
			return $this->redirect(['/profile/view', 'id' => Yii::$app->user->id]);
		}

		$model = new SignupForm();
		if ($model->load(Yii::$app->request->post()) && $model->signup()) {
			Yii::$app->getSession()->addFlash(
				Constant::FLASH_MESSAGE_TYPE_SUCCESS,
				Yii::t('app', 'You have successfully registered and logged in.'
				));

			return $this->redirect(['/profile/view', 'id' => Yii::$app->user->id]);
		}

		return $this->render('signup', ['model' => $model]);
	}

	public function actionSignout()
	{
		Yii::$app->user->logout();

		return $this->goHome();
	}

	public function actionGoBack()
	{
		return $this->goBack();
	}
}
