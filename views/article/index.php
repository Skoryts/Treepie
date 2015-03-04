<?php

use app\components\helpers\Category;
use app\components\helpers\App;

$this->pageTitle = Yii::t('app', 'Articles');
if (isset($tag))
	$this->pageTitle = Yii::t('app', 'Articles by tag:') . ' ' . $tag;

$this->title = App::getTitle([$this->pageTitle]);

$this->setBreadcrumbsItem(['label' => $this->pageTitle, 'url' => '/article']);
if (isset($category))
	$this->setBreadcrumbsItems(Category::getBreadcrumbs($category));
if (isset($tag))
	$this->setBreadcrumbsItems([$tag]);

?>

<?= $this->render('_index', ['dataProvider' => $dataProvider]); ?>