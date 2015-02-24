<?php

namespace app\modules\admin\controllers;

use app\components\helpers\Constant;
use app\models\File;
use app\models\RelationType;
use app\models\search\FileSearch;
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
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = Article::findDraft(Yii::$app->user->id);

        if (empty($model)) {
            $model = new Article();
            $model->save(false);
        }

        return $this->redirect(['update', 'id' => $model->id]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->setScenario(Article::SCENARIO_UPDATE);

        $fileSearchModel = new FileSearch();
        $fileDataProvider = $fileSearchModel->search(array_merge(
            Yii::$app->request->queryParams,
            [
                'FileSearch' => [
                    'relationTypeId' => RelationType::getRelationIdByName($model::className()),
                    'relationId' => $model->id,
                ],
            ]
        ));

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			Yii::$app->getSession()->addFlash(Constant::FLASH_MESSAGE_TYPE_SUCCESS, 'Article was successfully saved.');
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'fileSearchModel' => $fileSearchModel,
                'fileDataProvider' => $fileDataProvider
            ]);
        }
    }

    public function actionDeleteFile($id, $fileId)
    {
        $file = File::find()
            ->where(['id' => $fileId])
            ->one();

        if (!empty($file)) {
            $file->delete();
        }

        if (Yii::$app->getRequest()->isAjax) {
            $model = $this->findModel($id);
            $fileSearchModel = new FileSearch();
            $fileDataProvider = $fileSearchModel->search(array_merge(
                Yii::$app->request->queryParams,
                [
                    'FileSearch' => [
                        'relationTypeId' => RelationType::getRelationIdByName($model::className()),
                        'relationId' => $model->id,
                    ],
                ]
            ));

            return $this->renderPartial('_fileGrid', [
                'fileSearchModel' => $fileSearchModel,
                'fileDataProvider' => $fileDataProvider
            ]);
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}