<?php

use yii\helpers\Url;
use yii\web\Session;
use common\models\User;

$session = Yii::$app->session;

?>

<div class="aside-menu">
    <ul>
        <li>
            <a class="link <?= active('order') ?>" href="<?= Url::to(['cabinet/order']) ?>">
                <div class="icon">
                    <svg width="20" height="20"><use xlink:href="#requests"></use></svg>
                </div>
                
                <?= Yii::t('app', '<span>Отримані</span> запити'); ?>

                <?php if ($this->context->count_orders > 0) : ?>
                    <div class="count">
                        <?= $this->context->count_orders ?>
                    </div>
                <?php endif; ?>
            </a>
        </li>
        <li>
            <a class="link <?= active('offer') ?>"
               href="<?= Url::to(['cabinet/offer']) ?>">
                <div class="icon">
                    <svg width="24" height="24"><use xlink:href="#offers"></use></svg>
                </div>
                
                <?= Yii::t('app', '<span>Мої</span> пропозиції'); ?>

                <?php if ($this->context->send_offers > 0) : ?>
                    <div class="count">
                        <?= $this->context->send_offers; ?>
                    </div>
                <?php endif; ?>
            </a>
        </li>
        <li>
            <a class="link <?= active('accepted') ?> <?= active('comment') ?>" href="<?= Url::to(['cabinet/accepted']) ?>">
                <div class="icon">
                    <svg width="26" height="26"><use xlink:href="#contacts"></use></svg>
                </div>
                
                <?= Yii::t('app', 'Контакти <span>клієнтів</span>'); ?>

                <?php if ($this->context->accepted_offers > 0) : ?>
                    <div class="count">
                        <?= $this->context->accepted_offers; ?>
                    </div>
                <?php endif; ?>
            </a>
        </li>
    </ul>
</div>