<?php

namespace app\components;

use Yii;
use yii\web\Controller as CoreController;
use yii\web\Cookie;

class Controller extends CoreController
{
	public function afterAction($action, $result)
	{
		$result = parent::afterAction($action, $result);

		$currentUrlCookie = new Cookie();
		$currentUrlCookie->name = 'currentUrl';
		$currentUrlCookie->value = Yii::$app->request->url;
		$currentUrlCookie->path = '/';
		Yii::$app->response->cookies->add($currentUrlCookie);

		$backUrlCookie = new Cookie();
		$backUrlCookie->name = 'backUrl';
		$backUrlCookie->value = (string) Yii::$app->request->cookies['currentUrl'];
		$backUrlCookie->path = '/';
		Yii::$app->response->cookies->add($backUrlCookie);

		return $result;
	}
}