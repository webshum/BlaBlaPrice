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
					  <?= Yii::t('app', 'Політика конфіденційності'); ?>
				</div>
			</div>
		</div>
	  <div class="float-container" style="background-color: #fff;">
	     
      <div class="container">
      <div class="empty-space col-xs-b65 col-sm-b65"></div>
	



        <div class="page__section simple-article">
           
                <p class="paragraph">
                    
                        Настоящие Правила конфиденциальности (далее - “Правила”) являются
                        неотъемлемой частью Публичной Оферты на оказание услуг (далее - “Публичная Оферта”).
                        Термины и понятия, используемые в настоящих Правилах аналогичны терминам и понятиям,
                        используемым в основном тексте Публичной Оферты.
                    
                    
                        Используя ресурс, а также Сервисы и Услуги, предоставляемые Компанией,
                        Пользователь выражает свое согласие с данными Правилами.
                        В случае отказа Пользователя от соблюдения данных Правил,
                        он обязан прекратить использование Ресурса.
                    
                </p>
                <p class="paragraph">Правила распространяются на любые Услуги и Сервисы, предлагаемые Компанией через домен blablaprice.com.</p>
           
        </div>
		 <div class="empty-space col-xs-b20 col-sm-b20"></div>

        <div class="page__section simple-article">
            <div class="paragraph-title h3">Понятие конфиденциальной информации</div>
           
                <p class="paragraph">
                    
                        
                            Под конфиденциальной понимается вся идентифицирующая информация,
                            полученная Компанией от Посетителя и/или Пользователя во время его
                            пребывания на сайтах Компании и/или при использовании Сервисов,
                            предоставляемых Компанией. Эта информация, в случае необходимости,
                            может быть использована для контактов с Пользователем и/или Посетителем,
                            как в онлайн режиме, так и другими способами.
                            Персональные данные являются составляющей частью конфиденциальной информации,
                            предоставляемой Пользователем и/или Посетителем исключительно
                            на добровольной основе и с его согласия. Для доступа к ресурсу
                            Компании предоставление конфиденциальной информации необязательно,
                            но в этом случае некоторые разделы Сервисы и Услуги могут оказаться недоступными.
                        
                    
                </p>
                <br>

                <div><b>Состав конфиденциальной информации:</b></div>
                <ol class="decimal-list">
                    <li class="decimal-list__item">
                        Персональные данные.
                    </li>
                    <li class="decimal-list__item">
                        Файлы cookie.
                    </li>
                    <li class="decimal-list__item">
                        Журналы серверов.
                    </li>
                </ol>
                <br>

                <div><b>Состав персональных данных:</b></div>
                <ol class="decimal-list">
                    <li class="decimal-list__item">
                        Фамилия, имя, отчество.
                    </li>
                   
                    <li class="decimal-list__item">
                        Адрес электронной почты.
                    </li>
                   
                   
                    <li class="decimal-list__item">
                        Номер мобильного телефона.
                    </li>
                    <li class="decimal-list__item">
                        Фотография пользователя.
                    </li>
                    
                       
                    
                </ol>
                <br>

                <div><b>Цели сбора конфиденциальной информации:</b></div>
                <ol class="decimal-list">
                    <li class="decimal-list__item">
                        Регистрация Пользователей.
                    </li>
                    <li class="decimal-list__item">
                        Обеспечение функционирования Сервисов, Ресурса и оказание Услуг Компанией.
                    </li>
                    <li class="decimal-list__item">
                        Проведение маркетинговых исследований и сбор статистики.
                    </li>
                    <li class="decimal-list__item">
                        Улучшение Сервисов и Услуг Компании.
                    </li>
                    <li class="decimal-list__item">
                        Возможность внесения изменений в учетную запись Пользователя в случае возникновения непредвиденных ситуаций (например, восстановление пароля в случае его кражи).
                    </li>
                </ol>
                <br>

                <div><b>Использование личной информации</b></div>
                <p>Компания обязуется не способствовать распространению персональных данных Пользователей и не передавать данную информацию третьим лицам, за исключением следующих случаев:</p>
                <ol class="decimal-list">
                    <li class="decimal-list__item">
                        Пользователь добровольно и явным образом пожелал раскрыть эту информацию;
                    </li>
                    <li class="decimal-list__item">
                        
                            Персональные данные подлежат распространению в соответствии с действующим законодательством Украины.
                        
                    </li>
                    <li class="decimal-list__item">
                        Пользователь допустил нарушение Публичной Оферты;
                    </li>
                    <li class="decimal-list__item">
                        С предварительного согласия Пользователя, явно выраженного посредством Сервисов ресурса.
                    </li>
                </ol>
                <p>Компания может проводить статистические, демографические и маркетинговые исследования, используя конфиденциальную информацию. Результаты данных исследований не являются конфиденциальной информацией. В любом случае Компания гарантирует, что результаты исследований будут использоваться без какой-либо связи с личной информацией, представленной Пользователем и не позволят идентифицировать конкретного Пользователя. Пользователь выражает свое согласие на получение личных сообщений от Администрации на адрес электронной почты в любое время и любого характера, в том числе и рекламного.</p>
           
        </div>
		<div class="empty-space col-xs-b20 col-sm-b20"></div>
        <div class="page__section simple-article">
            <div class="paragraph-title h3">Размещение Пользователем информации о себе при использовании ресурса</div>
           
                <p>Пользователь может по своему желанию предоставлять третьим лицам любую информацию о себе в ходе пользования Ресурсом. Данная информация расценивается как общедоступная, и, следовательно, Компания не несет никакой ответственности за последствия таких действий Пользователя. Пользователь гарантирует, что информация, предоставляемая третьим лицам и Компании не может:</p>
                <ol class="decimal-list">
                    <li class="decimal-list__item">
                        быть ложной, неточной или вводящей в заблуждение;
                    </li>
                    <li class="decimal-list__item">
                        способствовать мошенничеству, обману или злоупотреблению доверием;
                    </li>
                    <li class="decimal-list__item">
                        нарушать или посягать на собственность третьего лица, его коммерческую тайну либо его право на неприкосновенность частной жизни;
                    </li>
                    <li class="decimal-list__item">
                        призывать к совершению преступления, а также разжигать межнациональную рознь;
                    </li>
                    <li class="decimal-list__item">
                        содержать сведений, оскорбляющих чью-либо честь, достоинство или деловую репутацию, клевету или угроз кому бы то ни было;
                    </li>
                    <li class="decimal-list__item">
                        быть непристойными, либо носить характер порнографии или эротики;
                    </li>
                    <li class="decimal-list__item">
                        фотографией профиля может служить только реальная фотография пользователя. Запрещено использовать картинки и фотографии других людей в качестве фотографии профиля. Лицо на фотографии профиля должно быть отчетливо видно и занимать не менее 50%% фотографии;
                    </li>
                    <li class="decimal-list__item">
                        содержать компьютерные вирусы, а также иные компьютерные программы, направленные, в частности, на нанесение вреда, неуполномоченное вторжение, тайный перехват либо присвоение данных;
                    </li>
                    <li class="decimal-list__item">
                        содержать материалы рекламного характера;
                    </li>
                    <li class="decimal-list__item">
                        
                            иным образом нарушать действующее законодательство Украины.
                        
                    </li>
                </ol>
           
        </div>
		<div class="empty-space col-xs-b20 col-sm-b20"></div>

        <div class="page__section simple-article">
            <div class="paragraph-title h3">Сбор и хранение конфиденциальной информации</div>
           
                <p>
                    
                        Компания осуществляет сбор, хранение и использование конфиденциальной
                        информации в строгом соответствии с настоящими Правилами.
                        Компания принимает все необходимые меры для того, чтобы надлежащим
                        образом обеспечить хранение и использование полученной информации.
                    
                    
                        
                            Сбор конфиденциальной информации происходит автоматически при посещении
                            ресурса и использовании Сервисов и Услуг Компании,
                            а также при заполнении Пользователем и/или Посетителем предлагаемых форм.
                        
                    
                </p>
                <p>
                    
                        Компания делает все возможное, чтобы свести к минимуму риск несанкционированного
                        доступа к конфиденциальной информации, а также риск ее ненадлежащего использования,
                        однако не несет никакой ответственности в случае получения доступа к конфиденциальной
                        информации третьими лицами.
                    
                    
                        
                            В случае возникновения спорных ситуаций при использовании ресурса,
                            Услуг и Сервисов Компании, а также в иных случаях,
                            предусмотренных Публичной Офертой об использовании ресурса “blablaprice.com”
                            или действующим законодательством Украины, Пользователь и/или Посетитель обязуется предоставить
                            Компании персональные данные по ее запросу, в том числе и в письменном виде.
                        
                    
                    
                        Компания оставляет за собой право хранить всю конфиденциальную информацию, касающуюся Пользователя
                        в течение 5 лет после отказа Пользователя от использования ресурса “blablaprice.com”,
                        в том числе изменяемые и измененные персональные данные.
                    
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