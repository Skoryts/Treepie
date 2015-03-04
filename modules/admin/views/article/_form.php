<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Category;
use app\models\Article;

/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="article-form">

	<?php $form = ActiveForm::begin([
		'options' => ['enctype' => 'multipart/form-data'],
	]); ?>

	<?= $form->field($model, 'categoryId')->dropDownList(ArrayHelper::map(Category::find()->orderBy('name')->asArray()->all(), 'id', 'name'), ['prompt' => '']) ?>

	<?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

	<?= $form->field($model, 'slug')->textInput(['maxlength' => 255]) ?>

	<?= $form->field($model, 'body')->widget(\dosamigos\ckeditor\CKEditor::className(), [
		'options' => ['rows' => 6],
		'preset' => 'full',
	]) ?>

	<?= $form->field($model, 'uploadedFile[]')->fileInput(['multiple' => true]) ?>

	<?php if (isset($fileSearchModel) && isset($fileDataProvider) && $fileDataProvider->count != 0): ?>

		<?= \yii\grid\GridView::widget([
			'dataProvider' => $fileDataProvider,
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
					'template' => '{download}',
					'buttons' => [
						'download' => function ($urlGetTagsList, $model) {
							return Html::a(Html::tag('span', '', ['class' => 'glyphicon glyphicon-download']), $model->relativePath, ['target' => '_blank', 'title' => Yii::t('app', 'Download')]);
						},
					],
					'contentOptions' => ['style' => 'text-align: center;'],
				],
			],
		]); ?>

	<?php endif; ?>

	<?php
	$urlGetTagsList = \yii\helpers\Url::to(['tags-list']);
	$initScript = <<< SCRIPT
function (element, callback) {
	var id=\$(element).val();
	if (id !== "") {
		$.ajax("{$urlGetTagsList}?id=" + id, {
			dataType: "json"
		}).done(function(data) { callback(data.results);});
	}
}
SCRIPT;
	?>

	<?= $form->field($model, 'tags')->widget(\kartik\select2\Select2::classname(), [
		'pluginOptions' => [
			'multiple' => true,
			'allowClear' => true,
			'minimumInputLength' => 1,
			'ajax' => [
				'url' => $urlGetTagsList,
				'dataType' => 'json',
				'data' => new \yii\web\JsExpression('function(term,page) { return {search:term}; }'),
				'results' => new \yii\web\JsExpression('function(data,page) { return {results:data.results}; }'),
			],
			'initSelection' => new \yii\web\JsExpression($initScript)
		],
	]); ?>

	<?= $form->field($model, 'published')->dropDownList([
		Article::OPTION_NOT_PUBLISHED => Yii::t('app', 'Not Published'),
		Article::OPTION_PUBLISHED => Yii::t('app', 'Published'),
	]) ?>

	<div class="form-group">
		<?= Html::submitButton($model->draft ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>