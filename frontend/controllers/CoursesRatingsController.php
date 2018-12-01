<?php

namespace frontend\controllers;

use common\models\Courses;
use Yii;
use common\models\CourseRating;
use frontend\models\search\CourseRating as CourseRatingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CoursesRatingsController implements the CRUD actions for CourseRating model.
 */
class CoursesRatingsController extends Controller
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
     * Lists all CourseRating models.
     * @return mixed
     */
    public function actionIndex()
    {

        $courses = Courses::find()->all();

        return $this->render('index', [
            'courses' => $courses,
        ]);
    }

    /**
     * Finds the CourseRating model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CourseRating the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CourseRating::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'A página requisitada não existe.'));
    }
}
