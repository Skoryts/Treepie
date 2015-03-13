<?php

namespace app\modules\admin\controllers;

use app\models\Article;
use app\models\Category;
use app\models\File;
use Yii;
use yii\web\Controller;

class MainController extends Controller
{
	public function actionIndex()
	{
		$params['articlesNumber'] = Article::find()
			->where([
				'published' => Article::OPTION_PUBLISHED,
				'draft' => Article::OPTION_NOT_DRAFT,
			])
			->count();

		$params['categoriesNumber'] = Category::find()
			->count();

		$params['filesNumber'] = File::find()
			->count();

		return $this->render('index', ['params' => $params]);
	}
}