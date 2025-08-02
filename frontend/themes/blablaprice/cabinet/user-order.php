<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\session;

/**
 * @var \common\models\Order[] $models
 * @var \yii\data\Pagination $pages
 */

$session = Yii::$app->session;

if ($session->has('filter')) $session->remove('filter');
if ($session->has('popup_regsiter_social')) $session->remove('popup_regsiter_social');
if ($session->has('email_social')) $session->remove('email_social');

?>

<div id="content-block">

    <?= $this->render('user-sidebar', ['active' => 'product']); ?>

    <div class="sidebar-content">
	<div class="float-container-min ">
		  
                <div class="container-min" >
                   <div class="h3-float-container">
					   <?= $this->context->count_orders ?> <?= Yii::t('app', 'Запитів'); ?>
				   </div>
				   
                </div>
			
		
			 
        </div>
        <div class="float-container">

            <?php if (empty($models)) : ?>
			<div class="container">
				<div class="empty-space col-xs-b60 col-sm-b60"></div>
				<div class="blabla-comment">
					<div class="user-photo-left icon-logo">
						<img src="/img/icon-logo.png" alt="">
					</div>
					<?php echo Yii::t('app','Створи новий запит щоб отримувати пропозиції від продавців.'); ?>
					<div class="empty-space col-xs-b20 col-sm-b20"></div>
					<div class="menu-button button style-1 size-1 left" style="width:auto;"><?= Yii::t('app', 'Почати пошук '); ?></div> 
				</div>
			</div>	
			
											

            <?php else : ?>

            <div class="container">
                <div class="empty-space col-xs-b60 col-sm-b60"></div>
				<div class="blabla-comment">
					<div class="user-photo-left icon-logo">
						<img src="/img/icon-logo.png" alt="">
					</div>
					<?php echo Yii::t('app','Запити які ти надіслав продавцям.'); ?>
					
				</div>
				<div class="empty-space col-xs-b30 col-sm-b30"></div>
             
                   
                   
                   

                        <?php  foreach ($models as $order_item) : ?>
                               
                               
                                <div class="inner-block-4 offer open-popup" data-param="<?= $order_item->getID() ?>" data-rel="user-order">
									<div class="simple-article large dark ">
									<div class="open-popup-icon">
														<i class="icon-popup "></i>
												</div>
										<div class="product-name"> <?php echo $order_item->category->name ?></div>
											<span class="user-name" >
												<span >
											<?php echo Yii::t('app', 'Надіслано'); ?>
                                            <?php echo $order_item->getActiveSellers() + $free_user . ' '. Yii::t('app', 'компаніям'); ?>
                                            </span>
											</span>
											
											
											
											<div  class="text-right">
												<div  class="right-cloud">
													<div class="simple-article extralarge green"><b>
														<?php echo Yii::t('app', 'Бюджет:'); ?>
														<?php echo $order_item->priceFrom ?>
														<?php echo Yii::t('app', 'грн'); ?></b></br>
														 <?php
                                                    $string = '';
                                                    $filter = explode('; ', $order_item->filter);
                                                    foreach ($filter as $filter_item) {
                                                        $filter_value = explode(': ', $filter_item);
                                                        if ($filter_value[0] != '' && isset($filter_value[1])) {
                                                            $string .= '<b>' . $filter_value[0] . ':</b> ' . $filter_value[1] . '; ';
                                                        }
                                                    }

                                                    $string = substr($string, 0, 150);
                                                    $string = rtrim($string, "!,.-");
                                                    $string = substr($string, 0, strrpos($string, ' '));
                                                    echo $string ;
                                                    ?>
														<?php  $string = mb_substr(strip_tags( $order_item->comment ), 0, 100);echo $string   ; ?>...
													</div>
												</div>
											</div>
											
											
								
										 <?php
										$k=count($order_item->offers);
                                        if ($k>0) : ?>
										
											<div class="blabla-comment">
												<div class="user-photo-left icon-logo">
													<img src="/img/icon-logo.png" alt="">
												</div>
													<b>
														<?php echo Yii::t('app', 'Ти отримав'); ?> 
														<?=count($order_item->offers) ?>
														<?php echo Yii::t('app', 'пропозицій'); ?>
													</b>
											</div>
                                            <?php
                                        endif;
                                        ?>
										
								


									</div>
								</div>
                                <?php endforeach;  ?>
                   
                   
               
                <div class="pagination-wrapper">
                    <?php
                    $active = false;
                    if($pages->pageCount>1)
                    for ($i = 1; $i <= $pages->pageCount; $i++) :
                        if ($i - 1 == $pages->page) {
                            $active = true;
                        }
                        ?>
                        <a class="button <?php echo $active ? 'style-31' : 'style-32' ?> inline-block"
                           href="<?php echo \yii\helpers\Url::to([
                               'cabinet/order',
                               'page' => $i
                           ]) ?>"><span><?php echo $i ?></span></a>
                        <?php
                        $active = false;
                    endfor;
                    ?>
					 <div class="empty-space col-xs-b30 col-sm-b30"></div>
                </div>
				
                	 
	 <div class="empty-space col-xs-b90 col-sm-b90"></div>
            </div>

            <?php endif; ?>
			<div class="inner-block fixed-desktop fixed-desktop-right " >
					<div class="user-photo-left icon-logo">
						<img src="/img/icon-logo.png" alt="">
					</div>
                   <div class="container">
                        <div class="title-how-it-works"><?= Yii::t('app', 'Популярні питання'); ?></div>
						<div class="cust-tooltip ">
						   <div  class="link-how-it-works "  <span>  <?= Yii::t('app', 'Це безкоштовно ?'); ?></span></div>
						   <div class="tooltip-content-2 how-it-works-tooltip">
                              <?= Yii::t('app', 'Так. Ти можеш безкоштовно надсилати запити і обмінюватись контактами з обраними продавцями. '); ?>
                           </div>
						</div >
						<div class="cust-tooltip ">
						   <div  class="link-how-it-works "  <span>  <?= Yii::t('app', 'Хто бачить мої контакти?'); ?></span></div>
						   <div class="tooltip-content-2 how-it-works-tooltip">
                             <?= Yii::t('app','Ти сам обираєш з ким обмінятись контактами. '); ?>
                           </div>
						</div >
						<div class="cust-tooltip ">
						   <div  class="link-how-it-works "  <span><?= Yii::t('app', 'Чи обовязково обирати продавця? '); ?></span></div>
						   <div class="tooltip-content-2 how-it-works-tooltip">
                              <?= Yii::t('app','Не обовязково. Якщо тобі не підійшли умови ти можеш проігноравати пропозиції , або обмінятись контактами і ще поторгуватись з обраним продавцем.'); ?>
                           </div>
						</div >
						 <div class="empty-space col-xs-b20 col-lg-b20"></div>
						 <div class="title-how-it-works"><?= Yii::t('app', 'Пошир BlaBlaPrice'); ?></div>
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
                              <?= Yii::t('app','Пошир BlaBlaPrice щоб отримувати більше запитів '); ?>
                           </div>
					</div >
					 <div class="empty-space col-xs-b20 col-lg-b20"></div>
					 <a class="link-right-block" href="/site/howitworks"><?= Yii::t('app', 'Як це працює? '); ?></a>  ·
					 <a class="link-right-block" href="/site/contact"><?= Yii::t('app', 'Контакти '); ?></a>
                     <div  class="blabla-right-block "  <span> BlaBlaPrice © 2018 </span></div>


                </div>
                </div> 
                
        <!-- SIDEBAR MOBILE -->
        <?php include 'user-sidebarmobile.php'; ?>
        <!-- // SIDEBAR MOBILE -->
		
        <div class="clear"></div>
    </div>
</div>

<?php echo $this->render('/site/footer') ?>

<div class="popup-wrapper">
    <div class="close-layer"></div>
    <div class="popup-content" data-rel="detail"></div>
    <div class="popup-content" data-rel="user-order"></div>
    <div class="popup-content" data-rel="user-desibled-order"></div>
    <div class="popup-content" data-rel="user-offer"></div>
    <div class="popup-content" data-rel="user-view-contact"></div>	
	<div class="popup-content" data-rel="seller-view-comment"></div>
    <div class="popup-content" data-rel="gallery"></div>

    <?= $this->render('@app/themes/blablaprice/popup/popup-phone-verification') ?>
    <?= $this->render('@app/themes/blablaprice/popup/language'); ?>
</div>