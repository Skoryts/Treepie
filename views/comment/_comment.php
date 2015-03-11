<li>
	<h4><?= $comment->user->username ?></h4>
	<time>
		<?php if ((\DateTime::createFromFormat('Y-m-d', $comment->updatedAt) === false)): ?>
			<?= (new DateTime())->format('Y-m-d') ?>
			<?php else: ?>
			<?= (new DateTime($comment->updatedAt))->format('Y-m-d') ?>
		<?php endif; ?>
	</time>
	<p><?= $comment->body; ?></p>
</li>