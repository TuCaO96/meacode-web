<?php

namespace api\controllers;

use common\models\ContentRating;
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

    public function actionRateContent()
    {
        $score = \Yii::$app->request->post('liked');
        $userId = \Yii::$app->request->post('user_id');
        $contentId = \Yii::$app->request->post('content_id');

        $contentRating = new ContentRating();
        $contentRating->content_id = $contentId;
        $contentRating->user_id = $userId;
        $contentRating->score = $score;

        if(!$contentRating->save()){
            $response = \Yii::$app->response;
            $response->data = [
                'error' => $contentRating->getErrors()
            ];
            $response->statusCode = 200;
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
