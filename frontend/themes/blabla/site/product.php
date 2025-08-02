<?php

use common\models\Order;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\User;
use yii\helpers\Url;


/**
 * @var \common\models\Product $product
 * @var \common\models\Order $order
 */

$session = null;
if (Yii::$app->session->has('filter-session')) {
    $session = Yii::$app->session->get('filter-session');
    Yii::$app->session->destroy();
}



// generate regions
$user = User::findOne(['ID' => Yii::$app->user->id]);
$regionList = [];
$regionList = array_merge($regionList, Yii::$app->params['region'][$_SESSION['language']]);

$lastRegion = Order::find()->where(['userID' => Yii::$app->user->id])->orderBy(['created_at' => SORT_DESC])->one();

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

  <div class="inner-block fixed-desktop fixed-desktop-left  " >
               <div class="container circle">
			   
				   <div class="text-how-it-works " >
				   <?= Yii::t('app', 'У вас хороші ціни на'); ?><b> <?php echo $product->category->name ?></b>			  
				   </div>
				    <div class="empty-space col-xs-b5 col-sm-b5"></div> 
				   <a class="link-how-it-works-2  open-static-popup " data-rel="registration-seller" >
                        <?= Yii::t('app', 'Реєстрація продавця'); ?>
                      </a> 
			    </div>
			 
  </div>	
<?php endif;?>
		   
	 
        <div class="sidebar-content">
		 <div class="float-container">
           <div class="container">
		   
		   <div class="empty-space col-xs-b40 col-sm-b40"></div> 
		   
		    
       
			<div class="blabla-comment">
				<div class="user-photo-left icon-logo">
					<img src="/img/icon-logo.png" alt="">
				</div>
				  <?= Yii::t('app', 'Вкажіть деталі і порівняйте пропозиції від '); ?>
                    <b><?php echo $free_user ?></b>
                    <?= Yii::t('app', ' компаній з категорії '); ?>  "<?php echo $product->category->name ?>"
					
			</div>
		 
		 

         
			
			  
		
		 <div class="empty-space col-xs-b10 col-sm-b10"></div>   
         <div class="inner-block-2 ">
            <div class="container">
			  <div class="empty-space col-xs-b10 col-sm-b10"></div> 
			  <h1>  <?= Yii::t('app', 'Заявка на '); ?><?php echo $product->name ?></h1>
                <?php
                $form = ActiveForm::begin([
                    'options' => ['class' => 'filter-form-product']
                ]);

                echo $form->field($order, 'categoryID')->hiddenInput(['value' => $product->categoryID])
                    ->label(false);

                echo $form->field($order, 'productID')->hiddenInput(['value' => $product->ID])
                    ->label(false);

                echo $form->field($order, 'status')->hiddenInput(['value' => Order::STATUS_ACTIVE])
                    ->label(false);

                if (!Yii::$app->user->isGuest) {
                    echo $form->field($order, 'userID')->hiddenInput(['value' => Yii::$app->user->id])
                        ->label(false);
                }

                ?>




				
                 
				 
           







         

              
              
               <div class="empty-space col-xs-b25 col-sm-b25"></div>
                <div class="row m10">
                   
                    <div class="col-md-12">
                       
                           
                                <div class="price-input">
                                    <div class="cust-tooltip">
									
                                        <?= $form->field($order, 'priceFrom')->textInput([
                                            'type' => 'number',
											'id'=>'alert',
                                            'class' => 'simple-input size-5 must-be must-be-blue',
                                            'placeholder' => Yii::t('app', 'Бажана ціна'),
											
                                            'required' => true,
                                        ])->label(false) ?>

                                        <div class="tooltip-content left-price-2">
                                         <?= Yii::t('app', ' У продавців стоїть "ФІЛЬТР ПО ЦІНІ" на отримання нових запитів, тому вкажіть максимальну ціну яку ви готові заплатити. Усім продавцям ми покажемо найнижчу запропоновану вам ціну, тому мінімальна ціна постійно буде зменшуватись, поки ви не оберете одну з пропозицій'); ?>
                                        </div>
											 <div class="up-label">
                                                     <?= Yii::t('app', 'Вкажіть ціну '); ?>
                                                </div>
                                    </div>
									<span class=""><?= Yii::t('app', 'грн'); ?></span>
                                </div>
                           

                      
                    </div>
                </div>
				<div class="empty-space col-xs-b20 col-sm-b20"></div>
                <div class="row m10">
                    <div class="col-md-11 ">
                        <div class="cust-tooltip">
                            <?php echo $form->field($order, 'comment')->textarea([
                                'class' => 'simple-input',
							
                                'placeholder' => Yii::t('app', 'Коментар')
                            ])->label(false); ?>

                            <div class="tooltip-content left-price">
                                 <?= Yii::t('app', 'Проавці повинні зрозуміти що вам потрібно'); ?>
                            </div>
							 <div class="up-label">
                                                     <?= Yii::t('app', 'Опишіть деталі'); ?>
                                                </div>
                        </div>
                      
                    </div>
                </div>
			
                      
               
                <div class="row m10">
                    
                    <div class="col-md-6">
                    <div class="empty-space col-xs-b20 col-sm-b20"></div> 
						  
                                <div class="datepicker-wrapper full-width">
                                    <div class="cust-tooltip">
                                        <?= $form->field($order, 'deadLine')->textInput([
                                            'class' => 'simple-input size-6 datepicker',
                                            'id' => 'datepicker',
                                            'placeholder' => Yii::t('app', 'Оберіть дату'),
                                            'data-rel' => '1',
                                            //'value' => date("d F, Y", mktime(0, 0, 0, date('m'), date('d') + 10, date('Y'))),
                                            'required' => true,
                                        ])->label(false) ?>
										

                                        <div class="tooltip-content left-data" >
                                            <?= Yii::t('app', 'Доки ви готові чекати на пропозиції'); ?>
                                        </div>
										  <div class="up-label">
													 
                                                     <?= Yii::t('app', 'Готовий чекати'); ?>
													 <div class="time-entry" data-rel="1">
                                            <div class="entry"><span class="days">0</span><?= Yii::t('app', ' днів'); ?>
                                            </div>
                                            <div class="entry"><span class="hours">0</span><?= Yii::t('app', ' год'); ?>
                                            </div>
                                           
                                        </div>
                                                     </div>
                                    </div>
                              
                                </div>
                           
                           
                       
                    </div>
              
                           
                          
                               
                                    <div class="col-md-6 ">
									 <div class="empty-space col-xs-b20 col-sm-b20"></div> 
                                        <div class="select-wrapper size-5">

                                            <div class="cust-tooltip">
                                               <select name="regionID" class="SlectBox SumoUnder">
                                                   <?php foreach ($regionList as $key => $region) : ?>
                                                       <option value="<?php echo $key; ?>" <?php if ($key == $lastRegion->regionID) echo "selected"; ?>><?php echo $region; ?></option>
                                                   <?php endforeach; ?>
                                               </select>

                                               <div class="tooltip-content left-region">
                                                    <?= Yii::t('app', 'Ваш запит отримають продавці з обраного регіону'); ?>
                                               </div>
											   <div class="up-label">
                                                     <?= Yii::t('app', 'Регіон продавців'); ?>
                                              </div>	
                                            </div>
                                        </div>
                                    </div>
                                 
                             
                           
                        </div>
                
                <div class="empty-space col-xs-b25 col-sm-b15"></div>
                <div class="text-right">
                    <div class="inline-align-middle">
                        <div class="empty-space col-xs-b5"></div>
                       
                        <div class="empty-space col-xs-b5"></div>
                    </div>
                    <div class="inline-align-middle">
                        <?php
                            $linkClass = 'open-static-popup';
                            $linkDataRel = 'registration-user-phone';
                        if ($user->phone_approved !== '0000-00-00 00:00:00') {
						         $linkClass = 'submit-form';
                                 $linkDataRel = '';	
                        }
						
						if (Yii::$app->user->isGuest) {
                            $linkClass = 'open-static-popup';
                            $linkDataRel = 'account-login';
                        }
						
						
                        echo Html::a('<span>' . Yii::t('app', 'Надіслати ') .  $free_user . Yii::t('app', ' продавцям') . '</span>', null, [
                            'class' => 'button style-1 size-1 shadow ' . $linkClass,
                            'data-rel' => $linkDataRel
                        ]);
                        ?>
                    </div>
                </div>
                <div class="empty-space col-xs-b20 col-lg-b20"></div>

                <?php ActiveForm::end(); ?>

            </div>
		

      
		  </div>
		    <div class="empty-space col-xs-b30 col-lg-b30"></div>
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
	 <div class="empty-space col-xs-b30 col-lg-b30"></div>
	 
	</div>
  </div>
</div>
	
	 
   
</div>

<?= $this->render('footer') ?>

<div class="popup-wrapper">
    <div class="close-layer"></div>

    <div class="popup-content" data-rel="detail-popup">
        <div class="popup-container wide">
            <div class="popup-header popup-paddings-wide">
                <?= $product->getName() ?>
                <a class="button style-10 size-3 shadow close-popup">
                    <span><img src="/img/icon-47.png" alt=""></span>
                </a>
            </div>
            <div class="popup-paddings-wide">
                <div class="empty-space col-xs-b25 col-sm-b50"></div>
                <div class="specs-overflow">
                    <?= $product->getDescription() ?>
                </div>
                <div class="empty-space col-xs-b10"></div>
                <div class="empty-space col-xs-b25 col-sm-b50"></div>
            </div>
        </div>
    </div>

    <div class="popup-content" data-rel="11">
        <div class="popup-container text">
            <a class="button style-3 size-3 shadow close-popup" href="#">
                <span>
                    <?= Html::img('/img/icon-1.png') ?>
                </span>
            </a>
            <div class="popup-paddings">
                <img class="text-popup-image hidden-xs" src="/img/icon-65.png" alt=""/>
                <div class="row">
                    <div class="col-sm-7 col-sm-offset-5">
                        <div class="empty-space col-xs-b40 col-sm-b80"></div>
                        <div class="h3"><b><?= Yii::t('app', 'Вашу заявку прийнято!'); ?></b></div>
                        <div class="empty-space col-xs-b20"></div>
                        <div class="simple-article large">
                            <?= Yii::t('app', 'Ваше оголошення додано у нашу базу і надіслано усіх
                            продавцям. Найближчим часом Ви отримаєте пропозиції на пошту та в кабінеті'); ?>
                        </div>
                        <div class="empty-space col-xs-b20"></div>
                        <div class="button style-1 size-1 shadow">
                            <span>
                                <?= Yii::t('app', 'ПРОДОВЖИТИ ПОШУК'); ?>
                            </span>
                            <input type="submit"/>
                        </div>
                        <div class="empty-space col-xs-b40 col-sm-b80"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if (Yii::$app->user->isGuest) : ?>

        <?= $this->render('@app/themes/blablaprice/popup/popup-account-login') ?>

        <?= $this->render('@app/themes/blablaprice/popup/popup-account-registration') ?>

        <?= $this->render('@app/themes/blablaprice/popup/popup-account-reset-password') ?>

    <?php else : ?>

        <?= $this->render('@app/themes/blablaprice/popup/popup-phone-verification') ?>

    <?php endif; ?>

    <?= $this->render('@app/themes/blablaprice/popup/language'); ?>
</div>