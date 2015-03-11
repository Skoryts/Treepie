<?php

namespace app\controllers;

use app\models\Category;
use app\models\Comment;
use Yii;
use app\models\Article;
use app\models\search\ArticleSearch;
use app\components\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
{
	public function actionTag($tag)
	{
		$searchModel = new ArticleSearch();
		$dataProvider = $searchModel->searchByTag($tag);

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
			'tag' => $tag,
		]);
	}

	public function actionSearch($query)
	{
		$searchModel = new ArticleSearch();
		$dataProvider = $searchModel->searchByQuery($query);

		return $this->renderPartial('_index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	public function actionIndex($slug = null)
	{
		if (empty($slug)) {
			$category = null;
		} else {
			$category = $this->findModelBySlug(Category::className(), $slug);
		}

		$searchModel = new ArticleSearch();
		$dataProvider = $searchModel->searchByCategory($category);

		return $this->render('index', [
			'category' => $category,
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	public function actionView($slug)
	{
		$article = $this->findModelBySlug(Article::className(), $slug);
		$comment = new Comment();
		$comment->articleId = $article->id;
		$comments = Comment::findByArticleId($article->id);

		return $this->render('view', [
			'article' => $article,
			'comment' => $comment,
			'comments' => $comments,
		]);
	}

	protected function findModelBySlug($model, $slug)
	{
		if (($model = $model::findOne(['slug' => $slug])) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}