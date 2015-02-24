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

	//todo: add search by query action [@tooleks]

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
		return $this->render('view', [
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