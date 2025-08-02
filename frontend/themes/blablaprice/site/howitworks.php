<?php

use yii\helpers\Html;
use common\models\User;
use yii\helpers\Url;
use common\models\Order;
use yii\widgets\ActiveForm;

$this->title = 'How it works';
//$this->params['breadcrumbs'][] = $this->title;

$loremIpsum = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc posuere finibus suscipit. Quisque eleifend
et sem nec vehicula. Vivamus fringilla arcu urna, laoreet aliquet.';
?>
    <!--<div class="header-empty-space"></div>-->

    <div id="content-block">
		    
                 <?php if (Yii::$app->user->identity->role == User::ROLE_USER) : ?>             
                 <div class="sidebar visible-lg">
				    <div class="empty-space col-xs-b40 col-sm-b40"></div>
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
<?php elseif (Yii::$app->user->identity->role == User::ROLE_SELLER) : ?>

<div class="sidebar visible-lg">
   <div class="empty-space col-xs-b40 col-sm-b40"></div>
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
     
	 

       
		  
              
							
							
						
                        
                            <div class="h3"><?= Yii::t('app', 'BlaBlaPrice для покупців'); ?>
                            </div>
                        <div class="empty-space col-xs-b15 col-sm-b15"></div> 
						
                        <div class="accordeon style-2">
                            <div class="accordeon-entry">
                                <div class="accordeon-title active"><?= Yii::t('app', 'Це безкоштовно ?'); ?></div>
                                <div class="accordeon-toggle" style="display: block;">
                                    <div class="simple-article"><?= Yii::t('app',
                                            'Так. Ви можете безкоштовно надсилати запити і обмінюватись контактами з обраними продавцями. '); ?></div>
                                </div>
                            </div>
                            <div class="accordeon-entry">
                                <div class="accordeon-title"><?= Yii::t('app', 'Хто бачить мої контакти?'); ?></div>
                                <div class="accordeon-toggle">
                                    <div class="simple-article"><?= Yii::t('app',
                                            'Ви самі обираєте з ким обмінятись контактами. '); ?></div>
                                </div>
                            </div>
                            <div class="accordeon-entry">
                                <div class="accordeon-title"><?= Yii::t('app', 'Чи обовязково обирати продавця? '); ?></div>
                                <div class="accordeon-toggle">
                                    <div class="simple-article"><?= Yii::t('app',
                                            'Не обовязково. Якщо вам не підійшли умови ви можете проігноравати пропозиції , або обмінятись контактами і ще поторгуватись з обраним продавцем.'); ?></div>
                                </div>
                            </div>
                            <div class="accordeon-entry">
                                <div class="accordeon-title"><?= Yii::t('app', 'Чому ціна у пропозиціях змінюється?'); ?></div>
                                <div class="accordeon-toggle">
                                    <div class="simple-article"><?= Yii::t('app',
                                            'Продавці можуть знижувати ціну, конкуруючи між собою..'); ?></div>
                                </div>
                            </div>
                            <div class="accordeon-entry">
                                <div class="accordeon-title"><?= Yii::t('app', 'Чи можу я погодитись на дві пропозиції одночасно?'); ?></div>
                                <div class="accordeon-toggle">
                                    <div class="simple-article"><?= Yii::t('app',
                                            'Після відмови від пропозиції запит знову стає актуальним для всіх зацікавлених продавців та появиться можливість вибору іншої пропозиції '); ?></div>
                                </div>
                            </div>
                            
                            
                        </div>
                    
               
				
				
				
				
				
             
				
                         <div class="empty-space col-xs-b30 col-sm-b30"></div> 
					
						
                     
                            <div class="h3"><?= Yii::t('app', 'BlaBlaPrice для продавців'); ?>
                            </div>
                        <div class="empty-space col-xs-b15 col-sm-b15"></div> 
                        <div class="accordeon style-2">
                            <div class="accordeon-entry">
                                <div class="accordeon-title active"><?= Yii::t('app', 'Що я зможу продавати на BlaBlaPrice ?'); ?></div>
                                <div class="accordeon-toggle" style="display: block;">
                                    <div class="simple-article"><?= Yii::t('app',
                                            'Ви можете пропонувати свої ціни на товари і послуги. Ознойомитись з категоріями товарів та послуг ви можете у кабінеті продавця http://blablaprice.com/cabinet/filter  '); ?></div>
                                </div>
                            </div>
                            <div class="accordeon-entry">
                                <div class="accordeon-title"><?= Yii::t('app', 'Клієнтам з яких регіонів я можу надсилати свої пропозиції?'); ?></div>
                                <div class="accordeon-toggle">
                                    <div class="simple-article"><?= Yii::t('app',
                                            'Сервіс BlaBlaPrice працює в Україні, Польщі, Туреччині, Чехії та Росії. У Вас є можливість отримувати запити лише з вибраних регіонів налаштувавши відповідні фільтри.  '); ?></div>
                                </div>
                            </div>
                            <div class="accordeon-entry">
                                <div class="accordeon-title"><?= Yii::t('app', 'Відправлення пропозиції безкоштовне ?'); ?></div>
                                <div class="accordeon-toggle">
                                    <div class="simple-article"><?= Yii::t('app',
                                            'Так, надсилання пропозицій є безкоштовним. Сервіс BlaBlaPrice знімає комісіюлише за обмін контактами з потенційним покупцем. Ознайомитись з тарифами можна за посиланням '); ?></div>
                                </div>
                            </div>
                            <div class="accordeon-entry">
                                <div class="accordeon-title"><?= Yii::t('app', 'Що робити якщо я отримав СПАМ'); ?></div>
                                <div class="accordeon-toggle">
                                    <div class="simple-article"><?= Yii::t('app',
                                            'Допоможіть виявляти недобросовісних покупців. Надсилайте скаргу на запити, що містять ознаку спаму. '); ?></div>
                                </div>
                            </div>
							 <div class="accordeon-entry">
                                <div class="accordeon-title"><?= Yii::t('app', 'Як я можу торгуватись за клієнта?'); ?></div>
                                <div class="accordeon-toggle">
                                    <div class="simple-article"><?= Yii::t('app',
                                            'Продавцеві доступна інформація про найнижчу ціну по кожній з запропонованих Вами пропозицій. Це дає змогу здійснювати аукціонні торги, конкуруючи за кожне замовлення. '); ?></div>
                                </div>
                            </div>
							 <div class="accordeon-entry">
                                <div class="accordeon-title"><?= Yii::t('app', 'Скільки часу я можу надсилати пропозиції на запит клієнта?'); ?></div>
                                <div class="accordeon-toggle">
                                    <div class="simple-article"><?= Yii::t('app',
                                            'Кожне замовлення має дед-лайн, встановлений покупцем. Впродовж цього у Вас буде можливість надсилати пропозиції. '); ?></div>
                                </div>
                            </div>
							<div class="accordeon-entry">
                                <div class="accordeon-title"><?= Yii::t('app', 'Чи може клієнт погодитись на дві пропозиції одночасно?'); ?></div>
                                <div class="accordeon-toggle">
                                    <div class="simple-article"><?= Yii::t('app',
                                            'Після відмови покупцем від пропозиції запит знову стає актуальним для всіх зацікавлених продавців та появиться можливість для повторного надсилання пропозицій.  '); ?></div>
                                </div>
                            </div>
                            <div class="accordeon-entry">
                                <div class="accordeon-title"><?= Yii::t('app', 'Як залишити відгук про клієнта?'); ?></div>
                                <div class="accordeon-toggle">
                                    <div class="simple-article"><?= Yii::t('app',
                                            'Відгук є основним критерієм довіри та рейтингу продавця. Обов’язково обмінюйтесь відгуками після кожної завершеної операції купівлі-продажу.'); ?></div>
                                </div>
                            </div>
                            <div class="accordeon-entry">
                                <div class="accordeon-title"><?= Yii::t('app', 'Що робити якщо клієнт залишив про мене негативний відгук. '); ?></div>
                                <div class="accordeon-toggle">
                                    <div class="simple-article"><?= Yii::t('app',
                                            'На сервісі є можливість заміни відгуків. Узгоджуйте всі розбіжності з покупцем та покращіть свій рейтинг отримуючи лише позитивні відгуки.'); ?></div>
                                </div>
                            </div>
                            
                        </div>
                 
					<div class="empty-space col-xs-b30 col-sm-b30"></div> 
						 <div class="inner-block fixed-desktop fixed-desktop-right " >
						 <div class="user-photo-left icon-logo">
						<img src="/img/icon-logo.png" alt="">
					</div>
                   <div class="container">
                      
						
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
<div class="float-container-bottom hidden-lg" >
            <div class="footer-main-link">

               <a href="/cabinet/order" class="link-footer"><i class="icon-login"></i><span> <?= Yii::t('app', 'Запити'); ?></a>
               <a href="/cabinet/offer" class="link-footer  "><i class="icon-logout"></i><span> <?= Yii::t('app', 'Пропозиції'); ?></span></a>
               <a href="/cabinet/accepted" class="link-footer "><i class="icon-users-outline"></i><span> <?= Yii::t('app', 'Контакти'); ?></span></a>
               <a href="/cabinet/comment" class="link-footer "><i class="icon-chat-alt"></i><span> <?= Yii::t('app', 'Відгуки'); ?></span></a>




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

    <div class="video-popup">
        <a class="button style-3 size-3 shadow close-video" href="#">
                <span>
                    <?= Html::img('/img/icon-1.png') ?>
                </span>
        </a>
        <div class="video-container">

        </div>
    </div>

    <!-- SCRIPTS BEGIN -->
    <script type='text/javascript'>
        $(function () {
            var datepickerInterval;

            $('#datepicker').pickadate({
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