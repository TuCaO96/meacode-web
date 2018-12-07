<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'api\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\Users',
            'enableAutoLogin' => false,
            'enableSession' => false,
            'loginUrl' => false
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'users',
                    'extraPatterns' => [
                        'GET token/{token}' => 'get-user-by-token'
                    ],
                    'tokens' => [
                        '{id}' => '<id:\\w+>',
                        '{token}' => '<token>'
                    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'users-search',
                    'extraPatterns' => [
                        'POST query' => 'post-user-search-result'
                    ],
                    'pluralize' => false
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'courses',
                    'extraPatterns' => [
                        'POST rate' => 'rate-course',
                        'GET {id}/categories/{extra}' => 'get-by-category',
                        'GET {id}/rating/{extra}' => 'is-rated'
                    ],
                    'tokens' => [
                        '{id}' => '<id:\\w+>',
                        '{extra}' => '<extra:\\w+>'
                    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'suggestions',
                    'tokens' => [
                        '{id}' => '<id:\\w+>'
                    ],
                    'extraPatterns' => [
                        'POST send_reply' => 'send-reply'
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'categories',
                    'tokens' => [
                        '{id}' => '<id:\\w+>'
                    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'contents',
                    'extraPatterns' => [
                        'POST rate' => 'rate-content',
                        'GET {id}/rating/{extra}' => 'is-rated'
                    ],
                    'tokens' => [
                        '{id}' => '<id:\\w+>',
                        '{extra}' => '<extra:\\w+>'
                    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'auth',
                    'pluralize' => false,
                    'extraPatterns' => [
                        'POST login' => 'login',
                        'POST social_login' => 'social-login',
                        'POST mobile' => 'authenticate-mobile',
                        'POST signup' => 'signup'
                    ]
                ]
            ],
        ]
    ],
    'params' => $params,
];