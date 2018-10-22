<?php

namespace api\controllers;

use common\models\UserSearches;
use common\models\Contents;
use common\models\Users;
use common\models\UsersQuery;
use frontend\models\search\Courses;
use yii\filters\auth\CompositeAuth;
use yii\filters\ContentNegotiator;
use yii\filters\RateLimiter;
use yii\filters\VerbFilter;
use yii\rest\ActiveController;
use yii\web\Response;

class UsersSearchController extends ActiveController
{
    public $modelClass = 'common\models\UserSearches';

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

    public function actionPostUserSearchResult()
    {
        $user_id = \Yii::$app->request->post('user_id');
        $query = \Yii::$app->request->post('query');

        $response = \Yii::$app->response;
        $response->statusCode = 200;
        $response->format = Response::FORMAT_JSON;

        $user_search = new UserSearches();
        $user_search->user_id = $user_id;
        $user_search->search_query = $query;
        $user_search->created_at = time();

        if(!$user_search->save()){
            $response->statusCode = 422;
            $response->data = null;

            return $response;
        }

        $courses = Courses::find()
            ->where('name LIKE :query', [':query' => '%'.$query.'%'])
            ->all();

        $contents = Contents::find()
            ->where('title LIKE :query', [':query' =>'%'.$query.'%'])
            ->orWhere('text LIKE :query', [':query' =>'%'.$query.'%'])
            ->all();

        $response->data = [
            'courses' => $courses,
            'contents' => $contents
        ];

        return $response;
    }

}
