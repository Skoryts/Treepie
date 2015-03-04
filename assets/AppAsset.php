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
		'js/jquery-2.1.3.min.js',
		'js/main.js',
		'js/isotope.min.js',
		'js/fitColumns.js',
		'js/search.js',
		'js/tag.js',
	];
	public $depends = [
	];

	public function init()
	{
		self::appendVersion($this->css);
		self::appendVersion($this->js);

		parent::init();
	}
}