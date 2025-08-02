<?php
define('THEME', $_ENV['APP_THEME']);

Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');
Yii::setAlias('@appTheme', dirname(dirname(__DIR__)) . '/frontend/themes/' . THEME);
Yii::setAlias('@webTheme', dirname(dirname(__DIR__)) . '/frontend/' . THEME);