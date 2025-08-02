<?php

use yii\helpers\Html;
use yii\web\Session;
$session = Yii::$app->session;
use yii\web\Cookie;

$cookies = \Yii::$app->getRequest()->getCookies();

/* @var $this yii\web\View */

$this->title = 'BlaBlaPrice.com';
?>

     <div id="content-block">
	  <div class="inner-block  fixed-desktop fixed-desktop-left " >

               <div class="container circle">
			     <div class="h3-produkt"><?= Yii::t('app', 'Для продавців'); ?></div>

				   <div class="text-how-it-works " >
				   <?= Yii::t('app', 'Приєднайся до 13000 продавців з України, та пропонуй свої ціни '); ?>

				   </div>
				    <div class="empty-space col-xs-b5 col-sm-b5"></div>
				   <a class="link-how-it-works-2  open-static-popup " data-rel="account-login" >
                        <?= Yii::t('app', '+ Стати продавцем в Україні'); ?>
                      </a>
					   <div class="text-how-it-works " >

				   </div>
			    </div>

  </div>
	 <div class="sidebar-content">
		<div class="float-container-min ">
			<div class="container-min">
				<div class="h3-float-container">
					<?= Yii::t('app', 'Новий запит'); ?>
				</div>
			</div>
		</div>
		 <div class="float-container" >
           <div class="container">
		     <div class="empty-space col-xs-b60 col-sm-b60"></div>

			<div class="blabla-comment">
				<div class="user-photo-left icon-logo">
					
				</div>
				<?= Yii::t('app', 'BlaBlaPrice - сервіс пошуку найкращої ціни на товари та послуги '); ?>
				 
    
			</div>
			<div class="empty-space col-xs-b5 col-sm-b5"></div>
			<div class="blabla-comment">
				<div class="user-photo-left icon-logo">
					
				</div>
				<?= Yii::t('app', 'Оберіть країну:'); ?>
				  <a href="#" id="lang" class="blabla_country open-static-popup" data-rel="language"><?php echo (isset($_SESSION['language'])) ? Yii::$app->params['lang'][$_SESSION['language']] : Yii::t('app', 'Мови'); ?></a>
    
			</div>
			<div class="empty-space col-xs-b5 col-sm-b5"></div>
			<div class="blabla-comment ">
				<div class="user-photo-left icon-logo">
				 <img src="/img/icon-logo.png" alt="">
				</div>
				<div class="empty-space col-xs-b15 col-sm-b15"></div>
				<?= Yii::t('app', 'ЯК ЦЕ ПРАЦЮЄ ?'); ?>
				<ul type="disc" style="list-style: disc; margin-left: 20px">
					<li style="margin-top: 10px"><?= Yii::t('app', 'Створи запит, вказавши вказавши бажану ціну та інші характеристики товару чи послуги'); ?></li>
					<li style="margin-top: 10px"><?= Yii::t('app', 'Отримай пропозиції від зацікавлених продавців'); ?></li>
					<li style="margin-top: 10px"><?= Yii::t('app', 'Обміняйся контактами з продавцем, та уточни деталі'); ?></li>
				</ul>
				<div class="empty-space col-xs-b15 col-sm-b15"></div>
				
				<div class="menu-button button style-5 size-1 left" style="width:auto;"><?= Yii::t('app', 'Спробувати'); ?></div>
			</div>
			<div class="empty-space col-xs-b25 col-sm-b25"></div>


			
			
			
		

			<div class="empty-space col-xs-b25 col-sm-b25"></div>

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
					 <a class="link-right-block" href="/site/howitworks"><?= Yii::t('app', 'Як це працює? '); ?></a>  ·
					 <a class="link-right-block" href="/site/contact"><?= Yii::t('app', 'Контакти '); ?></a>
                     <div  class="blabla-right-block "  <span> BlaBlaPrice © 2018 </span></div>






     </div>
	</div>
	<div class="empty-space col-xs-b60 col-sm-b60"></div>

		 </div>
		</div>
	</div>





    <div class="popup-wrapper <?php if ($cookies->has('register_social')) {echo $cookies->getValue('register_social');} ?>">
        <div class="close-layer"></div>

        <?= $this->render('@app/themes/blablaprice/popup/popup-account-login') ?>

        <?= $this->render('@app/themes/blablaprice/popup/popup-account-registration') ?>

        <?= $this->render('@app/themes/blablaprice/popup/popup-account-reset-password') ?>

        <?= $this->render('@app/themes/blablaprice/popup/language'); ?>

    </div>


    <!-- SCRIPTS BEGIN -->
    <script type='text/javascript'>
        $(function () {
            var datepickerInterval;

            $('.datepicker').pickadate({
                min: new Date(),
                onSet: function (thingSet) {
                    clearInterval(datepickerInterval);
                    setTimer($('.time-entry[data-rel="' + $('#datepicker').data('rel') + '"]'), thingSet.select);
                    datepickerInterval = setInterval(function () {
                        setTimer($('.time-entry[data-rel="' + $('#datepicker').data('rel') + '"]'), thingSet.select);
                    }, 1000);
                }
            });

            function setTimer(wrapper, finalTime) {
                var today = new Date().getTime();
                var interval = finalTime - today;
                if (interval < 0) interval = 0;
                var days = parseInt(interval / (1000 * 60 * 60 * 24));
                var daysLeft = interval % (1000 * 60 * 60 * 24);
                var hours = parseInt(daysLeft / (1000 * 60 * 60));
                var hoursLeft = daysLeft % (1000 * 60 * 60);
                var minutes = parseInt(hoursLeft / (1000 * 60));
                var minutesLeft = hoursLeft % (1000 * 60);
                var seconds = parseInt(minutesLeft / (1000));
                wrapper.find('.days').text(days);
                wrapper.find('.hours').text(hours);
                wrapper.find('.minutes').text(minutes);
                wrapper.find('.seconds').text((seconds < 10) ? '0' + seconds : seconds);
            }
        });
    </script>

<?php
$this->registerJs('
    var wow = new WOW();
    if(!_ismobile) wow.init();
    ', \yii\web\View::POS_END);
?>
    <!-- SCRIPTS END -->

<?= $this->render('footer'); ?>
