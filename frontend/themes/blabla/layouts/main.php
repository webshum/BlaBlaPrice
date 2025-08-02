<?php

/* @var $this \yii\web\View */

/* @var $content string */

use frontend\assets\AppAsset;
use yii\helpers\Html;
use frontend\models\SignupForm;
use yii\widgets\ActiveForm;

// Мета-теги Open Graph (Facebook та інші)
$this->registerMetaTag([
    'property' => 'og:title', 
    'content' => Yii::t('app', 'Сервіс BlaBlaPrice.com')
], 'og:title');

$this->registerMetaTag([
    'property' => 'og:description', 
    'content' => Yii::t('app', 'Опис сервісу BlaBlaPrice.com')
], 'og:description');

$this->registerMetaTag([
    'property' => 'og:image', 
    'content' => Yii::getAlias('@frontend_url') . '/' . THEME . '/img/share-image.jpg'
], 'og:image');

$this->registerMetaTag([
    'property' => 'og:url', 
    'content' => Yii::getAlias('@frontend_url')
], 'og:url');

$this->registerMetaTag([
    'property' => 'og:type', 
    'content' => 'website'
], 'og:type');

// Мета-теги Twitter Cards
$this->registerMetaTag([
    'name' => 'twitter:card', 
    'content' => 'summary_large_image'
], 'twitter:card');

$this->registerMetaTag([
    'name' => 'twitter:title', 
    'content' => Yii::t('app', 'Сервіс BlaBlaPrice.com')
], 'twitter:title');

$this->registerMetaTag([
    'name' => 'twitter:description', 
    'content' => Yii::t('app', 'Опис сервісу BlaBlaPrice.com')
], 'twitter:description');

$this->registerMetaTag([
    'name' => 'twitter:image', 
    'content' => Yii::getAlias('@frontend_url') . '/' . THEME . '/img/share-image.jpg'
], 'twitter:image');

$user = Yii::$app->user->identity;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="viewport"
          content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no, minimal-ui"/>

    <title><?= Html::encode($this->title) ?></title>

    <?= Html::csrfMetaTags() ?>
    <?php $this->head(); ?>
    <script>
        window.phonemask = "<?= Yii::$app->language ?>".toUpperCase();
    </script>
</head>
<body>
    <?php $this->beginBody() ?>
    <?php $flash = Yii::$app->session->getAllFlashes(); if (!empty($flash)) : ?>
        <?php 
            $message = [];

            foreach ($flash as $errorName => $errorMessage) {
                if ($errorName == 'success') {
                    $message['type'] = 'success';
                } else {
                    $message['type'] = 'error';
                }

                if (is_array($errorMessage) && isset($errorMessage['0'])) {
                    $message['message'] .= $errorMessage['0'] . PHP_EOL;
                } else {
                    $message['message'] .= $errorMessage . PHP_EOL;
                }
            }
        ?>
        <div class="popup-wrapper active">
            <div class="close-layer"></div>
            <div class="popup-content popup-message active">
                <div class="popup-container">
                    <a class="close-popup-all">
                        <svg width="12" height="12"><use xlink:href="#close-layer"></use></svg>
                    </a>

                    <div class="middle">
                        <?php if ($message['type'] == 'error') : ?>
                            <div class="popup-title">
                                <?= Yii::t('app', 'Трапилась помилка!'); ?> 
                            </div>
                            <p>
                                <?= Yii::t('app', 'Будь ласка, зв’яжіться з адміністрацією сайту.'); ?>
                            </p>
                        <?php endif; ?>
                        <div class="popup-message">
                            <b><?= $message['message']; ?></b>
                        </div>
                        <svg width="47" height="47"><use xlink:href="#hail"></use></svg>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="wrapper" id="vue-app">
        <?= $this->render('aside-left'); ?>

        <main id="main" <?php if ( $currentPageUrl !== "/") : ?> style=""  <?php endif; ?>   >
            <?= $content ?>
        </main>

        <?= $this->render('aside-right'); ?>
    </div>

    <?= $this->render('footer'); ?>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
