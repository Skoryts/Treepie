<?php

/** @var \yii\data\ActiveDataProvider $dataProvider */

use yii\widgets\ListView;

?>

<?= ListView::widget([
	'dataProvider' => $dataProvider,
	'layout' => '{items}{pager}',
	'itemView' => function ($model, $key, $index, $widget) {
		return $this->render('_view', ['model' => $model]);
	},
]) ?>

<?php if (false): ?>
	<div class="pagination">
		<a href="">1</a>
		<a href="">&lt;</a>
		<a href="">14</a>
		<a href="">15</a>
		<a href="">16</a>
		<a href="">&gt;</a>
		<a href="">300</a>
	</div>
<?php endif; ?>
