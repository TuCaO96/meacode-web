<?php

namespace api\controllers;

use common\models\ContentRating;
use common\models\ContentRatingQuery;
use common\models\CourseRating;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\ContentNegotiator;
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
                'class' => ContentNegotiator::className(),
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
        $score = \Yii::$app->request->post('liked');
        $userId = \Yii::$app->request->post('user_id');
        $courseId = \Yii::$app->request->post('course_id');

        $contentRating = new CourseRating();
        $contentRating->course_id = $courseId;
        $contentRating->user_id = $userId;
        $contentRating->score = $score;
        $contentRating->updated_at = time();
        $contentRating->created_at = time();

        $contentQuery = CourseRating::where(['course_id' => $courseId, 'user_id' => $userId])->one();

        $response = \Yii::$app->response;

        if (!is_null($contentQuery)) {
            $response->data = [
                'content' => $contentQuery->getCourse()->one()
            ];

            return $response;
        }

        if(!$contentRating->save()){

            $response->data = [
                'error' => $contentRating->getErrors()
            ];
            $response->statusCode = 200;
            $response->format = Response::FORMAT_JSON;

            return $response;
        }

        $response = \Yii::$app->response;
        $response->data = [
            'content' => $contentRating->getCourse()->one()
        ];
        $response->statusCode = 200;
        $response->format = Response::FORMAT_JSON;

        return $response;
    }

}
