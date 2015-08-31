<?php

/** @var \app\components\View $this */

use app\components\helpers\Category;

if (isset($tag)) {
	$this->pageTitle = Yii::t('app', 'Articles by tag:') . ' ' . $tag;
} else {
	$this->pageTitle = Yii::t('app', 'Articles');
}

$this->setTitle((isset($category)) ? [$category->name, $this->pageTitle] : [$this->pageTitle]);
$this->setBreadcrumbsItem(['label' => $this->pageTitle, 'url' => '/article']);
if (isset($category)) {
	$this->setBreadcrumbsItems(Category::getBreadcrumbs($category));
}
if (isset($tag)) {
	$this->setBreadcrumbsItems([$tag]);
}

?>

<?= $this->render('_index', ['dataProvider' => $dataProvider]); ?>

