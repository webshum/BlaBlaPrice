<?php

use yii\helpers\Url;
use yii\helpers\Html;
use common\models\Comment;

/**
 * @var \yii\web\View $this
 * @var \common\models\User $user
 * @var \common\models\Comment $comment
 */

$comment_item = array();
?>
    <div id="content-block">

        <?php echo $this->render('seller-sidebar', ['active' => 'comment']) ?>

        <div class="sidebar-content">
            <div class="float-container">
                <div class="container">

                    <div class="tabs-block">
                        <div class="popup-paddings-wide ">
                            <div class="popup-tabs fixed-comment clearfix tab-menu-wrapper">
                              
                                <div class="toggle">
                                    <a href='comment-with-ans' class="entry tab-menu">
									<?php echo Yii::t('app','Відгуків'); ?></a>
									
                                    <a href='comment-without-ans' class="entry tab-menu">
									<?php echo Yii::t('app','Не оцінені'); ?></a>

                                    <a href='comment-refuse' class="entry tab-menu active">
									<?php echo Yii::t('app','Відмовились'); ?></a>
                                </div>
                            </div>
                     
                        </div>
                      
                      
                            <div class="tab-entry" style="display: block;">
							 <div class="empty-space col-xs-b50 col-sm-b50"></div>


                                <div class="popup-paddings-wide text-center grey">
                                    <div class="row ">
                                       
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <div class="empty-space col-xs-b20"></div>
                                            <div class="simple-article dark large"><b><?php echo Yii::t('app',
                                                        'Оцінки від клієнтів'); ?></b></div>
                                            <div class="empty-space col-xs-b20"></div>
                                            <div class="row column-line m5">
                                                <div class="col-xs-4">
                                                    <div class="simple-article"><?php echo Yii::t('app',
                                                            'Позитивні'); ?></div>
                                                    <div class="empty-space col-xs-b5"></div>
                                                    <div class="smile-entry active">
                                                        <span class="positive icon"><i class="icon-smile"></i></span><span
                                                                class="text"><?php echo $user->countPositive ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-xs-4">
                                                    <div class="simple-article"><?php echo Yii::t('app',
                                                            'Нейтральні'); ?></div>
                                                    <div class="empty-space col-xs-b5"></div>
                                                    <div class="smile-entry active">
                                                        <span class="neutral icon"><i class="icon-meh"></i></span><span
                                                                class="text"><?php echo $user->countNeutral ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-xs-4">
                                                    <div class="simple-article"><?php echo Yii::t('app',
                                                            'Негативні'); ?></div>
                                                    <div class="empty-space col-xs-b5"></div>
                                                    <div class="smile-entry active">
                                                        <span class="negative icon"><i class="icon-frown"></i></span><span
                                                                class="text"><?php echo $user->countNegative ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="empty-space col-xs-b20"></div>
											<div class="col-sm-3"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="empty-space col-xs-b30 col-sm-b30"></div>
                               
                            
                                <?php
								
                                $ref = array();
                                $refuse = $refuses;
                                foreach ($refuse as $key => $value) :
                                    if (isset($ref[$value['answerRefuse']])) {
                                        $ref[$value['answerRefuse']]++;
                                    } else {
                                        $ref[$value['answerRefuse']] = 1;
                                    }
								
                                endforeach;
                                ?>
                            
                                <div id="refuse-container">
								 <div class="empty-space col-xs-b70 col-sm-b70"></div>
                                    <?php foreach ($refuse as $refuse_item) : ?>
										
                                     
                                        
										<div class="inner-block-4 refuse open-popup" data-param="<?php echo $refuse_item->offerID; ?>" data-rel="seller-accepted2">
										
										<div class="simple-article large dark ">
										     <div class="product-name ">
										<?php echo $refuse_item->product ? $refuse_item->product : $refuse_item->category ?>
											
									       </div>
										    <span class="user-name">
                                                          
          <?php echo Yii::t('app', 'Клієнт '); ?>
         <?php echo $refuse_item->answerUsername; ?>
        
		
		    
				
		  </span>
                                          
                                           

                                              
										
										
                                              <div class="row ">
                                                <div class="col-sm-12">
                                                    <div class="neutral refusal">
                                                        <div class="cloud">
														 <div class="left-cloud-data"><?php echo $refuse_item->answerUpdated; ?></div>
														<div class="user-photo-left">
															    <div class="first-letter">
												                  <?php  $string = mb_substr(strip_tags($refuse_item->answerUsername), 0, 1);echo $string   ; ?>
																</div> 
														    </div> 
														
                                                       
														<div class="cust-tooltip ">
														 <span class="title"><?php echo Yii::t('app',
                                                                'Відмовився'); ?> <i class="icon-help-circled-alt "></i> </span>
														 
					   
			                                              <div class="tooltip-content left-best-price ">
					                                     <?php echo $refuse_item->answerUsername; ?><?php echo Yii::t('app',' відмовився від вашої пропозиції і вказав причину відмови'); ?>  
                                                          </div> 
					                                    </div>

                                                         
														<span class="description"><?php echo $refuse_item->answerComment ? mb_substr($refuse_item->answerComment,0,300) : Yii::$app->params['refuse'][$refuse_item->answerRefuse]   ?></span>
                                                       
														</div>
                                                       
                                                    </div>
                                                </div>
                                           </div>
                                          
                                        </div>
										 </div>
                                    
                                        <?php
                                    endforeach;
                                    ?>
                                </div>
                                

                  <div class="pagination-wrapper">
				
                    <?php
                    $active = false;
                    if($pages_refuses->pageCount>1)
                    for ($i = 1; $i <= $pages_refuses->pageCount; $i++) :
                        if ($i - 1 == $pages_refuses->page) {
                            $active = true;
                        }
                        ?>
                        <a class="button <?= $active ? 'style-31' : 'style-32' ?> inline-block"
                           href="<?= Url::to(['cabinet/comment-refuse', 'page' => $i]) ?>">
                            <span><?= $i ?></span>
                        </a>
                        <?php
                        $active = false;
                    endfor;
                    ?>
                </div>                                
                                
                            
                              
                                
                                
                            </div>

                       
                    </div>
                    <div class="empty-space col-xs-b30 col-sm-b30"></div>
					
					
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
 <div class="float-container-bottom hidden-lg" >
            <div class="footer-main-link">

               <a href="/cabinet/order" class="  link-footer"><i class="icon-login"></i><span> <?= Yii::t('app', 'Запити'); ?></a>
               <a href="/cabinet/offer" class=" link-footer  "><i class="icon-logout"></i><span> <?= Yii::t('app', 'Пропозиції'); ?></span></a>
               <a href="/cabinet/accepted" class=" link-footer "><i class="icon-users-outline"></i><span> <?= Yii::t('app', 'Контакти'); ?></span></a>
               <a href="/cabinet/comment" class="active link-footer "><i class="icon-chat-alt"></i><span> <?= Yii::t('app', 'Відгуки'); ?></span></a>




        </div>
    </div>
            <div class="clear"></div>
        </div>
    </div>

    <div class="popup-wrapper">
        <div class="close-layer"></div>

        <div class="popup-content" data-rel="seller-accepted2"></div>
		 <div class="popup-content" data-rel="seller-view-comment"></div>

        <div class="popup-content" data-rel="detail"></div>

        <?= $this->render('@app/themes/blablaprice/popup/language'); ?>
    </div>

<?php echo $this->render('/site/footer'); ?>