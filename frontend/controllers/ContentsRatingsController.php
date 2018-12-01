<?php

namespace frontend\controllers;

use Yii;
use common\models\ContentRating;
use frontend\models\search\ContentRating as ContentRatingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ContentsRatingsController implements the CRUD actions for ContentRating model.
 */
class ContentsRatingsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all ContentRating models.
     * @return mixed
     */
    public function actionIndex()
    {

        $ratings = ContentRating::find()->select(['contents.title AS rating_title, avg(score) AS rating',])
            ->join('JOIN', 'contents', 'contents.id = content_id')
            ->groupBy('content_id')
            ->orderBy(['avg(score)' => SORT_DESC])
            ->all();

        return $this->render('index', [
            'ratings' => $ratings,
        ]);
    }

    /**
     * Finds the ContentRating model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ContentRating the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ContentRating::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'A página requisitada não existe.'));
    }
}
