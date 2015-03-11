<?php

use app\components\helpers\Category;

$this->pageTitle = Yii::t('app', 'Articles');
if (isset($tag))
	$this->pageTitle = Yii::t('app', 'Articles by tag:') . ' ' . $tag;

$this->setTitle((isset($category)) ? [$category->name, $this->pageTitle] : [$this->pageTitle]);
$this->setBreadcrumbsItem(['label' => $this->pageTitle, 'url' => '/article']);
if (isset($category))
	$this->setBreadcrumbsItems(Category::getBreadcrumbs($category));
if (isset($tag))
	$this->setBreadcrumbsItems([$tag]);

?>

<?= $this->render('_index', ['dataProvider' => $dataProvider]); ?>