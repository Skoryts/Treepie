<?php

/** @var \app\components\View $this */
/** @var \app\models\Article $article */

use app\components\helpers\Category;
use yii\helpers\Html;

$this->pageTitle = $article->title;
$this->setTitle(array_merge([$article->title], Category::getTitle($article->category)));
$this->setBreadcrumbsItems(Category::getBreadcrumbs($article->category));
$this->setBreadcrumbsItem($this->pageTitle);

?>


<?= $this->render('/common/_breadcrumbs') ?>
<article class="single">
	<header>
		<time><?= (new DateTime($article->createdAt))->format('d/m/Y') ?></time>
		<h1>
			<?= $article->title ?>
		</h1>
		<?php if (!empty($article->tagsList)): ?>
			<div class="tags">
				<?php foreach ($article->tagsList as $tag): ?>
					<?= Html::a('#' . $tag, ['article/tag', 'tag' => $tag]) ?>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</header>
	<div class="content">
		<?= $article->body ?>
	</div>
	<?php if (false): ?>
		<footer>
			<div class="info m-b-40">
				<a href="" class="comments" title="Коментарі">3</a>

				<div class="votes">
					<span class="like" title="Подобається"></span>
					20
					<span class="dislike" title="Не подобається"></span>
				</div>
			</div>
			<div class="shared">
				<div>Поділитися з друзями</div>
				<div class="flex">
					<ul class="social">
						<li></li>
						<li></li>
						<li></li>
					</ul>
					<button class="favourite">Добавити у вибране</button>
				</div>
			</div>
		</footer>
	<?php endif; ?>
</article>
