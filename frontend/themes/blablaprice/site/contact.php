<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use common\models\User;
use yii\helpers\Url;

$this->title = Yii::t('app', 'Контакти');

?>
    <div id="content-block">
	    				
    <?php if (Yii::$app->user->identity->role == User::ROLE_USER) : ?>             
	<div class="sidebar visible-lg">
		<div class="empty-space col-xs-b35 col-sm-b35"></div>  

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
                   href="<?= Url::to(['cabinet/accepted']) ?>">
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
<div class="float-container-bottom hidden-lg" >
            <div class="footer-main-link" style="left:12%;">
			  
               <a href="/cabinet/order" class="link-footer"><i class="icon-logout"></i><span><?= Yii::t('app', 'Запити'); ?></a>   
               <a href="/cabinet/accepted" class="link-footer "><i class="icon-users-outline"></i><span><?= Yii::t('app', 'Контакти'); ?></span></a>
               <a href="/cabinet/comment" class="link-footer "><i class="icon-chat-alt"></i><span><?= Yii::t('app', 'Відгуки'); ?></span></a>
              
           
				
           
        </div>
        </div>
<?php elseif (Yii::$app->user->identity->role == User::ROLE_SELLER) : ?>
<div class="sidebar visible-lg">
 <div class="empty-space col-xs-b35 col-sm-b35"></div> 
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
<div class="float-container-bottom hidden-lg" >
            <div class="footer-main-link">

               <a href="/cabinet/order" class="  link-footer"><i class="icon-login"></i><span> <?= Yii::t('app', 'Запити'); ?></a>
               <a href="/cabinet/offer" class=" link-footer  "><i class="icon-logout"></i><span> <?= Yii::t('app', 'Пропозиції'); ?></span></a>
               <a href="/cabinet/accepted" class="link-footer "><i class="icon-users-outline"></i><span> <?= Yii::t('app', 'Контакти'); ?></span></a>
               <a href="/cabinet/comment" class="link-footer "><i class="icon-chat-alt"></i><span> <?= Yii::t('app', 'Відгуки'); ?></span></a>




        </div>
    </div>
<?php elseif (Yii::$app->user->identity->role !== User::ROLE_SELLER and Yii::$app->user->identity->role !== User::ROLE_USER) : ?>

   <div class="inner-block fixed-desktop fixed-desktop-left " >
               <div class="container circle">
			   <div class="h3-produkt"><?= Yii::t('app', 'Хто продає'); ?></div>
			 
				   <div class="text-how-it-works " >
				     <?= Yii::t('app', 'BlaBlaPrice працює у 6 країнах. Вже зареєстровано понад 200 тис продавців з 456 категорій товарів і послуг '); ?>
                    </div>
					<div class="empty-space col-xs-b10 col-sm-b10"></div>
					 <a class="link-how-it-works-2  open-static-popup " data-rel="registration-seller" >
                        <?= Yii::t('app', '+ Стати продавцем в Україні'); ?>
                      </a>    
				   
			   </div>
		     </div>	
<?php endif;?>

<div class="sidebar-content">
        <div class="float-container">
	      <div class="empty-space col-xs-b45 col-sm-b45"></div>
        <div class="container">
			<div class="blabla-comment">
				<div class="user-photo-left icon-logo">
					<img src="/img/icon-logo.png" alt="">
				</div>
				<?= Yii::t('app','Чекаємо на запитання або пропозиції співпраці'); ?>
			</div>
			  <div class="empty-space col-xs-b30 col-sm-b30"></div>
          
           
                
               
                    <div class="inner-block-2">
					<div class="row m10">
					<div class="row m5">
					<div class="empty-space col-xs-b15 col-lg-b15"></div>
					<div class="simple-article large dark col-xs-b5">
                        <div class="content">
                            <h3 class="h3 "><?= Yii::t('app','Пропозиції співпраці'); ?></h3>
                          
                            <h5 class="text-how-it-works"><?= Yii::t('app','Покупці пишуть питання тут'); ?></h5>
                          
                        </div>
						</div>
						 </div>
                        <div class="content">
                           

                            <form action="#" class="form-contact-ajax">
                                <input type="hidden" name="title" value="<?= Yii::t('app','Пропозиції співпраці'); ?>">
                              
                                <div class="empty-space col-xs-b10"></div>
                                <textarea class="simple-input size-4" name="descr" required placeholder="Сообщение"></textarea>
                                <div class="empty-space col-xs-b10"></div>
                                <input class="simple-input size-3" value="" type="email" name="email" required placeholder="Эл. почта">
                                <div class="empty-space col-xs-b10"></div>
                                <input class="simple-input size-3" value="" type="tel" name="phone" required placeholder="Телефон">
                                <div class="empty-space col-xs-b10"></div>
                                <div class="text-center">
                                    <div class="button style-1 size-2 shadow"><span><?= Yii::t('app','Надіслати'); ?></span><input type="submit"/></div>
                                </div>
                            </form>

                        </div> 
                        </div>
                    </div>
                    <div class="empty-space col-xs-b40"></div>
              
          
			 <div class="inner-block fixed-desktop fixed-desktop-right " >
					<div class="user-photo-left icon-logo">
						<img src="/img/icon-logo.png" alt="">
					</div>
                   <div class="container">
                        <div class="title-how-it-works"><?= Yii::t('app', 'Популярні питання'); ?></div>
						<div class="cust-tooltip ">
						   <div  class="link-how-it-works "  <span>  <?= Yii::t('app', 'Це безкоштовно ?'); ?></span></div>
						   <div class="tooltip-content-2 how-it-works-tooltip">
                              <?= Yii::t('app', 'Так. Ви можете безкоштовно надсилати запити і обмінюватись контактами з обраними продавцями. '); ?>
                           </div>
						</div >
						<div class="cust-tooltip ">
						   <div  class="link-how-it-works "  <span>  <?= Yii::t('app', 'Хто бачить мої контакти?'); ?></span></div>
						   <div class="tooltip-content-2 how-it-works-tooltip">
                             <?= Yii::t('app','Ви самі обираєте з ким обмінятись контактами. '); ?>
                           </div>
						</div >
						<div class="cust-tooltip ">
						   <div  class="link-how-it-works "  <span><?= Yii::t('app', 'Чи обовязково обирати продавця? '); ?></span></div>
						   <div class="tooltip-content-2 how-it-works-tooltip">
                              <?= Yii::t('app','Не обовязково. Якщо вам не підійшли умови ви можете проігноравати пропозиції , або обмінятись контактами і ще поторгуватись з обраним продавцем.'); ?>
                           </div>
						</div >
						 <div class="empty-space col-xs-b20 col-lg-b20"></div>
						 <div class="title-how-it-works"><?= Yii::t('app', 'Поширте BlaBlaPrice'); ?></div>
					<div class="cust-tooltip ">
					     <div class="social-entry">

                        <a href="#">
                            <img src="/img/icon-4.png" alt="">                        </a>
                        <a href="#">
                            <img src="/img/icon-5.png" alt="">                        </a>
                        <a href="#">
                            <img src="/img/icon-6.png" alt="">                        </a>
                        <a href="#">
                            <img src="/img/icon-7.png" alt="">                        </a>
                       </div>
					   <div class="tooltip-content-2 how-it-works-tooltip">
                              <?= Yii::t('app','Поширте BlaBlaPrice щоб отримувати більше запитів '); ?>
                           </div>
					</div >
					 <div class="empty-space col-xs-b20 col-lg-b20"></div>
					 <a class="link-right-block" href="/site/howitworks"><?= Yii::t('app', 'Як це працює? '); ?></a>  
					 <a class="link-right-block" href="/site/contact"><?= Yii::t('app', 'Контакти '); ?></a>
					 <a class="link-right-block" href="/site/termsofuse"><?= Yii::t('app', 'Умови використання '); ?></a>
					 <a class="link-right-block" href="/site/privacypolicy"><?= Yii::t('app', 'Політика конфіденційності '); ?></a>					 
					 
					 
                     <div  class="blabla-right-block "  <span> BlaBlaPrice © 2018 </span></div>					 
					 
		
     </div>
	</div>
	<div class="empty-space col-xs-b90 col-sm-b90"></div> 
        </div>
				
		</div>

    </div>
	</div>
	  <div class="popup-wrapper">
        <div class="close-layer"></div>

        <?= $this->render('@app/themes/blablaprice/popup/popup-account-login') ?>

        <?= $this->render('@app/themes/blablaprice/popup/popup-account-registration') ?>

        <?= $this->render('@app/themes/blablaprice/popup/popup-account-reset-password') ?>
		 <?= $this->render('@app/themes/blablaprice/popup/language'); ?>

    </div>


    <!-- SCRIPTS BEGIN -->
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="js/global.js"></script>


	<script src="js/wow.min.js"></script>
    <script>
        var wow = new WOW();
        if(!_ismobile) wow.init();
    </script>


<?php
$this->registerJs('
    var wow = new WOW();
    if(!_ismobile) wow.init();
    ', \yii\web\View::POS_END);
?>
    <!-- SCRIPTS END -->


<?= $this->render('footer'); ?>