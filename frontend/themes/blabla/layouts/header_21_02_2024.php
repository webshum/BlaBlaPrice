<?php

use yii\helpers\Url;
use yii\helpers\Html;
use common\models\User;
use frontend\models\Category;
use common\models\Category as Cat;

?>

<!-- HEADER -->
<header id="header">
    <button class="d-none s-991 btn-aside">
        <svg width="27" height="30"><use xlink:href="#user"></use></svg>
    </button>

    <a href="#" class="menu-button h-991">
        <?= Yii::t('app', 'Категорії'); ?>
        <svg width="11" height="7"><use xlink:href="#arrow"></use></svg>
    </a>
    
    <?php if (Yii::$app->user->identity->role == User::ROLE_USER) : ?>
        <?php if (!Yii::$app->user->isGuest) : ?>
            <div class="header-search ">
                <form>
                    <input class="main-search" id="ac" placeholder="<?php echo Yii::t('app', 'Що Ви шукаєте?'); ?>" autocomplete="off"/>
                    <ul class="autocomplete">
                        <li></li>
                    </ul>
                </form>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <a href="/" class="logo d-none s-991">
        <img src="/img/logo-black.svg" alt="">
    </a>

    <div class="head-social ">
        <button>
            <svg width="20" height="24"><use xlink:href="#soc"></use></svg>
        </button>

        <div class="wrap">
            <p><?= Yii::t('app', 'Поширьте blablaprice'); ?></p>
            <div>
                <a href="#">
                    <svg width="24" height="24"><use xlink:href="#facebook"></use></svg>
                </a>
                <a href="#">
                    <svg width="24" height="24"><use xlink:href="#google"></use></svg>
                </a>
                <a href="#">
                    <svg width="24" height="24"><use xlink:href="#youtube"></use></svg>
                </a>
                <a href="#">
                    <svg width="24" height="24"><use xlink:href="#twitter"></use></svg>
                </a>
            </div>
        </div>
    </div>

    <? if (Yii::$app->user->identity->role == User::ROLE_USER) : ?>
        <!--.........-->
    <?php endif; ?>
</header>
<!-- // HEADER -->

<!-- NAV -->
<nav class="nav">
    <!-- LEVER 1 -->
    <div class="menu">
        <div class="inner">
            <?php foreach ($this->context->category as $category_item) : ?>
            <?php if ($category_item->parentID == 0) : ?>
                <div class="menu-item icon">
                    <a href="/site/filter?id=<?= $category_item->ID ?>" data-id="<?= $category_item->ID ?>"><?= $category_item->name ?></a>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
        </div>
    </div>
</nav>
<!-- // NAV -->