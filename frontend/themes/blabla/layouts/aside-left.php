<?php 

use yii\helpers\Html;
use common\models\User;

?>

<aside id="aside-left">
	<div class="wrap">
		<div class="head">
			<a href="/" class="logo">
		 		<img src="/blabla/img/logo-black.svg" alt="">
	    	</a>

	    	<a href="#" id="lang" class="blabla_country open-static-popup h-991" data-rel="language">
	    		<?= (isset(Yii::$app->language)) ? Yii::$app->params['lang'][Yii::$app->language] : Yii::t('app', 'Мови'); ?>		
	    	</a>

	    	<button class="d-none s-991 btn-aside-close">
	    	    <svg width="17" height="17"><use xlink:href="#close-layer"></use></svg>
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
			
		<?php endif; ?>
		
		<?php if (Yii::$app->user->isGuest) : ?>
			<div class="aside-menu">
				<ul>
					<li>
						<a class="link open-static-popup " data-rel="account-login">
							<div class="icon">
								<svg width="20" height="20"><use xlink:href="#requests"></use></svg>
							</div>
                
							<?= Yii::t('app', 'Отримати пропозиції'); ?>

                        </a>
					</li>
					<li>
						<a class="link open-static-popup " data-rel="account-login">
							<div class="icon">
                               <svg width="24" height="24"><use xlink:href="#offers"></use></svg>
							</div>
                
							<?= Yii::t('app', 'Зареєструватись продавцем'); ?>

                        </a>
					</li>
				</ul>
			</div>
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
			<div class="links d-none s-991">
				<a href="/site/contact"><?= Yii::t('app', 'Контакти '); ?></a>
				<a href="/site/termsofuse"><?= Yii::t('app', 'Умови '); ?></a>
				<a href="/site/privacypolicy"><?= Yii::t('app', 'Конфіденційність '); ?></a>
					<a href="/site/pricing"><?= Yii::t('app', 'Ціни'); ?></a>
				<a href="/site/refund"><?= Yii::t('app', 'Повернення коштів'); ?></a>	
			</div>
		</div>

		
	</div>
</aside>