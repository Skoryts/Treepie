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
			'id' => 'article-form',
			'options' => [
				'enctype' => 'multipart/form-data',
				'data-action-upload-file' => \yii\helpers\Url::to(['article/upload-file', 'id' => $model->id]),
			],
		]); ?>
		<div class="row">
			<div class="col-sm-9">
				<?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>
				<?= $form->field($model, 'body')->widget(\dosamigos\ckeditor\CKEditor::className(), [
					'options' => ['rows' => 6],
					'preset' => 'full',
				]) ?>
			</div>
			<div class="col-sm-3">
				<?= $form->field($model, 'categoryId')->dropDownList(ArrayHelper::map(Category::find()->orderBy('name')->asArray()->all(), 'id', 'name'), ['prompt' => '']) ?>
				<?= $form->field($model, 'slug')->textInput(['maxlength' => 255]) ?>
				<?php $urlGetTagsList = \yii\helpers\Url::to(['tags-list']);
				$initScript = "
					function (element, callback) {
						var id=\$(element).val();
						if (id !== '') {
							$.ajax('{$urlGetTagsList}?id=' + id, {
								dataType: 'json'
							}).done(function(data) { callback(data.results);});
						}
					}
				"; ?>
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
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<?= $form->field($model, 'uploadedFile[]')->fileInput(['multiple' => true]) ?>
				<div class="article-files">
					<legend><?= Yii::t('app', 'Attached Files') ?></legend>
					<?= $this->render('_fileGrid', [
						'fileSearchModel' => $fileSearchModel,
						'fileDataProvider' => $fileDataProvider,
					]) ?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<?= Html::submitButton($model->draft ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>
		<?php ActiveForm::end(); ?>
	</div>
<?php $this->registerJsFile('/js/admin/article/create.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>