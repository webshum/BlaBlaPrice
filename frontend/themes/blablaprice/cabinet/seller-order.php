<?php

use yii\helpers\Url;
use common\models\User;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use frontend\models\UserFilter;
use yii\widgets\LinkPager;
use yii\web\Session;
use frontend\models\SignupForm;

// generate regions
$user = User::findOne(['ID' => Yii::$app->user->id]);
$regionList = [];
$regionList = array_merge($regionList, Yii::$app->params['region'][$_SESSION['language']]);

/**
 * @var \yii\web\View $this
 * @var \common\models\User $user
 * @var \common\models\Order[] $orders
 * @var \common\models\Order $order_item
 * @var \common\models\Offer $offer
 * @var \yii\data\Pagination $pages
 */
//var_dump($orders);
 
$user = User::findOne(['ID' => Yii::$app->user->ID]);

$session = Yii::$app->session;

// Set current user phone :
if (Yii::$app->user->isGuest) {
    $user = new \common\models\User();
} else {
    $user = Yii::$app->user->identity;
}

$userFilters = UserFilter::find()->where(['userID' => Yii::$app->user->id])->one();

$category = [];
$region = [];
$countOrdersFilters = 0;
foreach ($orders as $orderCategory) {
    if (!empty($orderCategory->regionID)) {
        $category[$orderCategory->categoryID] = $orderCategory->category->name;
        $region[$orderCategory->regionID] = Yii::$app->params['region'][$_SESSION['language']][$orderCategory->regionID];
    }
}

?>

<div id="content-block" class="page-order-seller">

    <?= $this->render('seller-sidebar', ['active' => 'order']) ?>

    <div class="sidebar-content">
	<div class="float-container-min seller">
		  
                <div class="container-min" >
                   <div class="h3-float-container"><?php echo $this->context->count_orders ?>
					    <?= Yii::t('app', '  Запитів '); ?>
				   </div>
				   <a  href="<?= Url::to(['cabinet/filter']) ?>">
                <div class="buttons-block" >
                   <div class="button-clear" style="float:right">
                   <i class="icon-sliders"></i>
				   <?php echo (!empty($userFilters->count)) ? $userFilters->count : 1; ?>
					    <?= Yii::t('app', ' Фільтрів '); ?>
				   </div>
                </div>
			</a>
                </div>
			
		
			 
        </div>
        <div class="float-container">
            <div class="container">
               
                <?php if ($this->context->count_orders == 0): ?>
                  
					<div class="empty-space col-xs-b60 col-sm-b60"></div>
                  <div class="simple-article large dark text-center  ">
                    <h3 class="h3">
                        <?= Yii::t('app', 'Спробуйте налаштувати фільтри') ?>
						
                    </h3>
					
					 <?= Yii::t('app', 'Ми вас повідомимо про нові запити') ?>
					 </div>
                <?php endif; ?>
               <div class="empty-space col-xs-b40 col-sm-b40"></div>

                   
                      
                      


               

                   
                   
                        <?php foreach ($orders as $order_item) : ?>
                                <?php if ($order_item->product) : ?>
                                    <div class="inner-block-4 order open-popup" data-param="<?= $order_item->getID() ?>" data-rel="seller-order">
									    <div class="simple-article large dark ">
											<div class="open-popup-icon">
														<i class="icon-popup "></i>
											</div> 
                                                
											<div class="product-name"> <?= !is_null($order_item->product->category) ? $order_item->product->category->getName() : '' ?> </div>
											<span class="user-name">
												<?php echo Yii::t('app', 'Запит від '); ?>
												<span class="cust-tooltip " >
													<span class="popup-user-name-first-letter"> <?php echo $order_item->user->userName; ?></span>
													<div class="tooltip-content left-user-popup" >
														<b><?= Yii::t('app', 'Телефон перевірено.'); ?> </b><br> 
														<b><?= Yii::t('app', 'Оцінки :'); ?> </b><br>  
														<b><?php echo $order_item->user->countPositive; ?> </b> <?= Yii::t('app', '    позитивних '); ?>   <br>  
														<b><?php echo $order_item->user->countNeutral; ?> </b> <?= Yii::t('app', '    нейтральних '); ?>    <br>
														<b><?php echo $order_item->user->countNegative; ?> </b><?= Yii::t('app', '    негативних '); ?>    <br> 
                           
													</div> 
													<i class="icon-ok "></i>
												</span>
											</span>
										 
											<div class="left-cloud">
											
											
												<div class="user-photo-left">
													<div class="first-letter">
														<?php  $string = mb_substr(strip_tags( $order_item->user->username ), 0, 1);echo $string   ; ?>
													</div> 
												</div> 											
                                            
												 <b><?= Yii::t('app', 'Бюджет') .' '.  $order_item->getPriceFrom() . Yii::t('app', ' грн'); ?></b></br>
												            <?= !is_null($order_item->product) ? $order_item->product->getName() : '' ?> ,<?php
                                                            $string = strip_tags($order_item->getComment());
                                                            $string = substr($string, 0, 100);
                                                            $string = rtrim($string, "!,.-");
                                                            $string = substr($string, 0, strrpos($string, ' '));
                                                            echo $string . "… ";
                                                            ?>
												<div class="row">
													<div class="col-md-12">
													
													<div class="text-grey-icon-cabinet ">
													    <div style="display: none" id="datepicker"><?php echo strtotime($order_item->deadLine) * 1000; ?></div>
											  
												    <div class="time-entry inline-align-middle" data-rel="17">
                                                       <div class="inline-align-middle">
                                                       <span class="days2">
                                                         <?php 
                                                           $now=new DateTime(); 
                                                           $date = DateTime::createFromFormat("Y-m-d H:i:s", $order_item->deadLine); 
                                                           $interval = $now->diff($date); 
                                                           echo $interval->d>0?'<i class="icon-hourglass "></i>'.$interval->d:'<i class="icon-fire-station "></i>'.$interval->h;
                                                         ?>
                                                       </span><?=$interval->d>0?Yii::t('app', ' днів '):Yii::t('app', ' годин '); ?>
                                                       
                                                       </div>
                                                    </div>	
													</div>
													<div class="text-grey-icon-cabinet ">
													
														<i class="icon-location-4 "></i>
														<span>
															<?php echo $regionList[$order_item->regionID];  ?>
														</span>
													</div>
												
												</div>
												</div>
											</div>
										</div>
										
											
											
										
										</div>
                                <?php else : ?>
                                        <div class="inner-block-4 order open-popup" data-param="<?= $order_item->getID() ?>" data-rel="seller-order">
                                            <div class="simple-article large dark left-block">
												<div class="open-popup-icon">
														<i class="icon-popup "></i>
												</div> 
                                                <div class="product-name"> <?= !is_null($order_item->category) ? $order_item->category->getName() : '' ?></div>
                                                <span class="user-name">
												<?php echo Yii::t('app', 'Запит від '); ?>
												<span class="cust-tooltip " >
													<span class="popup-user-name-first-letter"> <?php echo $order_item->user->userName; ?></span>
													<div class="tooltip-content left-user-popup" >
														<b><?= Yii::t('app', 'Телефон перевірено.'); ?> </b><br> 
														<b><?= Yii::t('app', 'Оцінки :'); ?> </b><br>  
														<b><?php echo $order_item->user->countPositive; ?> </b> <?= Yii::t('app', '    позитивних '); ?>   <br>  
														<b><?php echo $order_item->user->countNeutral; ?> </b> <?= Yii::t('app', '    нейтральних '); ?>    <br>
														<b><?php echo $order_item->user->countNegative; ?> </b><?= Yii::t('app', '    негативних '); ?>    <br> 
                           
													</div> 
													<i class="icon-ok "></i>
												</span>
												</span>
												<div class="left-cloud">
											
													<div class="user-photo-left">
													<div class="first-letter">
														<?php  $string = mb_substr(strip_tags( $order_item->user->username ), 0, 1);echo $string   ; ?>
													</div> 
												</div> 	
												
											
                                             
												  <b><?= Yii::t('app', 'Бюджет') .' '.  $order_item->getPriceFrom() . Yii::t('app', ' грн'); ?></b></br>

                                                                <?php
                                                                $string = '';
                                                                $filter = explode('; ', $order_item->filter);
                                                                foreach ($filter as $filter_item) {
                                                                    $filter_value = explode(': ', $filter_item);
                                                                    if ($filter_value[0] != '' && isset($filter_value[1])) {
                                                                        $string .= '<b>' . $filter_value[0] . ':</b> ' . $filter_value[1] . '; ';
                                                                    }
                                                                }

                                                                $string = substr($string, 0, 120);
                                                                $string = rtrim($string, "!,.-");
                                                                $string = substr($string, 0, strrpos($string, ' '));
                                                                echo $string . "… ";
                                                                ?>


                                                            <?php
                                                            $string = strip_tags($order_item->getComment());
                                                            $string = substr($string, 0, 200);
                                                            $string = rtrim($string, "!,.-");
                                                            $string = substr($string, 0, strrpos($string, ' '));

                                                            ?>
																<div class="row">
																
													<div class="col-md-12">
													<div class="text-grey-icon-cabinet">
													    <div style="display: none" id="datepicker"><?php echo strtotime($order_item->deadLine) * 1000; ?></div>
											  
												    <div class="time-entry inline-align-middle" data-rel="17">
                                                       <div class="inline-align-middle">
                                                       <span class="days2">
                                                         <?php 
                                                           $now=new DateTime(); 
                                                           $date = DateTime::createFromFormat("Y-m-d H:i:s", $order_item->deadLine); 
                                                           $interval = $now->diff($date); 
                                                           echo $interval->d>0?'<i class="icon-hourglass "></i>'.$interval->d:'<i class="icon-fire-station "></i>'.$interval->h;
                                                         ?>
                                                       </span><?=$interval->d>0?Yii::t('app', ' днів '):Yii::t('app', ' годин '); ?>
                                                       
                                                       </div>
                                                    </div>	
													</div>
													<div class="text-grey-icon-cabinet ">
														<i class="icon-location-4 "></i>
														<span>
															<?php echo $regionList[$order_item->regionID];  ?>
														</span>
													</div>
													
													
													</div>
												</div>
        									</div>
											</div>
											
											
											
										
									    </div>
                                <?php endif; ?>
                        <?php endforeach; ?>

                 
                  
             

                <div class="empty-space col-xs-b25 col-sm-b50"></div>

                <div class="pagination-wrapper">

                    <?php
                    $active = false;
                    if($pages->pageCount>1)
                    for ($i = 1; $i <= $pages->pageCount; $i++) :
                        if ($i - 1 == $pages->page) {
                            $active = true;
                        }
                        ?>
                        <a class="button <?= $active ? 'style-31' : 'style-32' ?> inline-block"
                           href="<?= Url::to(['cabinet/order', 'page' => $i]) ?>">
                            <span><?= $i ?></span>
                        </a>
                        <?php
                        $active = false;
                    endfor;
                    ?>
                </div>
                <div class="empty-space col-xs-b20 col-sm-b20"></div>
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
	 <div class="empty-space col-xs-b90 col-sm-b90"></div>	
            </div>
			 
        </div>

		
        <!-- SIDEBAR MOBILE -->
        <?= include 'seller-sidebarmobile.php'; ?>
        <!-- // SIDEBAR MOBILE -->


	<div class="clear"></div>

</div>

<div class="popup-wrapper">
    <div class="close-layer"></div>

    <div class="popup-content" data-rel="detail"></div>
    <div class="popup-content" data-rel="seller-order"></div>
    <div class="popup-content" data-rel="seller-comment"></div>
    <div class="popup-content" data-rel="seller-view-comment"></div>
    <div class="popup-content" data-rel="gallery"></div>

    <?= $this->render('@app/themes/blablaprice/popup/popup-account-registration'); ?>
    <?= $this->render('@app/themes/blablaprice/popup/language'); ?>

    <script type="text/javascript">
        $('#new-phone-number').change(function () {
            var newPhoneNumberChanged = $('#new-phone-number').val();
            $('#new-phone-number-changed').val(newPhoneNumberChanged);
        });

        $('#change-phone').on('beforeSubmit', function () {
            $.ajax({
                url: '/cabinet/change-phone',
                type: 'post',
                data: $(this).closest('form').serialize(),
                dataType: 'json'
            }).done(function (data) {
                if (data.result == true && data.smsSent == true) {
                    $('#phone-number').removeClass('active').hide();
                    $('#sms-code').addClass('active').show();
                } else if (data.result == false && data.message) {
                    $('#phone-number-information').html('<strong>' + data.message + '</strong>');
                }
            });
            return false;
        });

        $('#check-sms').on('beforeSubmit', function () {
            $.ajax({
                url: '/cabinet/check-sms',
                type: 'post',
                data: $(this).closest('form').serialize(),
                dataType: 'json'
            }).done(function (data) {
                if (data.result) {
                    $('.popup-wrapper').removeClass('active');
                } else {
                    console.log('smth wrong' + data.result);
                    $('.popup-wrapper').removeClass('active');
                    $('#sms-code').removeClass('active').hide();
                }
                location.reload();
            });
            return false;
        });
    </script>
	<script type="text/javascript">

    setInterval(function () {
        setTimer($('.time-entry[data-rel="17"]'), $('#datepicker').html());
    }, 1000);

    function setTimer(wrapper, finalTime) {
        var today = new Date().getTime();
        var interval = finalTime - today;
        if (interval < 0) interval = 0;
        var days = parseInt(interval / (1000 * 60 * 60 * 24));
        var daysLeft = interval % (1000 * 60 * 60 * 24);
		if (days == 0) days = '1<';
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
</script>
</div>

<?= $this->render('/site/footer'); ?>