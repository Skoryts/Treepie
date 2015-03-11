<div class="comments">
	<h2><?= Yii::t('app', 'Comments') ?></h2>
	<ul>
		<?php foreach ($comments as $comment): ?>
			<?= $this->render('_comment', ['comment' => $comment]); ?>
		<?php endforeach; ?>
	</ul>
	<?= $this->render('_commentForm', ['article' => $article, 'comment' => $comment]) ?>
</div>