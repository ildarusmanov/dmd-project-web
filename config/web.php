<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru-RU',
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Admin',
        ],
        'profile' => [
            'class' => 'app\modules\profile\Profile',
        ],
        'payment' => [
            'class' => 'app\modules\payment\Payment'
        ],
        'shop' => [
            'class' => 'app\modules\shop\Shop'
        ],
        'redactor' => [
             'class' => 'yii\redactor\RedactorModule',
        ],
    ],
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\PhpManager',
            'defaultRoles' => ['user','manager','admin'], //здесь прописываем роли
            'itemFile' => '@app/components/rbac/items.php',
            'assignmentFile' => '@app/components/rbac/assignments.php',
            'ruleFile' => '@app/components/rbac/rules.php'
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    //'basePath' => '@app/messages',
                    //'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/error' => 'error.php',
                    ],
                ],
            ],
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'BBrnpbeT0KcmZtiJTfJmjm6Zdncvnlpj',
        ],
        //'cache' => [
        //    'class' => 'yii\caching\FileCache',
        //],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['/session'],
        ],

        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'swift_mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
            /*
            'transport' => [
              'class' => 'Swift_SmtpTransport',
              'host' => 'localhost',  // e.g. smtp.mandrillapp.com or smtp.gmail.com
              'username' => 'username',
              'password' => 'password',
              'port' => '587', // Port 25 is a very common port too
              'encryption' => 'tls', // It is often used, check your provider or mail server specs
            ],*/
        ],

        'mailer' => [
            'class' => 'app\components\wajox_software\Mailer',
            'from' => 'support@example.com'
        ],

        'system_payment_settings' => [
            'class' => 'app\components\shop\SystemPaymentSettings',
            'settings' => [
                'RbkMoneyPayments' => [],
                'RobokassaPayments' => [],
                'ZPaymentPayments' => [],
                'EAutopayPayments' => [],
                'InterkassaPayments' => [],
                'PaypalPayments' => [],
                'YandexPayments' => [],
            ]
        ],

        'system_delivery_settings' => [
            'class' => 'app\components\shop\SystemDeliverySettings',
            'settings' => [
                'EmailDelivery' => [],
                'EAutopayDelivery' => []
            ]
        ],

        'bill_event_handler' => [
            'class' => 'app\components\events\handlers\BillEventHandler'
        ],

        'order_event_handler' => [
            'class' => 'app\components\events\handlers\OrderEventHandler'
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
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
