<?php

use yii\helpers\Html;
use app\components\helpers\App;

$this->pageTitle = ($model->draft) ? Yii::t('app', 'Create') : Yii::t('app', 'Update');
$this->title = App::getTitle([$this->pageTitle, Yii::t('app', 'Articles'), Yii::t('app', 'Control Panel')]);

$this->setBreadcrumbsItem(['label' => Yii::t('app', 'Control Panel'), 'url' => ['/admin']]);
$this->setBreadcrumbsItem(['label' => Yii::t('app', 'Articles'), 'url' => ['index']]);
$this->setBreadcrumbsItem($this->pageTitle);

?>

<div class="article-update">

	<h1><?= Html::encode($this->pageTitle) ?></h1>

	<?= $this->render('_form', [
		'model' => $model,
		'fileSearchModel' => $fileSearchModel,
		'fileDataProvider' => $fileDataProvider,
	]) ?>

</div>