<?php

namespace app\components;

use yii\web\AssetBundle as CoreAssetBundle;

class AssetBundle extends CoreAssetBundle
{
	const VERSION = 0.01;

	public $basePath = '@webroot';

	public $baseUrl = '@web';

	public function init()
	{
		self::appendVersion($this->css);
		self::appendVersion($this->js);

		parent::init();
	}

	public static function appendVersion(&$assets)
	{
		foreach ($assets as &$asset) {
			$asset .= '?v=' . self::VERSION;
		}
	}
}