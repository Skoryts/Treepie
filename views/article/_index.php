<?php use yii\widgets\ListView; ?>

<?= ListView::widget([
	'dataProvider' => $dataProvider,
	'layout' => '{items}{pager}',
	'itemView' => function ($model, $key, $index, $widget) {
		return $this->render('_view', ['model' => $model]);
	},
]) ?>