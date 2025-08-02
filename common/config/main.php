<?php

return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'aliases' => [
        '@frontend_url' => $_ENV['APP_URL'] ?? 'http://localhost',
    ],
    'bootstrap' => ['log', 'languageSelector'],
    'components' => [
        'languageSelector' => [
            'class' => \common\components\LanguageSelector::class,
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                    'forceTranslation' => true,
                    'fileMap' => [
                        'app' => 'app.php',
                    ],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => $_ENV['MAIL_HOST'],
                'username' => $_ENV['MAIL_USERNAME'],
                'password' => $_ENV['MAIL_PASSWORD'],
                'port' => $_ENV['MAIL_PORT'],
                'encryption' => $_ENV['MAIL_ENCRYPTION'],
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'google' => [
                    'class' => 'yii\authclient\clients\GoogleOAuth',
                    'clientId' => $_ENV['GOOGLE_CLIENT_ID'],
                    'clientSecret' => $_ENV['GOOGLE_CLIENT_SECRET'],
                    'returnUrl' => $_ENV['GOOGLE_REDIRECT_URL']
                ],
                'facebook' => [
                    'class' => 'yii\authclient\clients\Facebook',
                    'clientId' => $_ENV['FACEBOOK_CLIENT_ID'],
                    'clientSecret' => $_ENV['FACEBOOK_CLIENT_SECRET'],
                    'returnUrl' => $_ENV['FACEBOOK_REDIRECT_URL']
                ],
                'instagram' => [
                    'class' => 'yii\authclient\clients\Instagram',
                    'clientId' => $_ENV['INSTAGRAM_CLIENT_ID'],
                    'clientSecret' => $_ENV['INSTAGRAM_CLIENT_SECRET'],
                    'returnUrl' => $_ENV['INSTAGRAM_REDIRECT_URL']
                ],
            ],
        ],
    ]
];
