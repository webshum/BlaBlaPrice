<?php

use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var \yii\web\View $this
 */

switch ($active) {
    case 'settings' :
        $menu = Yii::t('app', 'Особисті дані');
        break;
    case 'product' :
        $menu = Yii::t('app', 'Мої товари');
        break;
    case 'accepted' :
        $menu = Yii::t('app', 'Контакти компаній');
        break;
    case 'comment' :
        $menu = Yii::t('app', 'Відгуки про мене');
        break;
}
?>

<div class="sidebar visible-lg">
<div class="empty-space col-xs-b40 col-lg-b40"></div>
    <div class="container sidebar-container">
        <div class="sidebar-title menu-button-style hidden-lg"><?= $menu ?></div>


        <div class="sidebar-toggle">
            <div class="sidebar-menu">
		
              
                <a class="sidebar-menu-item <?= $active == 'product' ? 'active' : '' ?>"
                   href="<?= Url::to(['cabinet/order']) ?>">
                    <span class="icon">
                       <i class="icon-bullhorn"></i>
                    </span>
                    <span class="description">
                        <span class="align"><?= Yii::t('app', 'Мої запити') ?></span>
                    </span>
                    <?php if ($this->context->count_orders > 0): ?>
                        <span class="button style-11 size-4 ">
                            <span><?= $this->context->count_orders ?></span>
                        </span>
                    <?php endif; ?>
                </a>
                <a class="sidebar-menu-item <?= $active == 'accepted' ? 'active' : '' ?>"
                   href="<?= Url::to(['/cabinet/accepted-without-ans']) ?>">
                    <span class="icon">
                       <i class="icon-users-outline"></i>
                    </span>
                    <span class="description">
                        <span class="align">
                            <?= Yii::t('app', 'Контакти компаній') ?> <br/>

                        </span>
                    </span>
                    <?php if ($this->context->accepted_offers > 0): ?>
                        <span class="button style-11 size-4 ">
                            <span><?= $this->context->accepted_offers ?></span>
                        </span>
                    <?php endif; ?>
                </a>
                <a class="sidebar-menu-item <?= ($active == 'comment') ? 'active' : '' ?>" href="<?= Url::to(['cabinet/comment']) ?>">
                    <span class="icon">
						<i class="icon-chat-alt"></i>

                    </span>
                    <span class="description">
                        <span class="align">
                            <?= Yii::t('app', 'Відгуки про мене') ?>
                        </span>
                    </span>
                    <?php if ($this->context->count_feedback > 0): ?>
                        <span class="button style-11 size-4 ">
                            <span><?= $this->context->count_feedback ?></span>
                        </span>
                    <?php endif; ?>
                </a>
				
                <div class="clear"></div>
            </div>
        </div>


    </div>
</div>