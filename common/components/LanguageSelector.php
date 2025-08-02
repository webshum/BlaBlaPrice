<?php

namespace common\components;

use Yii;
use yii\base\BootstrapInterface;

class LanguageSelector implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $session = Yii::$app->session;
        if (!$session->isActive) {
            $session->open();
        }

        $availableLanguages = is_array(Yii::$app->params['lang']) ? array_keys(Yii::$app->params['lang']) : [];

        $lang = Yii::$app->request->get('lang');

        if ($lang && in_array($lang, $availableLanguages)) {
            $session->set('language', $lang);
        }

        Yii::$app->language = $session->get('language', $_ENV['APP_LANG'] ?? 'en-US');
    }
}

