<?php if (Yii::$app->user->isGuest): ?>
	<?= Yii::t('app', 'Sign In to leave comment.') ?>
<?php else: ?>
	<?php $form = \yii\widgets\ActiveForm::begin(
		[
			'id' => 'comment-form',
			'enableClientValidation' => true,
			'options' => [
				'validateOnSubmit' => true,
			],
			'fieldConfig' => [
				'template' => '{input}' . PHP_EOL . '{error}',
			],
			'action' => \yii\helpers\Url::to(['/comment/add']),
		]
	); ?>

	<?= $form->field($comment, 'articleId')->hiddenInput(); ?>

	<?= $form->field($comment, 'body')->textarea() ?>

	<?= \yii\helpers\Html::submitButton(Yii::t('app', 'Send'), ['class' => 'blue']) ?>

	<?php \yii\widgets\ActiveForm::end(); ?>
<?php endif;