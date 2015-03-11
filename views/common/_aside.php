<?php //todo: remove this fucking condition hardcode (frontend) [@tooleks] ?>
<?php if (Yii::$app->controller->id != 'article' || Yii::$app->controller->action->id != 'view'): ?>
	<aside>
		<?php $topArticles = \app\models\Article::getTopArticles(); ?>
		<?php if (!empty($topArticles)): ?>
			<div class="top-article">
				<div class="title"><?= Yii::t('app', 'Most Popular Articles') ?></div>
				<?php foreach ($topArticles as $article): ?>
					<article>
						<header>
							<time><?= (new \DateTime($article->createdAt))->format('d/m/Y') ?></time>
							<h2>
								<a href="<?= \yii\helpers\Url::to(['/article/view', 'slug' => $article->slug]) ?>"><?= $article->title ?></a>
							</h2>
						</header>
					</article>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
		<div class="advertising">
			<a href=""><img src="./img/advertising.png" alt=""></a>
			<a href=""><img src="./img/advertising.png" alt=""></a>
			<a href=""><img src="./img/advertising.png" alt=""></a>
			<a href=""><img src="./img/advertising.png" alt=""></a>
		</div>
		<?php $worthArticles = \app\models\Article::getWorthArticles() ?>
		<?php if (!empty($worthArticles)): ?>
			<div class="worth-article">
				<div class="title"><?= Yii::t('app', 'It should read') ?></div>
				<?php foreach ($worthArticles as $article): ?>
					<article class="cf">
						<?php if (!empty($article->files)): ?>
							<?= \yii\helpers\Html::img($article->files[0]->relativePath, ['alt' => '']) ?>
						<?php endif; ?>
						<header>
							<time><?= (new \DateTime($article->createdAt))->format('d/m/Y') ?></time>
							<h3>
								<a href="<?= \yii\helpers\Url::to(['/article/view', 'slug' => $article->slug]) ?>"><?= $article->title ?></a>
							</h3>
							<a href="<?= \yii\helpers\Url::to(['/article/view', 'slug' => $article->slug]) ?>"
							   class="read-btn"><?= Yii::t('app', 'read') ?></a>
						</header>
					</article>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</aside>
<?php endif; ?>