<?php use yii\helpers\Html; ?>

<?php if (isset($fileSearchModel) && isset($fileDataProvider)): ?>
	<?php \yii\widgets\Pjax::begin([
		'id' => 'article-files-grid',
		'enablePushState' => false,
	]) ?>
	<?= \yii\grid\GridView::widget([
		'id' => 'article-files-grid',
		'dataProvider' => $fileDataProvider,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

			[
				'format' => 'raw',
				'value' => function ($data) {
					if (in_array($data->type, \app\models\File::$imageTypes)) {
						$img = Html::img($data->relativePath, ['style' => 'width: 100px;']);
						$a = Html::a($img, $data->relativePath, ['target' => '_blank', 'data-pjax' => '0']);

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
				'template' => '{download}',
				'buttons' => [
					'download' => function ($urlGetTagsList, $model) {
						return Html::a(
							Html::tag('span', '', ['class' => 'glyphicon glyphicon-download']),
							$model->relativePath,
							[
								'data-pjax' => '0',
								'target' => '_blank',
								'title' => Yii::t('app', 'Download'),
							]
						);
					},
				],
				'contentOptions' => ['style' => 'text-align: center;'],
			],
		],
	]); ?>
	<?php \yii\widgets\Pjax::end() ?>
<?php endif; ?>