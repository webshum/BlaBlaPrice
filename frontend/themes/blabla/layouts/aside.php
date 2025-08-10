<?php 

use yii\helpers\Html;
use common\models\User;

?>

<aside id="aside">
	<div class="wrap">
		<div class="head">
			<a href="/" class="logo">
		 		<img src="/blabla/img/logo.svg" alt="">
	    	</a>

	    	<a href="#" id="lang" class="blabla_country open-static-popup h-991" data-rel="language">
	    		<?= (isset($_SESSION['language'])) ? Yii::$app->params['lang'][$_SESSION['language']] : Yii::t('app', 'Мови'); ?>		
	    	</a>

	    	<button class="d-none s-991 btn-aside-close">
	    	    <svg width="17" height="17"><use xlink:href="#close"></use></svg>
	    	</button>
		</div>

		<?php 
			if (User::isRole(User::ROLE_SELLER)) {
				echo $this->render('@appTheme/cabinet/seller-sidebar');
			} else if (User::isRole(User::ROLE_USER)) {
				echo $this->render('@appTheme/cabinet/user-sidebar');
			}
		?>

		<?php if (!Yii::$app->user->isGuest) : ?>
			<h2 class="title d-none s-991"><span>Особистий кабінет</span></h2>
		<?php endif; ?>
		
		<div class="foot">
			<?php if (Yii::$app->user->isGuest) : ?>
				<a class="open-static-popup link-btn" data-rel="account-login">
					<div class="avatar">
						<svg width="20" height="22"><use xlink:href="#user"></use></svg>
					</div>
		            <span><?= Yii::t('app', 'Вхід'); ?></span>
		        </a>
		    <?php else : ?>
		    	<ul>
		    		<li>
						<a href="/cabinet/settings" class="<?= active('settings') ?>">
							<svg width="18" height="18"><use xlink:href="#settings"></use></svg>
					       	<span><?= Yii::t('app', 'Налаштування') ?></span>
	                    </a>
		    		</li>

		    		<?php if (User::isRole(User::ROLE_SELLER)) : ?>
		    			<li>
							<a href="/cabinet/filter" class="<?= active('filter') ?>">
								<svg width="18" height="18"><use xlink:href="#filter"></use></svg>
						       	<span><?= Yii::t('app', 'Фільтри') ?></span>
	                        </a>
		    			</li>

		    			<li>
		    				<a href="/cabinet/payment" class="<?= active('payment') ?>">
		    					<svg width="18" height="12"><use xlink:href="#balance"></use></svg>
						       	<span>
	                                <?php 
	                                	$user = User::find()->where(['ID' => Yii::$app->user->id])->one();
	                                	echo Yii::t('app', 'Баланс') . ' ' .$user->bal . ' ' . Yii::t('app', 'балів '); 
	                                ?>
								</span>
	                        </a>
		    			</li>
		    		<?php endif; ?>

		    		<li>
						<?php echo Html::beginForm(['/site/logout'], 'post'); ?>
			                <button type="submit">
			                	<svg width="18" height="18"><use xlink:href="#exit"></use></svg>
			                    <?= Yii::t('app', 'Вийти') ?>
			                </button>
			            <?php echo Html::endForm(); ?>
		    		</li>
		    	</ul>

	            <div class="link-btn">
	            	<div class="avatar">
						<svg width="20" height="22"><use xlink:href="#user"></use></svg>
					</div>
					<span><?= Yii::$app->user->identity->username ?></span>
	            </div>
		    <?php endif; ?>
		</div>

		<div class="aside-social d-none">
            <p>
            	<svg width="20" height="24"><use xlink:href="#soc"></use></svg>
            	<?= Yii::t('app', 'Поширьте blablaprice'); ?>	
            </p>

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

		<?php if (Yii::$app->user->isGuest) : ?>
			<div class="links">
				<a class="menu-button" href="#"><?= Yii::t('app', 'Категорії'); ?></a>
				<a href="/site/contact"><?= Yii::t('app', 'Контакти '); ?></a>
				<a class="open-static-popup" data-rel="account-login" href="/site/howitworks"><?= Yii::t('app', 'Власний кабінет'); ?></a>
				<a href="/site/howitworks"><?= Yii::t('app', 'Як це працює? '); ?></a>
			</div>
		<?php endif; ?>
	</div>
</aside>