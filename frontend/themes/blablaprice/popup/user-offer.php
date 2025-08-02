<?php
/**
 * @var \yii\web\View $this
 * @var \common\models\Offer $offer
 */
?>

<div class="popup-container wide" >
    <div class="popup-header " style="text-align: center;">
       
        <a class="button style-12 size-3 shadow close-popup"><span style=" font-size:14px;"><i class="icon-left-open-1 "></i><?php echo $offer->user->username; ?></span></a>
    </div>

    <div class="tabs-block">

       
        <div class="tab-entry" style="display: block;">
		

           
            <div class="popup-paddings-wide " style="background-color: #8bafef;">
                  <div class="empty-space col-xs-b25 col-sm-b25"></div>
				 <div class="blabla-comment">
			<div class="user-photo-left icon-logo">
				<img src="/img/icon-logo.png" alt="">
			</div>
			<b>
				<?= Yii::t('app', 'Відгуки про '); ?> <?php echo $offer->user->username; ?>
				<br>
               <?php echo $offer->user->countPositive; ?> <?php echo Yii::t('app', 'позитивних'); ?>,
			     <?php echo $offer->user->countNeutral; ?> <?php echo Yii::t('app', 'нейтральних'); ?>,
				   <?php echo $offer->user->countNegative; ?> <?php echo Yii::t('app', 'негативних'); ?>
              
				</b>
		</div>
		 <div class="empty-space col-xs-b20 col-sm-b20"></div>
           
            </div>
          
            <?php
            foreach ($offer->user->getUserComments($offer->userID)->all() as $comments) :
                if ($comments['ID'] || $comments['answerID']) :
                    ?>
                    <div class="popup-paddings-wide">
                        <div class="empty-space col-xs-b20 col-sm-b20"></div>
                      
                    
                        <div class="row  ">

                           
                            <?php
                            if ($comments['answerID']) :
                                ?>
                                <div class="col-sm-12">
                                    <div class="<?php echo \common\models\Comment::Rating($comments['answerRating'])['class'] ?> ">
									<div class="simple-article small lightgrey"><span
                                                    class="testimonial-title"><b><?php echo $comments['answerUsername']; ?></b></span> <?php echo $comments['answerUpdated']; ?>
                                        </div>
                                        <div class="cloud" style="margin-left: 0px;margin-bottom: 5px;">
                                            <span class="title">
											<?php echo Yii::t('app', 'Замовляв '); ?><?php echo $comments['product'] ? $comments['product'] : $comments['category']; ?> - 
											<?php echo \common\models\Comment::Rating($comments['answerRating'])['name'] . ' ' . Yii::t('app',
                                                        'продавець'); ?></span>
                                            <span class="description"><?php echo $comments['answerComment']; ?></span>
											
                                        </div>
										<div class="empty-space col-xs-b10 col-sm-b10"></div>
                                        
                                        
                                    </div>
                                </div>
                                <?php
                            endif;
                            ?>
							 <div class="col-sm-12">
                                <?php
                                if ($comments['ID']) :
                                    ?>
                                    <div class="cloud-edit-wrapper">
                                        <div class="<?php echo \common\models\Comment::Rating($comments['commentRating'])['class'] ?> text-right">
                                            <div class="cloud" style="margin-bottom: 5px; background: #fff; box-shadow: 0 1px 0 0 #cecbcb; ">
                                                <span class="title"><?php echo \common\models\Comment::Rating($comments['commentRating'])['name'] . ' ' . Yii::t('app',
                                                            'покупець'); ?></span>
                                                <span class="description"><?php echo $comments['comment']; ?></span>
											
                                            </div>
                                        
                                    </div>

                                   
                                    <div class="simple-article small lightgrey text-right"><span
                                                class="testimonial-title"><b><?php echo $offer->user->username; ?></b></span><?php echo $comments['commentUpdated']; ?>
                                    </div>
									</div>
                                    <?php
                                endif; ?>
                            </div>
                        </div>
                        <div class="empty-space col-xs-b20 col-sm-b20"></div>
                    </div>
                    <div class="grey-line"></div>
                    <?php
                endif;
            endforeach;
            ?>
        </div>
    </div>
</div>