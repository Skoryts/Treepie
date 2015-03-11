<?php

namespace app\controllers;

use app\models\Comment;
use Yii;
use app\components\Controller;
use yii\filters\VerbFilter;

/**
 * CommentController implements the CRUD actions for Article model.
 */
class CommentController extends Controller
{
	public function behaviors()
	{
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'add' => ['post'],
				],
			],
		];
	}

	public function actionAdd()
	{
		$comment = new Comment();

		if ($comment->load(Yii::$app->request->post()) && $comment->save()) {
			return $this->renderAjax('_comment', ['comment' => $comment]);
		}

		//todo: add error handler [@tooleks]
		return 1;
	}
}