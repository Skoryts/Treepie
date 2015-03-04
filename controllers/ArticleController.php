<?php

namespace app\controllers;

use app\models\Category;
use Yii;
use app\models\Article;
use app\models\search\ArticleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
{
	public function behaviors()
	{
		//todo: add rbac access rules [@tooleks]
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['post'],
				],
			],
		];
	}

	//todo: add search by tag action [@tooleks]\

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
		return $this->render('_view', [
			'model' => $this->findModelBySlug(Article::className(), $slug),
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