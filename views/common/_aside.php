<aside>
	<?php $articles = \app\models\Article::getTopArticles() ?>
	<?php if (!empty($articles)): ?>
		<div class="aside-title"><?= Yii::t('app', 'Most Popular Articles') ?></div>
		<?php foreach ($articles as $article): ?>
			<article class="popular">
				<header>
					<time><?= (new \DateTime($article->createdAt))->format('d/m/Y') ?></time>
					<h3>
						<a href="<?= \yii\helpers\Url::to(['/article/view', 'slug' => $article->slug]) ?>">
							<?= $article->title ?>
						</a>
					</h3>
				</header>
			</article>
		<?php endforeach; ?>
	<?php endif; ?>
	<div class="info"></div>
	<div class="info m-b-40"></div>
	<?php $articles = \app\models\Article::getWorthArticles() ?>
	<?php if (!empty($articles)): ?>
		<div class="aside-title"><?= Yii::t('app', 'It Should Be Read') ?></div>
		<?php foreach ($articles as $article): ?>
			<article class="popular">
				<header>
					<time><?= (new \DateTime($article->createdAt))->format('d/m/Y') ?></time>
					<h3>
						<a href="<?= \yii\helpers\Url::to(['/article/view', 'slug' => $article->slug]) ?>">
							<?= $article->title ?>
						</a>
					</h3>
				</header>
			</article>
		<?php endforeach; ?>
	<?php endif; ?>
	<div class="info"></div>
</aside>
