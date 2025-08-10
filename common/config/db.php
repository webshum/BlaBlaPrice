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
    if ($_ENV['DB_ENV'] === 'local') {
        $db = [
            'class' => 'yii\db\Connection',
            'dsn' => "mysql:host={$_ENV['DB_HOST']};port={$_ENV['DB_PORT']};dbname={$_ENV['DB_DATABASE']}",
            'username' => $_ENV['DB_USERNAME'],
            'password' => $_ENV['DB_PASSWORD'],
            'charset' => 'utf8',
        ];
    } else {
        $db = [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=firko198_bla_' . $_SESSION['language'],
            'username' => 'firko198_bla',
            'password' => 'NfAp)eM$9Ga(',
            'charset' => 'utf8',
        ];
    }
}

return $db;