<?php

use yii\helpers\Html;
use common\models\User;
use yii\helpers\Url;
use common\models\Order;
use yii\widgets\ActiveForm;

$this->title = 'Terms of use';
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
	 <div class="float-container-min ">
			<div class="container-min">
				<div class="h3-float-container">
					  Policy of confidentiality.
				</div>
			</div>
		</div>
	  <div class="float-container" style="background-color: #fff;">
	     
      <div class="container">
      <div class="empty-space col-xs-b65 col-sm-b65"></div>
	



        <div class="page__section simple-article">
           
                <p class="paragraph">
                    
                        These privacy rules (further "Rules") are an integral part of the public offer for the provision of services (further "Public offer"). The terms and concepts used in these rules are similar to the terms and concepts used in the main text of the public offer.
                    
                    
                        Using the resource, as well as the services and services provided by the company, the user expresses his agreement to these rules. If the user refuses to comply with these rules, he is obliged to stop using the resource. The rules apply to any services offered by the company through the blablaprice.com domain.

                    
                </p>
                <p class="paragraph">The rules apply to any services offered by the company through the blablaprice.com domain.</p>
           
        </div>
		 <div class="empty-space col-xs-b20 col-sm-b20"></div>

        <div class="page__section simple-article">
            <div class="paragraph-title h3">The concept of confidential information.</div>
           
                <p class="paragraph">
                    
                        
                            Confidential is understood as all identifying information received by the company from the visitor and / or user during his stay on the company's websites and / or when using the services provided by the company. This information, if necessary, can be used to contact the user and / or visitor, both online or in other ways. Personal data is an integral part of confidential information provided by the user and / or visitor exclusively on a voluntary basis and with his agreement. To access the company's resource, the provision of confidential information is not necessary, but in this case some sections of the services may not be available.                        
                    
                </p>
                <br>

                <div><b>The composition of confidential information:</b></div>
                <ol class="decimal-list">
                    <li class="decimal-list__item">
                        Personal data
                    </li>
                    <li class="decimal-list__item">
                        Cookie files
                    </li>
                    <li class="decimal-list__item">
                        Server logs
                    </li>
                </ol>
                <br>

                <div><b>Composition of personal data:</b></div>
                <ol class="decimal-list">
                    <li class="decimal-list__item">
                        Surname, name, patronymic
                    </li>
                   
                    <li class="decimal-list__item">
                        E-mail address
                    </li>
                   
                   
                    <li class="decimal-list__item">
                        Mobile phone number
                    </li>
                    <li class="decimal-list__item">
                        User’s photo
                    </li>
                    
                       
                    
                </ol>
                <br>

                <div><b>Purpose of collecting confidential information:<b></div>
                <ol class="decimal-list">
                    <li class="decimal-list__item">
                        User’s registration
                    </li>
                    <li class="decimal-list__item">
                        Maintenance of the services, resource and the provision of company’s services.
                    </li>
                    <li class="decimal-list__item">
                        Conducting marketing research and statistics gathering. 
                    </li>
                    <li class="decimal-list__item">
                        Improving company’s services.
                    </li>
                    <li class="decimal-list__item">
                        The ability to make changes to the user’s account in case of unforeseen situations (for example, password recovery in case of theft).
                    </li>
                </ol>
                <br>

                <div><b>Use of the personal information.</b></div>
                <p>The company undertakes not to facilitate the dissemination of users’ personal data and not to transfer this information to third parties, with the exception of the following cases:</p>
                <ol class="decimal-list">
                    <li class="decimal-list__item">
                        The user voluntarily and explicitly wished to disclose this information.
                    </li>
                    <li class="decimal-list__item">
                        
                        Personal data shall be disseminated in accordance with the current legislation of Ukraine.
                        
                    </li>
                    <li class="decimal-list__item">
                        The user has violated the public offer.
                    </li>
                    <li class="decimal-list__item">
                        With the prior agreement of the user, expressed through the services of the resource.
                    </li>
                </ol>
                <p>The company can conduct statistical, demographic and marketing research using confidential information. The results of these studies are not confidential information. In any case, the company guarantees that the research results will be used without any connection with the personal information provided by the user and will not allow to identify a specific user. The user expresses his agreement to receive personal messages from the administration on the e-mail address at any time and of any form, including advertising.

</p>
           
        </div>
		<div class="empty-space col-xs-b20 col-sm-b20"></div>
        <div class="page__section simple-article">
            <div class="paragraph-title h3">User’s posting information when using the resource.</div>
           
                <p>The user may, at his request, provide third parties with any information about himself in the course of using the resource. This information is regarded as publicly available, and therefore the company does not bear any responsibility for the consequences of such actions by the user. The user guarantees that the information which is provided to third parties and the company can not:</p>
                <ol class="decimal-list">
                    <li class="decimal-list__item">
                        be false, inaccurate or misleading;
                    </li>
                    <li class="decimal-list__item">
                        promote fraud, deceit or breach of trust;
                    </li>
                    <li class="decimal-list__item">
                        violate or infringe on the property of a third party, his trade secret or his right to privacy;
                    </li>
                    <li class="decimal-list__item">
                        call for the commission of a crime, as well as to incite ethnic hatred;
                    </li>
                    <li class="decimal-list__item">
                        contain information that offends anyone's honor, dignity, or business reputation, defamation or threats to anyone;
                    </li>
                    <li class="decimal-list__item">
                        be obscene, or be pornographic or erotic;
                    </li>
                    <li class="decimal-list__item">
                        the profile photo can only be a real user’s photo. It is forbidden to use other people's pictures and photos as a profile photo. The person in the profile photo should be clearly visible and occupy at least 50 % of the photo;
                    </li>
                    <li class="decimal-list__item">
                        contain computer viruses, as well as other computer programs aimed, in particular, at causing harm, unauthorized intrusion, secretive interception or misappropriation of data;
                    </li>
                    <li class="decimal-list__item">
                        contain promotional material;
                    </li>
                    <li class="decimal-list__item">
                        
                            violate the other way the current legislation of Ukraine;
                        
                    </li>
                </ol>
           
        </div>
		<div class="empty-space col-xs-b20 col-sm-b20"></div>

        <div class="page__section simple-article">
            <div class="paragraph-title h3">Collection and storage of confidential information.</div>
           
                <p>
                    
                        The company collects, stores and uses confidential information in strict accordance with these rules. The company takes all necessary measures to ensure that the information received is properly stored and used. The collection of confidential information occurs automatically when visiting the resource and using the company's services, as well as when filling in the offered forms by the user and / or the visitor.
                        
                    
                </p>
                <p>
                    
                        The company does its best to minimize the risk of unauthorized access to confidential information and the risk of its misuse, but assumes no responsibility in the case of access to confidential information by third parties. In case of disputes arising from the use of the company's resources and services, as well as in other cases stipulated by the public offer on the use of the resource "blablaprice.com" or the current legislation of Ukraine. The user and / or the visitor undertakes to provide the company with personal data upon its request and also in written form. The company reserves the right to keep all confidential information concerning the user for 5 years after the user’s refuse to use the resource "blablaprice.com", including changes and changed personal data.


                    
                </p>
           
        </div>



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