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
                                    <a href='comment-with-ans' class="entry tab-menu active">
									<?php echo Yii::t('app','Відгуків'); ?></a>
									
                                    <a href='comment-without-ans' class="entry tab-menu">
									<?php echo Yii::t('app','Не оцінені'); ?></a>

                                    <a href='comment-refuse' class="entry tab-menu">
									<?php echo Yii::t('app','Відмовились'); ?></a>
                                </div>
                            </div>
                     
                        </div>
                      
                      
                            <div class="tab-entry" style="display: block;">
							 <div class="empty-space col-xs-b50 col-sm-b50"></div>


                               
								<div class="blabla-comment">
							<div class="user-photo-left icon-logo">
								<img src="/img/icon-logo.png" alt="">
							</div>
							<?php echo Yii::t('app','Оцінки від клієнтів'); ?></br>
							· <?php echo $user->countPositive ?> <?php echo Yii::t('app','позитивних ;'); ?></br>
							· <?php echo $user->countNeutral ?> <?php echo Yii::t('app','нейтральних ;'); ?></br>
							· <?php echo $user->countNegative ?> <?php echo Yii::t('app','негативних ;'); ?></br>
							
						</div>
								
                                  
                               
                                <div class="empty-space col-xs-b30 col-sm-b30"></div>
								
								
                               
                                    <?php
                                    foreach ($models as $comment) :
                                        ?>
                                        <div class="inner-block-4 accepted open-popup" data-param="<?php echo $comment->offerID; ?>" data-rel="seller-accepted2">
									
											
                                            <div class="simple-article large dark ">
									
                                              
                                        <div class="product-name"><?php echo $comment->product ? $comment->product : $comment->category ?> </div>
                                        <span class="user-name">
											<?php echo Yii::t('app', 'Відгук клієнта'); ?> 
											<span class="popup-user-name-first-letter"><?php echo $comment->answerUsername ?></span>
											
										</span>
                                 
								        <div class="row ">
											 <?php
                                                if ($comment->answerID) :
                                                    $rating = Comment::Rating($comment->answerRating)
                                                    ?>
                                                    <div class="col-sm-12">
                                                        <div class="<?php echo $rating['class']; ?> ">
                                                            <div class="cloud">
															<div class="left-cloud-data"><?php echo $comment->answerUpdated ?></div>
															<div class="user-photo-left">
															    <div class="first-letter">
												                  <?php  $string = mb_substr(strip_tags($comment->answerUsername), 0, 1);echo $string   ; ?>
																</div> 
														    </div> 
															
                                                            <span class="title"><?php echo $rating['name']; ?><?php echo Yii::t('app',
                                                                    ' продавець'); ?></span>
                                                                <span class="description"><?php echo mb_substr(strip_tags($comment->answerComment),0,300) ?></span>
																
																
                                                            </div>
                                                          
                                                        
                                                        </div>
                                                    </div>
													
											   
                                                   
													
													
													
													
													
                                                <?php endif; ?>
												
                                              
                                                  
                                                 
                                                    <?php
                                                    if ($comment->ID) :
                                                        $rating = Comment::Rating($comment->commentRating);
                                                        ?>
														  <div class="col-sm-12 text-right ">
                                                        <div class="cloud-edit-wrapper">
                                                            <div class="<?php echo $rating['class']; ?> text-right">
                                                                <div class="cloud">
																<div class="left-cloud-data"><?php echo $comment->commentUpdated ?></div>
																

																
                                                                <span class="title"><?php echo $rating['name']; ?><?php echo Yii::t('app',
                                                                        ' покупець'); ?>
																</span>
																<span class="description"><?php echo mb_substr(strip_tags($comment->commentt),0,300) ?>
																</span>
																 
																
                                                                </div>
                                                              
                                                            </div>
                                                        </div>
														 </div>
                                                        
                                                        <?php
                                                    endif;
                                                    ?>
                                               
                                               
                                            </div>
											</div>
                                           
                                        </div>
                                        
                                        <?php
                                    endforeach;
                                    ?>
									
									
									
									
									
									
                              
                           

                  <div class="pagination-wrapper">
                    <?php
                    $active = false;
					echo $pages->pageCount;
                    if($pages->pageCount>1)
                    for ($i = 1; $i <= $pages->pageCount; $i++) :
                        if ($i - 1 == $pages->page) {
                            $active = true;
                        }
                        ?>
                        <a class="button <?= $active ? 'style-31' : 'style-32' ?> inline-block"
                           href="<?= Url::to(['cabinet/comment-with-ans', 'page' => $i]) ?>">
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