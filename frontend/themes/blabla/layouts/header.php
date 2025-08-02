<?php

use yii\helpers\Url;
use yii\helpers\Html;
use common\models\User;
use frontend\models\Category;
use common\models\Category as Cat;

?>

<!-- HEADER -->
<?php $currentPageUrl = $_SERVER['REQUEST_URI'];?>

<?php if ( $currentPageUrl !== "/cabinet/filter") : ?>
<header id="header">
	<div class="head-main">
	    <button class="d-none btn-aside">
	        <span></span>
	        <span></span>
	        <span></span>
	    </button>

	    <?php if (Yii::$app->user->identity->role !== User::ROLE_SELLER) : ?>
	        <a href="#" class="menu-button h-991">
	              <?= Yii::t('app', 'Категорії'); ?>
	              <svg width="11" height="7"><use xlink:href="#arrow"></use></svg>
	        </a>
	    
	        <div class="header-search">
	            <form>
	                <input class="main-search" id="ac" placeholder="<?php echo Yii::t('app', 'Знайти на BlaBlaPrice'); ?>" autocomplete="off"/>
	                <ul class="autocomplete">
	                    <li></li>
	                </ul>
	            </form>
	        </div>

			<div class="head-social">
				<button class="close-nav d-none">
					<span></span><span></span>
				</button>

				<button>
					<svg width="20" height="24"><use xlink:href="#soc"></use></svg>
				</button>

				<?= $this->render('@appTheme/components/social'); ?>
			</div>
	    <?php endif; ?>
		
		<?php if (Yii::$app->user->identity->role == User::ROLE_SELLER) : ?>
			<a href="/" class="logo d-none">
			    <img src="/blabla/img/logo-black.svg" alt="">
			</a>	
			
			<?php if ( $currentPageUrl == "/cabinet/order") : ?>
		
				<h3 class="title h-991">
					<?= Yii::t('app', 'Знайдено '); ?>	
					<b><?= $countOrders ?></b>	
					<?= Yii::t('app', ' запитів'); ?>	
				</h3>

				<a href="/cabinet/filter" class="filter-button">
					<span><?= Yii::t('app', 'Фільтри'); ?></span>
					<svg width="14" height="14"><use xlink:href="#filter"></use></svg>
				</a>
		
			<?php else : ?>
				<?php if ( $currentPageUrl == "/cabinet/offer") : ?>
					<h3 class="title h-991">
						<?= Yii::t('app', 'Надіслані пропозиції'); ?>		
					</h3>
				<?php endif; ?>
				<?php if ( $currentPageUrl == "/cabinet/accepted") : ?>
					<h3 class="title h-991">
						<?= Yii::t('app', 'Контакти клієнтів'); ?>		
					</h3>
				<?php endif; ?>
				<?php if ( $currentPageUrl == "/cabinet/comment") : ?>
					<h3 class="title h-991">
						<?= Yii::t('app', 'Контакти клієнтів'); ?>		
					</h3>
				<?php endif; ?>
				<?php if ( $currentPageUrl == "/site/contact") : ?>
					<h3 class="title h-991">
						<?= Yii::t('app', 'Контакти BlaBlaPrice'); ?>		
					</h3>
				<?php endif; ?>
				<?php if ( $currentPageUrl == "/site/termsofuse") : ?>
					<h3 class="title h-991">
						<?= Yii::t('app', 'Умови використання сервісу'); ?>		
					</h3>
				<?php endif; ?>
				<?php if ( $currentPageUrl == "/site/privacypolicy") : ?>
					<h3 class="title h-991">
						<?= Yii::t('app', 'Конфеденційність сервісу'); ?>		
					</h3>
				<?php endif; ?>
				<?php if ( $currentPageUrl == "/cabinet/comment-refuse") : ?>
					<h3 class="title h-991">
						<?= Yii::t('app', 'Відмовився'); ?>		
					</h3>
				<?php endif; ?>
				<?php if ( $currentPageUrl == "/cabinet/settings") : ?>
					<h3 class="title h-991">
						<?= Yii::t('app', 'Налаштування'); ?>		
					</h3>
				<?php endif; ?>
				<?php if ( $currentPageUrl == "/cabinet/payment") : ?>
					<h3 class="title h-991">
						<?= Yii::t('app', 'поповніть ваш баланс'); ?>		
					</h3>
				<?php endif; ?>

				
				<div class="head-social ">
					<button>
						<svg width="20" height="24"><use xlink:href="#soc"></use></svg>
					</button>

					<?= $this->render('@appTheme/components/social'); ?>
				</div>
			
			<?php endif; ?>		
		<?php endif; ?>
	</div>
    
    <?php 
		if (Yii::$app->user->identity->role == User::ROLE_SELLER) {
			echo $this->render('@appTheme/cabinet/seller-sidebar');
		} else if (Yii::$app->user->identity->role == User::ROLE_USER) {
			echo $this->render('@appTheme/cabinet/user-sidebar');
		}
	?>
</header>
<?php endif; ?>
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