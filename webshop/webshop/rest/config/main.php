<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);
return [
    'id' => 'rest-api',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
        'v1' => [
            'class' => 'rest\versions\v1\RestModule',
        ]
    ],
    'components' => [
        'user' => [
            'class' => 'common\components\User',
            'identityClass' => 'common\models\User',
            'enableSession' => false,
            'loginUrl' => false,
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'response' => [
            'format' => yii\web\Response::FORMAT_JSON,
            'charset' => 'UTF-8',
        ],
        'request' => [
            'class' => '\yii\web\Request',
            'enableCookieValidation' => false,
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'pluralize' => false,
                    'controller' => ['v1/user'],
                    'except' => ['index', 'view', 'update', 'create', 'delete', 'options'],
                    'extraPatterns' =>[
                        'POST  login' => 'login',
                        'GET  details' => 'details',
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'pluralize' => false,
                    'controller' => ['v1/buy'],
                    'except' => ['index', 'view', 'update', 'create', 'delete', 'options'],
                    'extraPatterns' =>[
                        'GET  all-items' => 'all-items',
                        'GET  put-in-basket' => 'put-in-basket',
                        'GET  get-basket' => 'get-basket',
                    ],
                ],
            ],
        ],
    ],
    'params' => $params,
];