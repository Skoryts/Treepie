<?php

/** @var \app\models\Article $model */

use yii\helpers\Html;
use yii\helpers\Url;

?>

<article>
	<header>
		<time><?= (new DateTime($model->createdAt))->format('d/m/Y') ?></time>
		<h2>
			<a href="<?= Url::to(['/article/view', 'slug' => $model->slug]) ?>">
				<?= $model->title ?>
			</a>
		</h2>
		<?php if (!empty($model->tagsList)): ?>
			<div class="tags">
				<?php foreach ($model->tagsList as $tag): ?>
					<?= Html::a('#' . $tag, ['article/tag', 'tag' => $tag]) ?>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</header>
	<div class="content">
		<?= Html::img($model->files[0]->relativePath, [
			'alt' => $model->title,
			'style' => 'max-width: 100%;',
		]) ?>
	</div>
	<footer>
		<a href="<?= Url::to(['/article/view', 'slug' => $model->slug]) ?>"
		   class="btn"><?= Yii::t('app', 'Read More') ?></a>
		<?php if (false): ?>
			<div class="info">
				<a href="" class="comments" title="<?= Yii::t('app', 'Comments') ?>">3</a>

				<div class="votes">
					<span class="like" title="<?= Yii::t('app', 'Like') ?>"></span>
					20
					<span class="dislike" title="<?= Yii::t('app', 'Unlike') ?>"></span>
				</div>
			</div>
		<?php endif; ?>
	</footer>
</article>
