<?php

use yii\helpers\Html;
use app\components\helpers\App;

$this->pageTitle = Yii::t('app', 'Create');
$this->title = App::getTitle([$this->pageTitle, Yii::t('app', 'Categories'), Yii::t('app', 'Control Panel')]);

$this->setBreadcrumbsItem(['label' => Yii::t('app', 'Control Panel'), 'url' => ['/admin']]);
$this->setBreadcrumbsItem(['label' => Yii::t('app', 'Categories'), 'url' => ['index']]);
$this->setBreadcrumbsItem($this->pageTitle);

?>

<div class="category-create">

	<h1><?= Html::encode($this->pageTitle) ?></h1>

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>

</div>
