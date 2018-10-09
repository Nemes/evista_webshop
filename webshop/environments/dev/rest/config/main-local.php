<?php
$config = [
    'components' => [
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
        ],
/*
        'urlManagerBackend' => [
            'class' => 'yii\web\UrlManager',
            'baseUrl' => 'http://localhost:8081',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false
        ],
*/
    ],
];

if (!YII_ENV_TEST) {
	$config['modules']['debug'] = 'yii\debug\Module';
}

return $config;
