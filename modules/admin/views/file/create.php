<?php

use yii\helpers\Html;

$this->pageTitle = Yii::t('app', 'Create');
$this->setTitle([$this->pageTitle, Yii::t('app', 'Files'), Yii::t('app', 'Control Panel')]);
$this->setBreadcrumbsItem(['label' => Yii::t('app', 'Control Panel'), 'url' => ['/admin']]);
$this->setBreadcrumbsItem(['label' => Yii::t('app', 'Files'), 'url' => ['index']]);
$this->setBreadcrumbsItem($this->pageTitle);

?>

<div class="file-create">

	<h1><?= Html::encode($this->pageTitle) ?></h1>

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>

</div>