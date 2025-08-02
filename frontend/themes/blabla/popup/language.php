<?php 

use yii\helpers\Html;

?>

<div class="popup-content popup-language"  data-rel="language">
    <div class="popup-container">
        <a class="close-popup-all">
            <svg width="12" height="12"><use xlink:href="#close-layer"></use></svg>
        </a>

        <div class="popup-title"><?= Yii::t('app', 'Оберіть країну'); ?></div>

        <ul class="list-language">
            <?php foreach (Yii::$app->params['lang'] as $code => $lang) : ?>
                <li>
                    <a href="?lang=<?php echo $code; ?>" <?= (Yii::$app->language == $code) ? 'class="active"' : ''; ?>>
                        <?= Yii::t('app', $lang); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>