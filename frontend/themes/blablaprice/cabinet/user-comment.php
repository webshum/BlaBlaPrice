<?php

use yii\helpers\Url;
use yii\helpers\Html;
use common\models\Comment;


/**
 * @var \yii\web\View $this
 * @var \common\models\User $user
 * @var \common\models\Comment $comment
 */
?>

    <div id="content-block">

        <?php echo $this->render('user-sidebar', ['active' => 'comment']) ?>

        <div class="sidebar-content">
            <div class="float-container">
			 <?php
			 
			 $sum = $user->countPositive+$user->countNeutral+$user->countNegative;
			
			 if ( $sum < 1) : ?>

          
			 <div class="container">
			 <div class="empty-space col-xs-b60 col-sm-b60"></div>
						<div class="blabla-comment">
							<div class="user-photo-left icon-logo">
								<img src="/img/icon-logo.png" alt="">
							</div>
							<?php echo Yii::t('app','Тут будуть відгуки про тебе. Щоб продавець мав можливість написати про тебе відгук - напиши спочатку про нього. '); ?>
						
							
						</div>
            </div>
            <?php else : ?>
                <div class="container">
                    
                  


                        <div class="empty-space col-xs-b60 col-sm-b60"></div>
						<div class="blabla-comment">
							<div class="user-photo-left icon-logo">
								<img src="/img/icon-logo.png" alt="">
							</div>
							<?php echo Yii::t('app','Відгуки від продавців:'); ?></br>
							· <?php echo $user->countPositive ?> <?php echo Yii::t('app','позитивних ;'); ?></br>
							· <?php echo $user->countNeutral ?> <?php echo Yii::t('app','нейтральних ;'); ?></br>
							· <?php echo $user->countNegative ?> <?php echo Yii::t('app','негативних ;'); ?></br>
							
						</div>
                        
                        <div class="empty-space col-xs-b30 col-sm-b30"></div>

                        <div id="comment-container">
                            <?php
                            foreach ($models as $comment) :
                                ?>
                                <div class="inner-block-4 offer  open-popup" data-param="<?php echo $comment->offerID; ?>" data-rel="user-comment">
								 
								   <div class="simple-article large dark ">
								   
                                   <div class="open-popup-icon">
											<i class="icon-popup "></i>
										</div>
                                  
                                        <div class="product-name">
                                             <?php echo $comment->product ? $comment->product : $comment->category ?>
                                        </div>
										 <span class="user-name">
											<?php echo Yii::t('app', 'Відгук від '); ?>
											<?php echo $comment->answerUsername ?>
										</span>

                                   
                                  

                                    <div class="row ">
                                 

                                       <div class="col-sm-12">
                    <?php
                    if ($comment->ID) :
                        $rating = Comment::Rating($comment->commentRating);
                        ?>
                      

                        <div class="cloud-edit-wrapper">
                            <div class="<?php echo $rating['class']; ?> text-right">
                                <div class="cloud">
                                <div class="right-cloud-data"> <?php echo $comment->commentUpdated ?></div>
                                    <span class="title"><?php echo $rating['name'] . ' ' . Yii::t('app',
                                                ' продавець'); ?></span>
                                    <span class="description"><?php echo mb_substr(strip_tags($comment->commentt),0,300) ?></span>
									
                                </div>
                               
                            </div>
                        </div>

                       
                      
                        <?php
                    endif;
                    ?>
                </div>
				       <div class="col-sm-12">
                                            <?php
                                            if ($comment->answerID) :
                                                $rating = Comment::Rating($comment->answerRating)
                                                ?>
                                                <div class="<?php echo $rating['class']; ?>">
                                                    <div class="cloud">
                                                    <div class="left-cloud-data"> <?php echo $comment->answerUpdated ?></div>
													<div class="user-photo-left">
															    <div class="first-letter">
												                  <?php  $string = mb_substr(strip_tags($comment->answerUsername), 0, 1);echo $string   ; ?>
																</div> 
														    </div> 
                                                    <span class="title"><?php echo $rating['name'] . ' ' . Yii::t('app',
                                                                'покупець'); ?></span>
													<span class="description"><?php echo mb_substr(strip_tags($comment->answerComment),0,300) ?>
													</span>
                                                      
                                                    
														
                                                    </div>
                                                  
                                                   
                                                </div>
                                                <?php
                                            endif;
                                            ?>
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
                    if($pages->pageCount>1)
                    for ($i = 1; $i <= $pages->pageCount; $i++) :
                        if ($i - 1 == $pages->page) {
                            $active = true;
                        }
                        ?>
                        <a class="button <?= $active ? 'style-31' : 'style-32' ?> inline-block"
                           href="<?= Url::to(['cabinet/comment', 'page' => $i]) ?>">
                            <span><?= $i ?></span>
                        </a>
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

            </div>
				 <div class="float-container-min ">
		  
                <div class="container-min" >
                   <div class="h3-float-container">
					   <?php echo $this->context->count_feedback  ?> <?= Yii::t('app', 'Відгуків про мене'); ?>
				   </div>
				   
                </div>
			
		
			 
        </div>
            <div class="clear"></div>
        </div>

    </div>

    <div class="popup-wrapper">
        <div class="close-layer"></div>

        <?= $this->render('@app/themes/blablaprice/popup/language'); ?>
          <div class="popup-content" data-rel="user-comment"></div>
		   <div class="popup-content" data-rel="seller-view-comment"></div>
		
        <div class="popup-content" data-rel="detail"></div>
    </div>

<?= $this->render('/site/footer'); ?>