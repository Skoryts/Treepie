<?php

use yii\widgets\ListView;
use app\components\helpers\Category;
use app\components\helpers\App;

$this->pageTitle = Yii::t('app', 'Articles');
$this->title = App::getTitle([$this->pageTitle]);

$this->setBreadcrumbsItem(['label' => $this->pageTitle, 'url' => '/article']);
$this->setBreadcrumbsItems(Category::getBreadcrumbs($category));

?>
<?= ListView::widget([
	'dataProvider' => $dataProvider,
	'layout' => '{items}{pager}',
	'itemView' => function ($model, $key, $index, $widget) {
		return $this->render('view', ['model' => $model]);
	},
]) ?>