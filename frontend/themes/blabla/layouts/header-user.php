<?php

use yii\helpers\Html;
use yii\web\Session;
use common\models\User;
use common\models\Category as Cat;

$session = Yii::$app->session;

/**
 * @var $this \yii\web\View
 */
?>

<div id="loader"></div>
<header>
    <div class="header-buttons responsive-slide logged" data-rel="0">
        <div class="responsive-slide-close-layer"></div>
        <div class="responsive-slide-content">


            <div class="default-buttons">

                <div class="new-page-button-label-3 visible-lg">

                   <i class="icon-menu"></i>
                </div>

                <?php if (User::isRole(User::ROLE_USER)) : ?>
                    <div class="logged-buttons-wrapper">
                        <div class="logged-menu">



						<a href="/cabinet/settings">
							<i class="icon-cog-1"></i>
					       	<span><?= Yii::t('app', 'Особисті дані') ?></span>
                        </a>
						<a href="#" id="lang" class=" open-static-popup"  data-rel="language"><i class="icon-location-outline"></i><?php echo (isset($_SESSION['language'])) ? Yii::$app->params['lang'][$_SESSION['language']] : Yii::t('app', 'Мови'); ?></a>


						<?php echo Html::beginForm(['/site/logout'], 'post'); ?>
                            <button type="submit"  class="exit submit-form">
                                <i class="icon-logout"></i>
                                <?= Yii::$app->user->identity->username ?>, <?= Yii::t('app', 'вийти ?') ?>
                            </button>
                       <?php echo Html::endForm(); ?>
					 </div>
                    </div>

                <?php elseif (User::isRole(User::ROLE_SELLER)) : ?>
                    <div class="logged-buttons-wrapper">
                        <div class="logged-menu">


						<a href="/cabinet/settings">
							<i class="icon-cog-1"></i>
					       	<span><?= Yii::t('app', 'Налаштування') ?></span>
                        </a>
						<a href="/cabinet/filter">
							<i class="icon-sliders"></i>
					       	<span><?= Yii::t('app', 'Фільтри') ?></span>
                        </a>
						<a href="/cabinet/payment">
							<i class="icon-money"></i>
					       	<span><?= Yii::t('app', 'Баланс') ?>
								<?php  $user = User::find()->where(['ID' => Yii::$app->user->id])->one(); ?>
                                <?php echo $user->bal . ' ' . Yii::t('app', 'балів '); ?>
							</span>
                        </a>
                       <a href="#" id="lang" class=" open-static-popup"  data-rel="language"><i class="icon-location-outline"></i><?php echo (isset($_SESSION['language'])) ? Yii::$app->params['lang'][$_SESSION['language']] : Yii::t('app', 'Мови'); ?></a>

                        <?php echo Html::beginForm(['/site/logout'], 'post'); ?>
                            <button type="submit"  class="exit submit-form">
                                <i class="icon-logout"></i>
                                <?= Yii::$app->user->identity->username ?>, <?= Yii::t('app', 'вийти ?') ?>
                            </button>
                       <?php echo Html::endForm(); ?>
					 </div>
                    </div>
                <?php endif; ?>
            </div>
			
        </div>
    </div>
	
<?php if (User::isRole(User::ROLE_USER)) : ?>
    <div class="header-middle visible-lg">
        <div class="menu-button menu-button-style visible-lg"><?php echo Yii::t('app', 'Підібрати'); ?></div>
        <div class="header-search visible-lg">
            <form>
                <div class="inline-form clearfix">
                    <input class="main-search simple-input size-3 input-header" id="ac" value="" style="
    background-color: #ececec;"
                           placeholder="<?php echo Yii::t('app', 'Пошук по назві'); ?>" autocomplete="off"/>
                    <ul class="autocomplete">
                        <li>

                            <div class="content">
                                <a class="title" href="#">&nbsp;</a>


                            </div>
                        </li>
                    </ul>
					<i class="icon-search "></i>

                </div>

            </form>

        </div>
    </div>
<?php endif; ?>	
	
	
<div class="cust-tooltip">
    <div class="logo">
	 <img src="/img/logo.png" alt="">

    </div>
	<div class="tooltip-content left-data" >
                                            <?= Yii::t('app', 'BlaBlaPrice - місце де покупці знаходять продавців'); ?>
                                        </div>
</div>

<?php if (User::isRole(User::ROLE_USER)) : ?>
    <div class="responsive-buttons hidden-lg">
	
        <div class=" menu-button">
           <i class="icon-search in-header"></i>
        </div>
	
        <div class="open-responsive-slide" data-rel="0">
             <i class="icon-menu "></i>
        </div>
		<div class="menu-button" >
		<i class="icon-search "></i>
		</div>
<?php else : ?>
<div class="responsive-buttons hidden-lg">
	
        
	
        <div class="open-responsive-slide" data-rel="0">
             <i class="icon-menu "></i>
        </div>
		
<?php endif; ?>		
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
