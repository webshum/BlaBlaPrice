<?php

use yii\helpers\Url;
use yii\helpers\Html;
use frontend\models\Category;
use common\models\Category as Cat;

?>
<!-- HEADER BEGIN -->
<div id="loader"></div>
<header>
    <div class="header-buttons responsive-slide" data-rel="0">
        <div class="responsive-slide-close-layer"></div>
        <div class="responsive-slide-content">
            <div class="close-button-wrapper hidden-lg">
                <a class="button style-3 size-3 shadow inline-block" href="#">
                    <span>
                        <?= Html::img('/img/icon-1.png') ?>
                    </span>
                </a>
            </div>
            <div class="default-buttons not-logined">
			
       
    
			
                <a class="new-page-button-label-3 open-static-popup" data-rel="account-login" >
                    <span><?= Yii::t('app', 'Вхід'); ?></span>
                </a>

            </div>
            
        </div>
    </div>
    <div class="header-middle visible-lg">
        <div class="menu-button menu-button-style visible-lg"><?= Yii::t('app', 'Категорії'); ?></div>
        <div class="header-search visible-lg">
            <form>
                <div class="inline-form clearfix">
                   <input class="main-search simple-input size-3 input-header" id="ac" value="" style="
    background-color: #ececec;"
                           placeholder="<?php echo Yii::t('app', 'Що Ви шукаєте?'); ?>" autocomplete="off"/>
                    <ul class="autocomplete">
                        <li>

                            <div class="content">
                                <a class="title" href="#">&nbsp;</a>
                                <a class="category" href="#">&nbsp;</a>
                                <div class="price">&nbsp;</div>
                            </div>
                        </li>
                    </ul>
                   <i class="icon-search "></i>
                </div>
            </form>
        </div>
    </div>
    
<div class="cust-tooltip">
    <div class="logo">
	 <img src="/img/logo.png" alt="">
       
    </div>
	<div class="tooltip-content left-data" >
                                            <?= Yii::t('app', 'BlaBlaPrice - місце де покупці знаходять продавців'); ?>
                                        </div>
</div>
    
  <div class="responsive-buttons hidden-lg">
        <div class=" menu-button ">
           <i class="icon-search in-header"></i>
        </div>
        <div class="open-static-popup" data-rel="account-login">
             <i class="icon-menu "></i>
        </div>
    </div>
 
</header>
<div class="header-empty-space"></div>

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