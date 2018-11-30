<?php

namespace api\controllers;

use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\ContentNegotiator;
use yii\filters\RateLimiter;
use yii\filters\VerbFilter;
use yii\rest\ActiveController;
use yii\web\Response;

class SuggestionsController extends ActiveController
{
    public $modelClass = 'common\models\Suggestions';

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

    public function actionSendReply()
    {
        $email = \Yii::$app->request->post('email');
        $message = \Yii::$app->request->post('message');
        $suggestion_text = \Yii::$app->request->post('suggestion_text');

        return \Yii::$app
            ->mailer
            ->compose(
                ['html' => 'replySuggestion-html', 'text' => 'replySuggestion-text'],
                ['suggestion_text' => $suggestion_text, 'message' => $message, 'email' => $email]
            )
            ->setFrom([\Yii::$app->params['supportEmail'] => 'Sistema Me Acode'])
            ->setTo($email)
            ->setSubject('Respondemos sua sugestão de conteúdo!')
            ->send();
    }
    
}
