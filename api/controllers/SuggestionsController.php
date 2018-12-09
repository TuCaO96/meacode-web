<?php

namespace api\controllers;

use common\models\Suggestions;
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

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create']);
        return $actions;
    }

    public function actionCreate()
    {
        // implement here your code
        $email = \Yii::$app->request->post('email');
        $title = \Yii::$app->request->post('title');
        $text = \Yii::$app->request->post('text');
        $user_id = \Yii::$app->request->post('user_id');
        $created_at = time();
        $updated_at = time();

        $suggestion = new Suggestions();
        $suggestion->user_id = $user_id;
        $suggestion->title = $title;
        $suggestion->text = $text;
        $suggestion->email = $email;
        $suggestion->created_at = $created_at;
        $suggestion->updated_at = $updated_at;

        $response = \Yii::$app->response;

        if (!$suggestion->save()) {
            $response->data = [
                'errors' => $suggestion->getErrors()
            ];
            $response->format = Response::FORMAT_JSON;
            $response->statusCode = 422;

            return $response;
        }

        if (!is_null($email)) {
            \Yii::$app
                ->mailer
                ->compose(
                    ['html' => 'suggestion-html', 'text' => 'suggestion-text'],
                    ['title' => $title, 'message' => $text, 'email' => $email]
                )
                ->setFrom([\Yii::$app->params['supportEmail'] => 'Equipe Me Acode'])
                ->setTo($email)
                ->setSubject('Recebemos sua sugestão!')
                ->send();
        }

        $response->data = [
            'suggestion' => $suggestion
        ];
        $response->format = Response::FORMAT_JSON;
        $response->statusCode = 201;

        return $response;
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
            ->setFrom([\Yii::$app->params['supportEmail'] => 'Equipe Me Acode'])
            ->setTo($email)
            ->setSubject('Respondemos sua sugestão!')
            ->send();
    }

}
