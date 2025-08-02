<?php

use yii\widgets\ActiveForm;
use common\models\Comment;
use yii\helpers\Url;

/**
 * @var \yii\web\View $this
 * @var \common\models\User $user
 * @var \common\models\Comment $comment
 * @var \common\models\Offer $offers_item ;
 */
?>

<div id="content-block">
    <?= $this->render('user-sidebar', ['active' => 'accepted']); ?>

    <div class="sidebar-content">
        <div class="float-container">
		  <?php if (empty($offer)) : ?>

            <div class="empty-space col-xs-b60 col-sm-b60"></div>
						<div class="blabla-comment">
							<div class="user-photo-left icon-logo">
								<img src="/img/icon-logo.png" alt="">
							</div>
							<?php echo Yii::t('app','Тут будуть контакти обраних вами продавців'); ?>
						
							
						</div>

          <?php else : ?>
            <div class="container">
                <div class="empty-space col-xs-b60 col-lg-b60"></div>
              
                  
                 
               
   
						
                        <div class="tabs-block">
							<div class="popup-paddings-wide ">
								<div class="popup-tabs fixed-comment clearfix tab-menu-wrapper">
                              
									<div class="toggle">
										<div class="entry tab-menu active" style="max-width:31vw;">
											
											<?php echo Yii::t('app','Нові'); ?></div>
									
										<div class="entry tab-menu" style="max-width:31vw;">
											
											<?php echo Yii::t('app','Погодились'); ?>
										</div>
									
										<div class="entry tab-menu" style="max-width:32vw;">
											<?php echo $count_refuses ?>
											<?php echo Yii::t('app','Відмовились'); ?>
										</div>
									</div>
								</div>
                     
							</div>
							<div class="tab-entry" style="display: block;">
							<div class="empty-space col-xs-b10 col-sm-b10"></div>
							<div class="blabla-comment">
								<div class="user-photo-left icon-logo">
									<img src="/img/icon-logo.png" alt="">
								</div>
							<?php echo Yii::t('app','Нові контакти продавців яких ви ще не оцінили'); ?>
							</div>
							<div class="empty-space col-xs-b30 col-sm-b30"></div>
							<?php foreach ($offer as $offers_item) : ?>
							<?php  if (!($offers_item->getComment($user->ID)->one()) and !($offers_item->getRefuse($user->ID)->one())) : ?>	
                                <div class="inner-block-4 offer open-popup" data-param="<?= $offers_item->getID() ?>" data-rel="user-accepted">
									<div class="simple-article large dark ">
									<div class="open-popup-icon">
											<i class="icon-popup "></i>
										</div>
										<div class="product-name"> <?php echo  $offers_item->order->product->name ? $offers_item->order->product->name : $offers_item->order->category->name; ?></div>	
										   <span class="user-name">
												<?php echo Yii::t('app', 'Контакти від '); ?>
												<?php echo $offers_item->user->username; ?>
											</span>
								
								

                                   	<div class="left-cloud">
												<div class="user-photo-left">
													<div class="first-letter">
												                  <?php  $string = mb_substr(strip_tags($offers_item->user->username), 0, 1);echo $string   ; ?>
													</div> 
												</div>
									
											     
												   
												   <div class="testimonial-title" style="text-align: left;"><?php echo Yii::t('app', 'Контакти '); ?> <?php echo $offers_item->user->username; ?></div>
                                                     <div class="empty-space col-xs-b5 col-sm-b0"></div>
													 <div class="table-thumbnail-description"><?php echo $offers_item->user->phone; ?></div>
										             <div class="empty-space col-xs-b5 col-sm-b0"></div>
													 <div class="table-thumbnail-description"><?php echo $offers_item->user->email; ?></div>
										
                                   </div>
								
										
										
										
										
									
												<div  class="left-cloud">
												<div class="user-photo-left icon-logo">
													<img src="/img/icon-logo.png" alt="">
												</div>
													<b>
														<?php echo Yii::t('app', 'Оцініть продавця'); ?>
													</b>
												</div>
													
                                   
										
										
										
                              
									


										</div>
									</div>
								<?php endif; ?>
								<?php  endforeach; ?>
								</div>
								
								<div class="tab-entry">
								<div class="empty-space col-xs-b10 col-sm-b10"></div>
							<div class="blabla-comment">
								<div class="user-photo-left icon-logo">
									<img src="/img/icon-logo.png" alt="">
								</div>
							<?php echo Yii::t('app','Контакти продавців, на пропозиції яких ви погодились і залишили свій відгук'); ?>
							</div>
							<div class="empty-space col-xs-b30 col-sm-b30"></div>
							<?php foreach ($offer as $offers_item) : ?>
							<?php  if (($offers_item->getComment($user->ID)->one()) and !($offers_item->getRefuse($user->ID)->one())) : ?>	
                                <div class="inner-block-4 offer open-popup" data-param="<?= $offers_item->getID() ?>" data-rel="user-accepted">
									<div class="simple-article large dark ">
									<div class="open-popup-icon">
											<i class="icon-popup "></i>
										</div>
										<div class="product-name"> <?php echo  $offers_item->order->product->name ? $offers_item->order->product->name : $offers_item->order->category->name; ?></div>	
										   <span class="user-name">
												<?php echo Yii::t('app', 'Контакти від '); ?>
												<?php echo $offers_item->user->username; ?>
											</span>
								
								

                                   	<div class="left-cloud">
												<div class="user-photo-left">
													<div class="first-letter">
												                  <?php  $string = mb_substr(strip_tags($offers_item->user->username), 0, 1);echo $string   ; ?>
													</div> 
												</div>
									
											     
												   
												   <div class="testimonial-title" style="text-align: left;"><?php echo Yii::t('app', 'Контакти '); ?> <?php echo $offers_item->user->username; ?></div>
                                                     <div class="empty-space col-xs-b5 col-sm-b0"></div>
													 <div class="table-thumbnail-description"><?php echo $offers_item->user->phone; ?></div>
										             <div class="empty-space col-xs-b5 col-sm-b0"></div>
													 <div class="table-thumbnail-description"><?php echo $offers_item->user->email; ?></div>
										
                                   </div>
								
										
										
										
									
											
												<div  class="text-right">
													<div  class="right-cloud">
														<div class=" <?php
															$rating_answ = Comment::Rating($offers_item->getAnswer($offers_item->userID)->one()->rating);
															echo $rating_answ['class']; ?>">
                               
															<b class="title"><?php echo $rating_answ['name'] . ' ' . Yii::t('app','продавець'); ?></b>
															<div class="description"><?php echo mb_substr(strip_tags($offers_item->getAnswer($offers_item->userID)->one()->comment),0,100) ?></div>
														</div>
													</div>
												</div>
					
									
										
										
										
                              
									


										</div>
									</div>
								<?php endif; ?>
								<?php  endforeach; ?>

								</div>
										<div class="tab-entry">
										<div class="empty-space col-xs-b10 col-sm-b10"></div>
							<div class="blabla-comment">
								<div class="user-photo-left icon-logo">
									<img src="/img/icon-logo.png" alt="">
								</div>
							<?php echo Yii::t('app','Контакти продавців,від пропозицій яких Ви відмовились.'); ?>
							</div>
							<div class="empty-space col-xs-b30 col-sm-b30"></div>
							<?php foreach ($offer as $offers_item) : ?>
							<?php  if (($offers_item->getRefuse($user->ID)->one())) : ?>	
                                <div class="inner-block-4 offer open-popup" data-param="<?= $offers_item->getID() ?>" data-rel="user-accepted">
									<div class="simple-article large dark ">
									<div class="open-popup-icon">
											<i class="icon-popup "></i>
										</div>
										<div class="product-name"> <?php echo  $offers_item->order->product->name ? $offers_item->order->product->name : $offers_item->order->category->name; ?></div>	
										   <span class="user-name">
												<?php echo Yii::t('app', 'Контакти від '); ?>
												<?php echo $offers_item->user->username; ?>
											</span>
								
								

                                   	<div class="left-cloud">
												<div class="user-photo-left">
													<div class="first-letter">
												                  <?php  $string = mb_substr(strip_tags($offers_item->user->username), 0, 1);echo $string   ; ?>
													</div> 
												</div>
									
											     
												   
												   <div class="testimonial-title" style="text-align: left;"><?php echo Yii::t('app', 'Контакти '); ?> <?php echo $offers_item->user->username; ?></div>
                                                     <div class="empty-space col-xs-b5 col-sm-b0"></div>
													 <div class="table-thumbnail-description"><?php echo $offers_item->user->phone; ?></div>
										             <div class="empty-space col-xs-b5 col-sm-b0"></div>
													 <div class="table-thumbnail-description"><?php echo $offers_item->user->email; ?></div>
										
                                   </div>
								   
										
											<div  class="text-right">
												<div  class="right-cloud">
													<b><?php echo Yii::t('app', 'Я відмовився');?></b>
													<?php
													$refuse = $offers_item->getRefuse($offers_item->order->userID)->one();
													if ($refuse->comment ) :
													?>
														<div><?php echo $refuse->comment ?></div>
                   
													<?php else : ?>
														<div><?php echo  Yii::$app->params['refuse'][$refuse->refuseID]  ?></div>
													<?php endif; ?>
												</div>
											</div>
										
										
										
										
                              
									


										</div>
									</div>
								<?php endif; ?>
								<?php  endforeach; ?>
				
								</div>
								<div class="pagination-wrapper">

                    <?php
                    $active = false;
                    for ($i = 1; $i <= $pages->pageCount; $i++) :
                        if ($i - 1 == $pages->page) {
                            $active = true;
                        }
                        ?>
                        <a class="button <?= $active ? 'style-31' : 'style-32' ?> size-2 inline-block"
                           href="<?= Url::to(['cabinet/accepted', 'page' => $i]) ?>">
                            <span><?= $i ?></span>
                        </a>
                        <?php
                        $active = false;
                    endfor;
                    ?>
					<div class="empty-space col-xs-b30 col-sm-b30"></div>
                </div>  
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
             <?php endif; ?>   
			 
         
        <!-- SIDEBAR MOBILE -->
		<?php include 'user-sidebarmobile.php'; ?>
            <!-- // SIDEBAR MOBILE -->
		
        <div class="clear"></div>
    </div>
</div>

<?php echo $this->render('/site/footer'); ?>


<div class="popup-wrapper">
    <div class="close-layer"></div>

    <div class="popup-content" data-rel="detail"></div>

    <div class="popup-content" data-rel="user-accepted"></div>

    <div class="popup-content" data-rel="user-offer"></div>
	<div class="popup-content" data-rel="seller-view-comment"></div>

    <div class="popup-content" data-rel="user-view-contact"></div>
	 <?= $this->render('@app/themes/blablaprice/popup/language'); ?>
</div>