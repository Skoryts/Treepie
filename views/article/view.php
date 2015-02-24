<?php

use yii\helpers\Html;

?>

<article class="article">
	<?php //todo: add image link [@tooleks] ?>
	<img src="" alt="">
	<header class="article-header">
		<time><?= (new DateTime($model->createdAt))->format('d/m/Y') ?></time>
		<h2><?= Html::a($model->title, ['/article/view', 'slug' => $model->slug]) ?></h2>
	</header>
	<div class="article-content">
		<p>
			<?= $model->body ?>
		</p>
		<ul class="article-tags">
			<li><a href="">#webdesign</a></li>
		</ul>
	</div>
	<?= Html::a(Yii::t('app', 'read more'), ['/article/view', 'slug' => $model->slug], ['class' => 'button']) ?>
</article>