<?php

use yii\helpers\Html;

?>

<article>
	<header>
		<h2><?= Html::a($model->title, ['/article/view', 'slug' => $model->slug], ['class' => 'button']) ?></h2>
	</header>
	<div class="article-content">
		<?php if (!empty($model->files)): ?>
			<?= Html::img($model->files[0]->relativePath, ['alt' => '']) ?>
		<?php endif; ?>
		<time><?= (new DateTime($model->createdAt))->format('d/m/Y') ?></time>
		<?php //todo: replace with real article comments link [@tooleks] ?>
		<a href="" class="comment">3</a>
		<?php //todo: replace with real article like link [@tooleks] ?>
		<a href="" class="like">20</a>

		<p><?= $model->body ?></p>
	</div>
	<?php if (!empty($model->tagsList)): ?>
		<footer>
			<ul class="article-tags">
				<?php foreach ($model->tagsList as $tag): ?>
					<li><?= Html::a('#' . $tag, ['article/tag', 'tag' => $tag]) ?></li>
				<?php endforeach; ?>
			</ul>
		</footer>
	<?php endif; ?>
</article>