<?php
use common\models\User;
/**
 * @var \yii\web\View $this
 * @var \common\models\User $user
 * @var \common\models\Offer $offer_item
 */
// generate regions
$user = User::findOne(['ID' => Yii::$app->user->id]);
$regionList = [];
$regionList = array_merge($regionList, Yii::$app->params['region'][$_SESSION['language']]);
?>

<div id="content-block">

    <?php echo $this->render('seller-sidebar', ['active' => 'offer']); ?>

    <div class="sidebar-content">

        <div class="float-container">
            <div class="container">
                <div class="empty-space col-xs-b40 col-sm-b40"></div>
                
                  
            
                   
                      
                        <?php
                        foreach ($models as $offer_item) :
                            if ($offer_item->order->product) :
                        ?>
                                 <div class="inner-block-4 offer open-popup" data-param="<?php echo $offer_item->ID ?>" data-rel="seller-offer">
									<div class="simple-article large dark ">
									<div class="open-popup-icon">
										<i class="icon-popup "></i>
									</div> 
									<div class="product-name"><?php echo $offer_item->order->product->name ?> </div>
                                    <span class="user-name">
												<?php echo Yii::t('app', 'Запит від '); ?>
												<span class="cust-tooltip " >
													<span class="popup-user-name-first-letter"> <?php echo $offer_item->order->user->userName; ?></span>
													<div class="tooltip-content left-user-popup" >
														<b><?= Yii::t('app', 'Телефон перевірено.'); ?> </b><br> 
														<b><?= Yii::t('app', 'Оцінки :'); ?> </b><br>  
														<b><?php echo $offer_item->order->user->countPositive; ?> </b> <?= Yii::t('app', '    позитивних '); ?>   <br>  
														<b><?php echo $offer_item->order->user->countNeutral; ?> </b> <?= Yii::t('app', '    нейтральних '); ?>    <br>
														<b><?php echo $offer_item->order->user->countNegative; ?> </b><?= Yii::t('app', '    негативних '); ?>    <br> 
                           
													</div> 
													<i class="icon-ok "></i>
												</span>
									</span>
									<div class="text-right">
											<div class="right-cloud">
											<b>  <?php echo $offer_item->price ?><?php echo Yii::t('app', ' грн'); ?></b></br>
											<?php  $string = substr(strip_tags($offer_item->comment), 0, 100);echo $string . "… " ; ?> 
											</div>
											</div>
									</div>
									
										<?php if ($offer_item->order->bestOffer->price < $offer_item->price) :?>
									
									<div class="blabla-comment">
									  
										   <div class="user-photo-left icon-logo">
													<img src="/img/icon-logo.png" alt="">
												</div>
										    <span>
                                           
											 <?= Yii::t('app', 'Найкраща ціна'); ?>
											 <?php echo $offer_item->order->bestOffer->price . ' ' . Yii::t('app',' грн'); ?>
											
                                            </span>
									
								
									</div> 
									<?php endif; ?>
									
								
							
                                </div>
							<?php
                            else :
                            ?>
                                <div class="inner-block-4 offer open-popup" data-param="<?php echo $offer_item->ID ?>" data-rel="seller-offer">
                                    <div class="simple-article large dark">
										<div class="open-popup-icon">
											<i class="icon-popup "></i>
										</div> 
                                        <div class="product-name"><?php echo $offer_item->order->category->name ?></div>
                                        <span class="user-name">
												<?php echo Yii::t('app', 'Запит від '); ?>
												<span class="cust-tooltip " >
													<span class="popup-user-name-first-letter"> <?php echo $offer_item->order->user->userName; ?></span>
													<div class="tooltip-content left-user-popup" >
														<b><?= Yii::t('app', 'Телефон перевірено.'); ?> </b><br> 
														<b><?= Yii::t('app', 'Оцінки :'); ?> </b><br>  
														<b><?php echo $offer_item->order->user->countPositive; ?> </b> <?= Yii::t('app', '    позитивних '); ?>   <br>  
														<b><?php echo $offer_item->order->user->countNeutral; ?> </b> <?= Yii::t('app', '    нейтральних '); ?>    <br>
														<b><?php echo $offer_item->order->user->countNegative; ?> </b><?= Yii::t('app', '    негативних '); ?>    <br> 
                           
													</div> 
													<i class="icon-ok "></i>
												</span>
										</span>
										<div class="text-right">
										<div class="right-cloud">
											<b>  <?php echo $offer_item->price ?><?php echo Yii::t('app', ' грн'); ?></b></br>
											<?php  $string = substr(strip_tags($offer_item->comment), 0, 100);echo $string . "… " ; ?> 
										</div>
										</div>
												
											
										
                                    </div>
								
									<?php if ($offer_item->order->bestOffer->price < $offer_item->price) :?>
										
									<div class="blabla-comment"><div class="user-photo-left icon-logo">
													<img src="/img/icon-logo.png" alt="">
												</div>
										    <span>
                                           
											 <?= Yii::t('app', 'Найкраща ціна'); ?>
											 <?php echo $offer_item->order->bestOffer->price . ' ' . Yii::t('app',' грн'); ?>
											
                                            </span>
									
								
									</div> 
									<?php endif; ?>
									
									
								
                                </div>
                            <?php
                            endif;
                            endforeach;
                            ?>
                  
                  

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
                           href="<?php echo \yii\helpers\Url::to([
                               'cabinet/offer',
                               'page' => $i
                           ]) ?>"><span><?php echo $i ?></span></a>
                        <?php
                        $active = false;
                    endfor;
                    ?>
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
					 <a class="link-right-block" href="/site/howitworks"><?= Yii::t('app', 'Як це працює? '); ?></a>  · 
					 <a class="link-right-block" href="/site/contact"><?= Yii::t('app', 'Контакти '); ?></a>
                     <div  class="blabla-right-block "  <span> BlaBlaPrice © 2018 </span></div>					 
					 
		
     </div>
	</div>
	 <div class="empty-space col-xs-b90 col-sm-b90"></div>
            </div>
			
        </div>
			<div class="float-container-min seller">
		  
                <div class="container-min" >
                   <div class="h3-float-container">
					   <?php echo $this->context->send_offers ?> <?= Yii::t('app', 'Пропозицій'); ?>
				   </div>
				   
                </div>
			
		
			 
        </div>

		<!-- SIDEBAR MOBILE -->
        <?= include 'seller-sidebarmobile.php'; ?>
        <!-- // SIDEBAR MOBILE -->

        <div class="clear"></div>
    </div>
</div>

<?php echo $this->render('/site/footer'); ?>

<div class="popup-wrapper">
    <div class="close-layer"></div>

    <div class="popup-content" data-rel="detail"></div>

    <div class="popup-content" data-rel="seller-offer"></div>

    <div class="popup-content" data-rel="seller-view-comment"></div>

    <div class="popup-content" data-rel="seller-price-down"></div>

    <div class="popup-content" data-rel="gallery"></div>

    <?= $this->render('@app/themes/blablaprice/popup/language'); ?>
</div>