<?php

/** @var \app\components\View $this */

?>

<button class="back-button"></button>
<?php echo \yii\widgets\Breadcrumbs::widget([
	'tag' => 'div',
	'options' => ['class' => 'breadcrumbs'],
	'itemTemplate' => '{link} / ' . PHP_EOL,
	'activeItemTemplate' => '<span>{link}</span>' . PHP_EOL,
	'links' => $this->params['breadcrumbs'],
]); ?>
