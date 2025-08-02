<?php

use yii\helpers\Html;
use common\models\Comment;

?>


<div class="popup-container wide " >
    <div class="popup-header " style="text-align: center;">
       <b> <?php echo $user->username; ?></B>
        <a class="button style-12 size-3 shadow close-popup"><span style=" font-size:14px;"><i class="icon-left-open-1 "></i>назад</span></a>
    </div>

   
        
        <div class="popup-paddings-wide text-center">
		 <div class="empty-space col-xs-b40"></div>
            <div class="row">
               
                <div class="col-sm-12">
                   
                    
                    
                    <div class="row column-line">
                        <div class="col-xs-4">
                            <div class="simple-article"><?php echo Yii::t('app', 'Позитивні'); ?></div>
                            <div class="empty-space col-xs-b5"></div>
                            <div class="smile-entry  active">
                                <span class="positive icon"></span><span
                                        class="text"><?php echo $user->countPositive; ?></span>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="simple-article"><?php echo Yii::t('app', 'Нейтральні'); ?></div>
                            <div class="empty-space col-xs-b5"></div>
                            <div class="smile-entry active">
                                <span class="neutral icon"></span><span
                                        class="text"><?php echo $user->countNeutral; ?></span>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="simple-article"><?php echo Yii::t('app', 'Негативні'); ?></div>
                            <div class="empty-space col-xs-b5"></div>
                            <div class="smile-entry active">
                                <span class="negative icon"></span><span
                                        class="text"><?php echo $user->countNegative; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="empty-space col-xs-b20"></div>
                </div>
				
				<div class="col-sm-6">
			
				<?php
                                        $StyleLinkTooltip='display:none';
                                        
                                        $TextStyleButton='text-green-2';
                                        if ($user->getPhoneApproved() == '0000-00-00 00:00:00') {
											$tooltip = Yii::t('app', ' Ми ще не перевірили телефон клієнта');
                                            $confirmation = Yii::t('app', 'Телефон не підтверджено');
                                            $TextStyleButton='text-grey';
                                            $glyphicon = 'info-circled-alt'; 
											$TextInButton = Yii::t('app', 'Додайте ваш номер');
											$StyleLinkTooltip='color: #0098d0;';
                                        } elseif ($user->getPhoneApproved() != '0000-00-00 00:00:00') {
                                            $confirmation = Yii::t('app', 'Телефон підтверджено');
											$tooltip = Yii::t('app', ' Ми перевірили телефон клієнта');
                                            $glyphicon = 'ok';
                                        }

                ?>
				  <div class="cust-tooltip ">
				          <div class="<?=  $TextStyleButton ?>" ><i class="icon-<?= $glyphicon ?> "></i>&nbsp;&nbsp;<?= $confirmation ?>
                         </div>
				     <div class="tooltip-content left-info-popup-accepted" >
                          <?= $tooltip ?>                         									 
                     </div>
				  </div>
                                       <?php
                                         $StyleLinkTooltip='display:none';
										
                                        if ( $user->getEmailApproved() == '0000-00-00 00:00:00' ) {
                                            $confirmation = Yii::t('app', 'e-mail клієнта не підтверджено');
											$tooltip = Yii::t('app', ' Ми надіслали лінк підтвердження і чекаємо на підтвердження ');
                                            $glyphicon = 'info-circled-alt';
											$TextStyleButton='text-grey';
											$StyleLinkTooltip='color: #0098d0;';
											
											
                                        } elseif ($user->getEmailApproved() != '0000-00-00 00:00:00') {
                                            $confirmation = Yii::t('app', 'e-mail клієнта підтверджено');
											$tooltip = Yii::t('app', 'Ми перевірили e-mail клієнта');
                                            $glyphicon = 'ok';
											$TextStyleButton='text-green-2';
                                        }

                                    ?>
									 <div class="cust-tooltip ">
                                      <div class="<?=  $TextStyleButton ?>" ><i class="icon-<?= $glyphicon ?> "></i>&nbsp;&nbsp;<?= $confirmation ?>
                                      </div >

                                                <div class="tooltip-content left-info-popup-accepted" >
                                                 <?= $tooltip ?> 
                                                 												 
                                                </div>
                                     </div>			  
				  
				</div>
            </div>
        </div>
        <div class="grey-line"></div>

        <?php
        foreach ($user->getUserComments()->all() as $comment) :
            if ($comment['answerID'] || $comment['ID']) :
                ?>
                <div class="popup-paddings-wide">
                    <div class="empty-space col-xs-b20 col-sm-b20"></div>
                    <div class="simple-article dark large text-center">
                        <b><?php echo Yii::t('app','Обмін відгуками'); ?> <?php echo $comment['product'] ? $comment['product'] : $comment['category'] ?></b>
                    </div>
                    <div class="empty-space col-xs-b20 col-sm-b40"></div>
                    <div class="row ">
                        <div class="col-sm-12 col-xs-b20 col-sm-b0">
                            <?php
                            if ($comment['answerID']) :
                                $rating = Comment::Rating($comment['answerRating'])
                                ?>
                                <div class="<?php echo $rating['class']; ?>">
                                    <div class="cloud">
									
                                        <span class="title"><?php echo $rating['name'] . ' ' . Yii::t('app',
                                                    'покупець'); ?></span>
                                        <span class="description"><?php echo $comment['answerComment'] ?></span>
										<span class="icon left"></span>
                                    </div>
                                    <div class="empty-space col-xs-b5"></div>
                                    <div class="simple-article small lightgrey"><span
                                                class="testimonial-title"><b> <?php echo $comment['answerUsername']; ?></b></span> <?php echo $comment['answerUpdated'] ?>
                                    </div>
                                </div>
                                <?php
                            endif;
                            ?>
                        </div>

                        <div class="col-sm-12">
                            <div class="cloud-save-wrapper"
                                 style="display: <?php echo $comment['ID'] ? 'none' : 'block' ?>">
                            </div>
                            <?php
                            if ($comment['ID']) :
                                $rating = Comment::Rating($comment['commentRating']);
                                ?>
                                <div class="cloud-edit-wrapper">
                                    <div class="<?php echo $rating['class']; ?> text-right">
                                        <div class="cloud">
										
                                            <span class="title"><?php echo $rating['name'] . ' ' . Yii::t('app',
                                                        'продавець'); ?></span>
                                            <span class="description"><?php echo $comment['comment'] ?></span>
											<span class="icon right"></span>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            endif;
                            ?>
                            <div class="empty-space col-xs-b5"></div>
                            <div class="simple-article small lightgrey text-right"><span
                                        class="testimonial-title"><b><?php echo $user->username; ?></b></span> <?php echo $comment['commentUpdated'] ?>
                            </div>
                        </div>
                    </div>
                    <div class="empty-space col-xs-b20 col-sm-b40"></div>
                </div>
                <div class="grey-line"></div>
                <?php
            endif;
        endforeach;
        ?>
    </div>
</div>