<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\components\helpers\App;

$this->pageTitle = Yii::t('app', 'Files');
$this->title = App::getTitle([$this->pageTitle, Yii::t('app', 'Control Panel')]);

$this->setBreadcrumbsItem(['label' => Yii::t('app', 'Control Panel'), 'url' => ['/admin']]);
$this->setBreadcrumbsItem($this->pageTitle);

?>

<div class="file-index">

	<h1><?= Html::encode($this->pageTitle) ?></h1>

	<p>
		<?= Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

			[
				'format' => 'raw',
				'value' => function ($data) {
					if (in_array($data->type, \app\models\File::$imageTypes)) {
						$img = Html::img($data->relativePath, ['style' => 'width: 100px;']);
						$a = Html::a($img, $data->relativePath, ['target' => '_blank']);

						return $a;
					}

					return null;
				},
				'contentOptions' => ['style' => 'text-align: center;'],
			],
			[
				'format' => 'raw',
				'value' => function ($data) {
					return Html::tag('span', $data->relativePath, ['class' => 'label label-default']);
				},
			],
			[
				'format' => 'raw',
				'attribute' => 'type',
				'value' => function ($data) {
					return Html::tag('span', $data->type, ['class' => 'label label-success']);
				},
				'contentOptions' => ['style' => 'text-align: center;'],
			],

			[
				'class' => 'yii\grid\ActionColumn',
				'template' => '{download} {delete}',
				'buttons' => [
					'download' => function ($url, $model) {
						return Html::a(Html::tag('span', '', ['class' => 'glyphicon glyphicon-download']), $model->relativePath, ['target' => '_blank', 'title' => Yii::t('app', 'Download')]);
					},
				],
				'contentOptions' => ['style' => 'text-align: center;'],
			],
		],
	]); ?>

</div>