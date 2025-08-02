<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\LinkPager;

/**
 * @var \yii\web\View $this
 * @var \common\models\User $user
 */
?>


<div id="content-block">

    <?php
    echo $this->render('seller-sidebar', ['active' => 'accepted']);
    ?>

    <div class="sidebar-content">
        <div class="float-container">
            <div class="container">
             <div class="empty-space col-xs-b40 col-sm-b40"></div>

                    <div class="tab-entry" style="display: block;">
                      

                       
                           
                               
                                  

                                        <?php

                                        $count_price = 0;

                                        foreach ($offer as $offer_item) :?>
                                          
												 <div class="inner-block-4 order open-popup" data-param="<?php echo $offer_item->ID ?>" data-rel="seller-accepted">
                                              

                                                  
                                                        <div class="simple-article large dark ">
													    	<div class="open-popup-icon">
										                     	<i class="icon-popup "></i>
										                    </div>
                                                            <div class="product-name"><?php echo $offer_item->order->category->name; ?></div>
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
															<div class="left-cloud">
														    <div class="user-photo-left">
															    <div class="first-letter">
																<?php  $string = mb_substr(strip_tags($offer_item->order->user->username ), 0, 1);echo $string   ; ?>
																</div> 
														    </div> 
															
															
															
															<div class="testimonial-title" style="text-align: left;"><?php echo Yii::t('app', 'Контакти '); ?> <?php echo $offer_item->order->user->username; ?> </div>
                                                            <div class="empty-space col-xs-b5 col-sm-b0"></div>
													        <div class="table-thumbnail-description"><?php echo $offer_item->order->user->phone; ?></div>
										                    <div class="empty-space col-xs-b5 col-sm-b0"></div>
													        <div class="table-thumbnail-description"><?php echo $offer_item->order->user->email; ?></div>
															</div>
													
													
													
														</div>
													
                                                       
													 </div>
                                                


                                                
                                                <?php
                                            
                                        endforeach;
                                        ?>
                                
                                    
                                    
                
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
                           href="<?= Url::to(['cabinet/accepted', 'page' => $i]) ?>">
                            <span><?= $i ?></span>
                        </a>
                        <?php
                        $active = false;
                    endfor;
                    ?>
                </div>				
                                    
                                  
                          

                           
                       
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
		<div class="float-container-min seller ">
		  
                <div class="container-min" >
                   <div class="h3-float-container">
					   <?php echo $this->context->accepted_offers ?> <?= Yii::t('app', 'Контактів '); ?>
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

    <div class="popup-content" data-rel="seller-accepted"></div>

    <div class="popup-content" data-rel="seller-view-comment"></div>

    <div class="popup-content" data-rel="gallery"></div>

    <?= $this->render('@app/themes/blablaprice/popup/language'); ?>
</div>