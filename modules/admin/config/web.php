<?php

$params = require(__DIR__ . '/params.php');

$config = [
	'id' => 'basic',
	'basePath' => dirname(__DIR__),
	'name' => 'Treepie',
	'bootstrap' => ['log'],
	'components' => [
		'request' => [
			'cookieValidationKey' => 'all_you_touch_and_all_you_see_is_all_you_life_will_ever_be',
		],
		'urlManager' => [
			'enablePrettyUrl' => true,
			'showScriptName' => false,
			'rules' => [
				'signin' => 'site/signin',
				'signup' => 'site/signup',
			],
		],
		'cache' => [
			'class' => 'yii\caching\FileCache',
		],
		'user' => [
			'identityClass' => 'app\models\User',
			'enableAutoLogin' => true,
			'loginUrl' => ['site/signin'],
		],
		'errorHandler' => [
			'errorAction' => 'site/error',
		],
		'mailer' => [
			'class' => 'yii\swiftmailer\Mailer',
			// send all mails to a file by default. You have to set
			// 'useFileTransport' to false and configure a transport
			// for the mailer to send real emails.
			'useFileTransport' => true,
		],
		'log' => [
			'traceLevel' => YII_DEBUG ? 3 : 0,
			'targets' => [
				[
					'class' => 'yii\log\FileTarget',
					'levels' => ['error', 'warning'],
				],
			],
		],
		'db' => require(__DIR__ . '/db.php'),
		'view' => [
			'class' => 'app\components\View'
		],
		'authManager' => [
			'class' => 'yii\rbac\DbManager',
			'defaultRoles' => ['guest'],
		],
		'assetManager' => [
			'bundles' => [
				'yii\web\JqueryAsset' => [
					'js' => []
				],
				'yii\bootstrap\BootstrapPluginAsset' => [
					'js' => []
				],
				'yii\bootstrap\BootstrapAsset' => [
					'css' => []
				]
			]
		],
	],
	'defaultRoute' => 'article/index',
	'params' => $params,
];

if (YII_ENV_DEV) {
	// configuration adjustments for 'dev' environment
	$config['bootstrap'][] = 'debug';
	$config['modules']['debug'] = 'yii\debug\Module';

	$config['bootstrap'][] = 'gii';
	$config['modules']['gii'] = 'yii\gii\Module';
}

return $config;