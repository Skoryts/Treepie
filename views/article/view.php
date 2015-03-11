<?php

use yii\helpers\Html;
use app\components\helpers\Category;

$this->pageTitle = $article->title;
$this->setTitle(array_merge([$article->title], Category::getTitle($article->category)));
$this->setBreadcrumbsItems(Category::getBreadcrumbs($article->category));
$this->setBreadcrumbsItem($this->pageTitle);

?>

<article class="article">
	<div class="article-path">
		<?= $this->render('/common/_breadcrumbs') ?>
	</div>
	<header class="article-header">
		<time><?= (new DateTime($article->createdAt))->format('d/m/Y') ?></time>
		<h1><?= $article->title ?></h1>
	</header>
	<div class="article-content">
		<?= $article->body ?>
	</div>
	<div class="article-footer">
		<div class="social-webs">
			<span><?= Yii::t('app', 'Share with friends') ?></span>
			<a href="" class="facebook"></a>
			<a href="" class="vk"></a>
			<a href="" class="twitter"></a>
		</div>
		<span class="add-to-bookmark"><?= Yii::t('app', 'Add to bookmarks') ?></span>
	</div>
</article>
<?= $this->render('/comment/_comments', ['article' => $article, 'comment' => $comment, 'comments' => $comments]) ?>