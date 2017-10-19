<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru-RU', // <- здесь!
    'components' => [
        'sms' => [
            'class' => 'Zelenin\yii\extensions\Sms',
            'api_id' => '3BEFC0D0-A269-2331-263F-B8CF560899B6'
        ],
        'user' => [
            'identityClass' => 'budyaga\users\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['/login'],
        ],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'vkontakte' => [
                    'class' => 'budyaga\users\components\oauth\VKontakte',
                    'clientId' => '5630511',
                    'clientSecret' => 'TmzlAUpTTUMkUUMvOs5U',
                    'scope' => 'email'
                ],
                'facebook' => [
                    'class' => 'budyaga\users\components\oauth\Facebook',
                    'clientId' => 'XXX',
                    'clientSecret' => 'XXX',
                ],
                /*
            'google' => [
                'class' => 'budyaga\users\components\oauth\Google',
                'clientId' => 'XXX',
                'clientSecret' => 'XXX',
            ],

            'github' => [
                'class' => 'budyaga\users\components\oauth\GitHub',
                'clientId' => 'XXX',
                'clientSecret' => 'XXX',
                'scope' => 'user:email, user'
            ],
            'linkedin' => [
                'class' => 'budyaga\users\components\oauth\LinkedIn',
                'clientId' => 'XXX',
                'clientSecret' => 'XXX',
            ],
            'live' => [
                'class' => 'budyaga\users\components\oauth\Live',
                'clientId' => 'XXX',
                'clientSecret' => 'XXX',
            ],
            'yandex' => [
                'class' => 'budyaga\users\components\oauth\Yandex',
                'clientId' => 'XXX',
                'clientSecret' => 'XXX',
            ],
            'twitter' => [
                'class' => 'budyaga\users\components\oauth\Twitter',
                'consumerKey' => 'XXX',
                'consumerSecret' => 'XXX',
            ],*/
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                 '' => '',
                '/catalog'=>'/catalog/default/index',
                '/catalog/ajax/<action:\S+>' => '/catalog/ajax/<action>',
                '/catalog/<region:[-\w]+>/<city:[-\w]+>' => '/catalog/default/index',
                '/catalog/<region:[-\w]+>' => '/catalog/default/index',
                '/catalog/<region:[-\w]+>/<city:[-\w]+>/<object_name:\S+>_<id:\S+>' => '/catalog/default/object',
                '/investoram/'=>'/site/investoram',
                '/presse/'=>'/site/presse',
                'admin'=>'/admin/default',
                'admin/<page:\w+>'=>'/admin/default/<page>',
                '/signup' => '/user/user/signup',
                '/login' => '/user/user/login',
                '/logout' => '/user/user/logout',
                '/lc/profile' => '/user/user/profile',
                '/resetPassword' => '/user/user/reset-password',
                '/retryConfirmEmail' => '/user/user/retry-confirm-email',
                '/confirmEmail' => '/user/user/confirm-email',
                '/oauth/<authclient:[\w\-]+>' => '/user/auth/index',
                '/lc/'=>'/lc/default/index',
                '/lc/<page:\w+>'=>'/lc/default/<page>',
                '/page:\s+>'=>'/site/static',
                '/<page:\w+>'=>'/site/ftatic',

            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'assetManager' => [
            'linkAssets' => true,
            'appendTimestamp' => true,
        ],
        'request' => [
            'baseUrl' => '',
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'B0MXaGK1BDq3XP1BxCZ_bdedfEBcM3MP',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,//set this property to false to send mails to real email addresses
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'cms.iden@gmail.com',
                'password' => '8989898989g',
                'port' => 587,
                'encryption' => 'tls',
            ],
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
        'db' => require(__DIR__ . '/db.php'),

    ],
    'modules' => [
        'treemanager' =>  [
            'class' => '\kartik\tree\Module',
            // other module settings, refer detailed documentation
        ],
        'user' => [
            'class' => 'budyaga\users\Module',
            'userPhotoUrl' => '/images/user',
            'userPhotoPath' => '@app/web/images/user',
        ],
        'lc' => [
            'class' => 'app\modules\lc\Module',
        ],
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ],
        'uslugi' => [
            'class' => 'app\modules\uslugi\Module',
        ],
        'shop' => [
            'class' => 'app\modules\shop\Module',
        ],
        'page'   => [
            'class' => 'bariew\pageModule\Module'
        ],
        'regions' => [
            'class' => 'app\modules\regions\regions',
        ],
        'catalog' => [
            'class' => 'app\modules\catalog\Module',
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
