<?php

if ($_ENV['APP_ENV'] == 'local') {
    $db = [
        'class' => 'yii\db\Connection',
        'dsn' => "mysql:host={$_ENV['DB_HOST']};port={$_ENV['DB_PORT']};dbname={$_ENV['DB_DATABASE']}",
        'username' => $_ENV['DB_USERNAME'],
        'password' => $_ENV['DB_PASSWORD'],
        'charset' => 'utf8',
    ];
} else {
    if (session_status() == PHP_SESSION_NONE) {
       session_start();
    }

    $lang = Yii::$app->language ?? 'ua';

    $db = [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=localhost;dbname=firko198_bla_' . $lang,
        'username' => 'firko198_bla',
        'password' => 'NfAp)eM$9Ga(',
        'charset' => 'utf8',
    ];
}

return $db;