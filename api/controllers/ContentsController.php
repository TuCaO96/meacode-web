<?php

namespace api\controllers;

use common\models\ContentRating;
use common\models\CourseRating;
use common\models\Courses;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\ContentNegotiator;
use yii\filters\RateLimiter;
use yii\filters\VerbFilter;
use yii\rest\ActiveController;
use yii\web\Response;

class ContentsController extends ActiveController
{
    public $modelClass = 'common\models\Contents';

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

    public function actionIsRated()
    {
        $user_id = \Yii::$app->request->get('extra');
        $content_id = \Yii::$app->request->get('id');

        $content_rating = ContentRating::find()->where(['content_id' => $content_id, 'user_id' => $user_id])->one();
        if ($content_rating !== null) {
            $course_id = $content_rating->getContent()->one()->getCourse()->one()->id;
            $course_rating = CourseRating::find()->where(['course_id' => $course_id, 'user_id' => $user_id])->one();
        } else {
            $course_rating = null;
        }

        $response = \Yii::$app->response;
        $response->statusCode = 200;
        $response->data = [
            'contentRating' => $content_rating,
            'courseRating' => $course_rating
        ];
        $response->format = Response::FORMAT_JSON;

        return $response;
    }

    public function actionRateContent()
    {
        $score = \Yii::$app->request->post('liked');
        $userId = \Yii::$app->request->post('user_id');
        $contentId = \Yii::$app->request->post('content_id');

        $contentRating = new ContentRating();
        $contentRating->content_id = $contentId;
        $contentRating->user_id = $userId;
        $contentRating->score = $score;
        $contentRating->updated_at = time();
        $contentRating->created_at = time();

        $contentQuery = ContentRating::find()->where(['content_id' => $contentId, 'user_id' => $userId])->one();

        $response = \Yii::$app->response;

        if (!is_null($contentQuery)) {
            $contentQuery->score = $score;
            $contentQuery->save();

            $response->data = [
                'content' => $contentQuery->getContent()->one()
            ];

            return $response;
        }

        if(!$contentRating->save()){
            $response->data = [
                'error' => $contentRating->getErrors()
            ];
            $response->statusCode = 422;
            $response->format = Response::FORMAT_JSON;

            return $response;
        }

        $response = \Yii::$app->response;
        $response->data = [
            'content' => $contentRating->getContent()->one()
        ];
        $response->statusCode = 200;
        $response->format = Response::FORMAT_JSON;


        return $response;
    }
    
}
