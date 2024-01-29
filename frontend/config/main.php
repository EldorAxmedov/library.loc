<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl'=>'',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'authClientCollection' => [
            'class'   => 'yii\authclient\Collection',
            'clients' => [
                'hemis'          => [
                    'class'          => frontend\components\Hemis::class,
                    'authUrl'        => 'https://student.samdchti.uz/oauth/authorize',
                    'tokenUrl'       => 'https://student.samdchti.uz/oauth/access-token',
                    'apiBaseUrl'     => 'https://student.samdchti.uz/oauth/api',
                    'returnUrl'      => 'https://library.samdchti.uz/site/auth?authclient=hemis',
                    'name'           => 'HEMIS Student',
                    'scope'          => 'public_profile',
                    'attributeNames' => ['id', 'login', 'name', 'email', 'picture', 'type', 'groups'],
                    'clientId'       => 6,
                    'clientSecret'   => 'zHywbRvQXiiUv57lAolcpx1FVhX7UZ0YZqwj5_cQ',
                ],
                'employee'      =>  [
                    'class'          => frontend\components\Employee::class,
                    'authUrl'        => 'https://hemis.samdchti.uz/oauth/authorize',
                    'tokenUrl'       => 'https://hemis.samdchti.uz/oauth/access-token',
                    'apiBaseUrl'     => 'https://hemis.samdchti.uz/oauth/api',
                    'returnUrl'      => 'https://library.samdchti.uz/site/auth?authclient=employee',
                    'name'           => 'HEMIS Xodimlar',
                    'scope'          => 'public_profile',
                    'attributeNames' => ['id', 'email'],
                    'clientId'       => 5,
                    'clientSecret'   => '1rGDc5lCSNtiO-xToPZ57M95iA4aeJSg4hT1tb4J',
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',           
        ],
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        
    ],
    'params' => $params,
];
