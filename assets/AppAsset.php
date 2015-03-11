<?php

namespace app\assets;

use app\components\AssetBundle;

class AppAsset extends AssetBundle
{
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $css = [
		'css/common.css',
	];
	public $js = [
		'js/main.js',
		'js/isotope.min.js',
		'js/fitColumns.js',
		'js/search.js',
		'js/tag.js',
		'js/comments.js',
	];
	public $depends = [
		'yii\web\YiiAsset',
	];

	public function init()
	{
		self::appendVersion($this->css);
		self::appendVersion($this->js);

		parent::init();
	}
}