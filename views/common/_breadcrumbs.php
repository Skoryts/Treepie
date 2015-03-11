<?= \yii\helpers\Html::a('', Yii::$app->request->cookies->get('backUrl'), ['class' => 'back-button']) ?>
<?php echo \yii\widgets\Breadcrumbs::widget([
	'tag' => 'div',
	'options' => ['class' => 'path'],
	'itemTemplate' => '{link} / ' . PHP_EOL,
	'activeItemTemplate' => '<span>{link}</span>' . PHP_EOL,
	'links' => $this->params['breadcrumbs'],
]); ?>