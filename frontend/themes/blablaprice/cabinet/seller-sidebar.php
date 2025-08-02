<?php

use yii\helpers\Url;
use yii\web\Session;
use common\models\User;

$session = Yii::$app->session;

switch ($active) {
    case 'order' :
        $menu = Yii::t('app', 'Отримані запити');
        break;
    case 'offer' :
        $menu = Yii::t('app', 'Мої пропозиції');
        break;
    case 'accepted' :
        $menu = Yii::t('app', 'Контакти клієнтів');
        break;
    case 'comment' :
        $menu = Yii::t('app', 'Відгуки');
        break;
    case 'filter' :
        $menu = Yii::t('app', 'Фільтри');
        break;
    case 'settings' :
        $menu = Yii::t('app', 'Налаштування');
        break;
}

?>

<div class="sidebar visible-lg">
 <div class="empty-space col-xs-b40 col-lg-b40"></div>
    <div class="container sidebar-container">
        <div class="sidebar-title menu-button-style hidden-lg"><?php echo $menu ?></div>
        <div class="sidebar-toggle">
            <div class="sidebar-menu">
                <a class="sidebar-menu-item <?php echo $active == 'order' ? 'active' : '' ?>"
                   href="<?php echo Url::to(['cabinet/order']) ?>">
                            <span class="icon">
                               <i class="icon-mail"></i>
                            </span>
                    <span class="description">
                                <span class="align"><?php echo Yii::t('app', 'Отримані запити'); ?></span>
                            </span>
                    <span class="button style-11 size-4"><span><?php echo $this->context->count_orders ?></span>
                </a>
                <a class="sidebar-menu-item <?php echo $active == 'offer' ? 'active' : '' ?>"
                   href="<?php echo Url::to(['cabinet/offer']) ?>">
                            <span class="icon">
                               <i class="icon-article"></i>
                            </span>
                    <span class="description">
                                <span class="align"><?php echo Yii::t('app', 'Мої пропозиції'); ?></span>
                            </span>
                    <?php if ($this->context->send_offers > 0): ?>
                        <span class="button style-11 size-4"><span><?php echo $this->context->send_offers ?></span></span>
                    <?php endif; ?>
                </a>
                <a class="sidebar-menu-item <?php echo $active == 'accepted' ? 'active' : '' ?>"
                   href="<?php echo Url::to(['cabinet/accepted']) ?>">
                            <span class="icon">
                               <i class="icon-users-outline"></i>
                            </span>
                    <span class="description">
                                <span class="align"><?php echo Yii::t('app', 'Контакти клієнтів'); ?></span>
                            </span>
                    <?php if ($this->context->accepted_offers > 0): ?>
                        <span class="button style-11 size-4"><span><?php echo $this->context->accepted_offers ?></span></span>
                    <?php endif; ?>
                </a>
                <a class="sidebar-menu-item <?php echo $active == 'comment' ? 'active' : '' ?>"
                   href="<?php echo \yii\helpers\Url::to(['cabinet/comment']) ?>">
                            <span class="icon">
                               <i class="icon-chat-alt"></i>
                            </span>
                    <span class="description">
                                <span class="align"><?php echo Yii::t('app', 'Відгуки'); ?></span>
                            </span>
                    <?php if ($this->context->count_feedback > 0): ?>
                        <span class="button style-11 size-4"><span><?php echo $this->context->count_feedback ?></span></span>
                    <?php endif; ?>
                </a>
                
               

            
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>