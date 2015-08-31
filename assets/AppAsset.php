<?php

namespace app\assets;

use app\components\AssetBundle;

class AppAsset extends AssetBundle
{
	public $basePath = '@webroot';

	public $baseUrl = '@web';

	public $css = [
		'css/fonts.css',
		'css/common.css',
		'css/basic.css',
		'css/article.css',
		'css/mixins.css',
	];

	public $js = [
		'js/main.js',
		'js/search.js',
		'js/tag.js',
		'js/comments.js',
	];

	public $depends = [
		'yii\web\YiiAsset',
	];

	public function init()
	{
		parent::init();

		self::appendVersion($this->css);
		self::appendVersion($this->js);
	}
}