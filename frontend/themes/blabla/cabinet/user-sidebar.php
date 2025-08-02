<?php

use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var \yii\web\View $this
 */
?>

<div class="aside-menu">
    <ul>
        <li>
            <a class="link <?= active('order'); ?>" href="<?= Url::to(['cabinet/order']) ?>">
                <div class="icon">
                    <svg width="20" height="20"><use xlink:href="#requests"></use></svg>
                </div>

                <?= Yii::t('app', '<span>Мої</span> запити') ?>

                <?php if ($this->context->count_orders > 0) : ?>
                    <div class="count">
                        <?= $this->context->count_orders ?>
                    </div>
                <?php endif; ?>
            </a>
        </li>
        <li>
            <a class="link <?= active('accepted'); ?> <?= active('comment'); ?>" href="<?= Url::to(['/cabinet/accepted-without-ans']) ?>">
                <div class="icon">
                    <svg width="26" height="26"><use xlink:href="#contacts"></use></svg>
                </div>

                <?= Yii::t('app', 'Контакти <span>компаній</span>') ?>

                <?php if ($this->context->accepted_offers > 0) : ?>
                    <div class="count">
                        <?= $this->context->accepted_offers ?>
                    </div>
                <?php endif; ?>
            </a>
        </li>
    </ul>
</div>