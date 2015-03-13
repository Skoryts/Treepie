<?php

namespace app\modules\admin;

use Yii;

class Module extends \yii\base\Module
{
	public $controllerNamespace = 'app\modules\admin\controllers';

	public $defaultRoute = 'main';

	public $layout = 'main';

	public function init()
	{
		parent::init();

	}
}
