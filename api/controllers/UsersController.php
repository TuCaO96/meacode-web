<?php

namespace api\controllers;

use common\models\Users;
use common\models\UsersQuery;
use yii\filters\auth\CompositeAuth;
use yii\filters\ContentNegotiator;
use yii\filters\RateLimiter;
use yii\filters\VerbFilter;
use yii\rest\ActiveController;
use yii\web\Response;

class UsersController extends ActiveController
{
    public $modelClass = 'common\models\Users';

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
            ],
            'authenticator' => [
                'class' => CompositeAuth::className(),
            ],
            'rateLimiter' => [
                'class' => RateLimiter::className(),
            ],
        ];
    }

    public function actionGetUserByToken()
    {
        $token = \Yii::$app->request->get('token');
        $user = Users::findByToken($token);

        $response = \Yii::$app->response;
        $response->statusCode = 200;
        $response->format = Response::FORMAT_JSON;

        if($user == null){
            $response->statusCode = 404;
            $response->data = null;
            return $response;
        }

        $response->data = $user;

        return $response;
    }
    
}
