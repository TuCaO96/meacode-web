<?php

namespace api\controllers;

use common\models\CourseRating;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\CourseNegotiator;
use yii\filters\RateLimiter;
use yii\filters\VerbFilter;
use yii\rest\ActiveController;
use yii\web\Response;

class CoursesController extends ActiveController
{
    public $modelClass = 'common\models\Courses';

    public function behaviors()
    {
        return [
            'contentNegotiator' => [
                'class' => CourseNegotiator::className(),
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
            'verbFilter' => [
                'class' => VerbFilter::className(),
                'actions' => $this->verbs(),
            ],/*
            'authenticator' => [
                'class' => HttpBearerAuth::className(),
            ],*/
            'rateLimiter' => [
                'class' => RateLimiter::className(),
            ],
        ];
    }

    public function actionRateCourse()
    {
        $score = \Yii::$app->request->post('liked') ? 5 : 1;
        $userId = \Yii::$app->request->post('user_id');
        $courseId = \Yii::$app->request->post('course_id');

        $contentRating = new CourseRating();
        $contentRating->course_id = $courseId;
        $contentRating->user_id = $userId;
        $contentRating->score = $score;
        $contentRating->save();
    }

}
