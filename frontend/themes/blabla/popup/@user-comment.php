<?php

use yii\helpers\Html;
use common\models\Comment;
use yii\widgets\ActiveForm;
use common\models\User;
use yii\helpers\Url;
use frontend\models\SignupForm;

// Set current user phone :
if (Yii::$app->user->isGuest) {
    $user = new \common\models\User();
} else {
    $user = Yii::$app->user->identity;
}

// generate regions
$user = User::findOne(['ID' => Yii::$app->user->id]);
$regionList = [];
$regionList = array_merge($regionList, Yii::$app->params['region'][$_SESSION['language']]);


/**
 * @var \yii\web\View $this
 * @var \common\models\Offer $offer
 * @var Comment $comments
 */
?>

<div class="popup-container wide">
    <?php
    if ($offer->order->product) :
        ?>
       
        <div class="popup-paddings-wide ">
			<div class="popup-product-name">
				<?php echo $offer->order->product->name ?>
			</div>
			<span class="popup-user-name">
				<?php echo Yii::t('app', 'Пропозиція від'); ?> <?php echo $offer->user->username ?>
			
			</span>
			<a class="button style-10 size-3  close-popup-all"><span><i class="icon-cancel-2 blue-icon"></i></span></a>
        <div class="empty-space col-xs-b15 col-sm-b15"></div>
			<div class="text-right">
				<div class="right-cloud">
					<div class="simple-article extralarge  ">
						<b>
							<?php echo Yii::t('app', 'Бюджет'); ?>
							<?php echo $offer->order->priceFrom ?>
                            <?php echo Yii::t('app', 'грн'); ?>
                        </b>
					</div>
					<div class="h6 grey "><?= Yii::t('app', 'Куплю'); ?> <?php echo $offer->order->product->name ?>.<br>
						<?php echo strip_tags($offer->order->comment) ?>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div style="display: none" id="datepicker"><?php echo strtotime($offer->order->deadLine) * 1000; ?></div>
							<div class="text-blue-icon ">
								<div class="cust-tooltip ">
									<div class="inline-align-middle"><i class="icon-hourglass "></i> <?php echo substr(strip_tags($offer->order->deadLine), 0, 10)  ?></div>
									<div class="tooltip-content left-info-popup " >
									<?php echo Yii::t('app', 'Вказаний клієнтом час актуальності запиту'); ?>                        									 
								</div>
								</div>
							</div>
							<div class="text-blue-icon inline ">	 
								<div class="cust-tooltip ">
									<i class="icon-location-4 "></i>
									<span>
										<?php echo $regionList[$offer->order->regionID];  ?>
									</span>
									<div class="tooltip-content left-info-popup " >
										<?php echo Yii::t('app', 'Вибраний клієнтом регіон запиту '); ?>                        									 
									</div>
								</div>
							</div>	 
					 
					
						</div> 
					</div>
				</div> 
			</div>
		</div>
        <?php
    else:
        ?>
       
		<div class="popup-paddings-wide  ">
			<div class="popup-product-name">
				<?php echo $offer->order->category->name ?>
			</div>
			<span class="popup-user-name">
				<?php echo Yii::t('app', 'Пропозиція від'); ?> <?php echo $offer->user->username ?>
			</span>
			<a class="button style-10 size-3  close-popup-all"><span><i class="icon-cancel-2 blue-icon"></i></span></a>
			<div class="empty-space col-xs-b15 col-sm-b15"></div>
			<div class="text-right">
				<div class="right-cloud ">
					<div class="simple-article extralarge ">
						<b>
							<?php echo Yii::t('app', 'Бюджет:'); ?>
							<?php echo $offer->order->priceFrom ?>
                            <?php echo Yii::t('app', 'грн'); ?>
                        </b>
					</div>
					<div class="h6 grey "><?= Yii::t('app', 'Запропонуйте'); ?> <?php echo $offer->order->category->name ?>  <br>
						<?php
						$string = '';
						$filter = explode('; ', $offer->order->filter);
						foreach ($filter as $filter_item) {
							$filter_value = explode(': ', $filter_item);
							if ($filter_value[0] != '' && isset($filter_value[1])) {
								$string .= '<b>' . $filter_value[0] . ':</b> ' . $filter_value[1] . '; <br>  ';
							}
						}
						echo $string;
						?>
						<?php echo strip_tags($offer->order->comment) ?>
					</div>
					<div class="row">
				      <div class="col-md-12">
						<div style="display: none" id="datepicker"><?php echo strtotime($offer->order->deadLine) * 1000; ?></div>
						<div class="text-blue-icon ">
							<div class="cust-tooltip ">
								<div class="inline-align-middle"><i class="icon-hourglass "></i> <?php echo substr(strip_tags($offer->order->deadLine), 0, 10)  ?></div>
								<div class="tooltip-content left-info-popup " >
								<?php echo Yii::t('app', 'Вказаний клієнтом час актуальності запиту'); ?>                        									 
								</div>
							</div>
						</div>
						<div class="text-blue-icon inline ">	 
							<div class="cust-tooltip ">
								<i class="icon-location-4 "></i>
								<span>
									<?php echo $regionList[$offer->order->regionID];  ?>
								</span>
								<div class="tooltip-content left-info-popup " >
									<?php echo Yii::t('app', 'Вибраний клієнтом регіон запиту '); ?>                        									 
								</div>
							</div>
						</div>	 
					
					  </div> 
					</div>
				</div>
			</div>
		</div>
    <?php endif; ?>

   
   
      
            <div class="popup-paddings-wide">
			 <div class="left-cloud">
				<div class="left-cloud-data"><?= $offer->getUpdatedAt() ?></div>
				<div class="user-photo-left">
					<div class="first-letter">
						<?php  $string = mb_substr(strip_tags($offer->user->username ), 0, 1);echo $string   ; ?>
					</div> 
				</div>
				<div class="simple-article extralarge ">
                    <b><?php echo Yii::t('app', 'Ціна'); ?><?php echo $offer->price; ?><?php echo Yii::t('app', 'грн'); ?></b></div>
                    <div class="h6 grey ">
                            <?php echo strip_tags($offer->comment); ?>
                    </div>
                    <div class="previews-row">
                        <?php
							if (is_array($offer->getGalleryImage())) {
                                foreach ($offer->getGalleryImage() as $image) {
                                    echo '<a class="product-thumnail open-popup" data-param="' . $offer->ID . '" data-type="offer" data-rel="gallery"><img src="' . $image . '" alt="" /></a>';
                                }
                            }
                        ?>
                    </div>
            </div>
		   </div>
			
			
    <div class="popup-paddings-wide">
		<div class="left-cloud">
			<div class="user-photo-left">
				<div class="first-letter">
					<?php  $string = mb_substr(strip_tags($offer->user->username ), 0, 1);echo $string   ; ?>
				</div> 
			</div>
			<b> <?php echo Yii::t('app', 'Контакти '); ?> </b> 
			<div class="h6 grey  "> <?php echo $offer->user->username ?></div>
			<div class="h6 grey  "><?php echo $offer->user->phone; ?></div>
			<div class="h6 grey  "><?php echo $offer->user->email; ?></div>
		
        </div>
	</div>
    <div class="popup-paddings-wide">
  

        <?php
        $new_order = false;
        if ($offer->getAnswer(Yii::$app->user->id)->one()) :
            $offer_comment = $offer->getAnswer(Yii::$app->user->id)->one();
        
        endif;
        ?>
		
		
	
		
		  
       
           
              
             
                    
                 
              
       

        <?php

        if ( $offer->getAnswer($offer->userID)->one()) :           
		
            ?>

			<?php $rating_answ = Comment::Rating($offer->getAnswer($offer->userID)->one()->rating); ?>
         
               
                <div class="row  ">
				
                
                    <div class="col-sm-12 " >
					
                        <div class="cloud-save-wrapper" style="display: none">
						<div class="left-cloud">
							<div class="user-photo-left icon-logo">
								<img src="/img/icon-logo.png" alt="">
							</div>
							<b>
								<?php echo Yii::t('app', 'Ви можете змінити коментар'); ?>
							</b>
						</div>
						
                            <?php
                            echo Html::beginForm(['cabinet/comment']);
                            echo Html::hiddenInput('Comment[userFromID]', $offer->order->userID);
                            echo Html::hiddenInput('Comment[userToID]', $offer->userID);
                            echo Html::hiddenInput('Comment[offerID]', $offer->ID);
                            if ($offer->getAnswer($offer->userID)->one()) {
                                echo Html::hiddenInput('Comment[ID]', $offer->getAnswer($offer->userID)->one()->ID);
                            } else {
                                echo Html::hiddenInput('Comment[ID]', '');
                            }
                            echo Html::hiddenInput('Comment[rating]', Comment::RATING_GOOD);
                            ?>

							 <div class="padding-tabs "  >
                            <div class="testimonial-edit tabs-block " >                 
							
							<div class="comment" >
							
                                <div class="smile-entry smile-button tab-menu active inline-align-middle align-1">
                                    <span value="<?php echo Comment::RATING_GOOD ?>" class="positive icon"><i class="icon-smile "></i></span>
                                </div>
                                <div class="smile-entry smile-button tab-menu inline-align-middle align-1">
                                    <span value="<?php echo Comment::RATING_NEUTRAL ?>" class="neutral icon"><i class="icon-meh "></i></span>
                                </div>
                                <div class="smile-entry smile-button tab-menu inline-align-middle">
                                    <span value="<?php echo Comment::RATING_BAD ?>" class="negative icon"><i class="icon-frown "></i></span>
                                </div>
                             
                                <div class="testimonial-edit-title tab-entry positive"
                                     style="display: block;"> <a class="button style-1 size-2 shadow submit-form" href="#">
									<span><?php echo Yii::t('app', ' Надійний продавець'); ?></span>
								</a></div>
                                <div class="testimonial-edit-title tab-entry neutral"> <a class="button style-1 size-2 shadow submit-form" href="#">
									<span><?php echo Yii::t('app', ' Нормальний продавець'); ?></span>
								</a></div>
                                <div class="testimonial-edit-title tab-entry negative"> <a class="button style-1 size-2 shadow submit-form" href="#">
									<span><?php echo Yii::t('app', ' Ненадійний продавець'); ?></span>
								</a></div>
								  </div>
                                <?php
                                echo Html::textarea('Comment[comment]',
                                    $offer->getAnswer($offer->userID)->one() ? strip_tags($offer->getAnswer($offer->userID)->one()->comment) : '',
                                    [
                                        'class' => ' simple-input size-3',
                                        'placeholder' => Yii::t('app', 'Залиште відгук (необов\'язково)')
                                    ]);
                                ?>
                          	<div class="empty-space col-xs-b40 col-sm-b40"></div>
							</div>
							 </div>
                            <?php
                            echo Html::endForm();
                            ?>
                        </div>

                        <div class="cloud-edit-wrapper text-right" style="display: block;">
                            <div class="<?php echo $rating_answ['class']; ?>">
                                <div class="cloud">
                                    <span class="title"><?php echo $rating_answ['name'] . ' ' . Yii::t('app',
                                                'продавець'); ?></span>
                                    <span class="description"><?php echo strip_tags($offer->getAnswer($offer->userID)->one()->comment) ?></span>
								  <div class="cloud-edit"><?php echo Yii::t('app', 'редагувати'); ?></div>
                                </div>
                              
                            </div>
                        </div>
                        
                       
                    </div>
                </div>
               
           
            <?php
        elseif ($offer->getRefuse($offer->order->userID)->one()):
            $refuse = $offer->getRefuse($offer->order->userID)->one();
            ?>
            <div class="neutral text-right refusal">
                <div class="cloud">
				<div class="left-cloud-data"> <?php echo $refuse->updated_at; ?>
                </div>
                    <span class="title"><?php echo Yii::t('app', 'Я відмовився'); ?></span>
                   <?php if ($refuse->comment ) :
                    ?>
					 <span class="description"><?php echo $refuse->comment ?></span>
                   
					 <?php else : ?>
				    <span class="description"><?php echo  Yii::$app->params['refuse'][$refuse->refuseID]  ?></span>
					 <?php
                    endif;
                    ?>
                </div>
                <div class="empty-space col-xs-b5"></div>
                
            </div>
            <?php
        else :
            ?>
		
			<div class="left-cloud">
							<div class="user-photo-left icon-logo">
								<img src="/img/icon-logo.png" alt="">
							</div>
							<b>
								<?php echo Yii::t('app', 'Оцініть продавця'); ?>
							</b>
			</div>
            <div class="rate-block-2">
            <div class="tabs-block left35">
                <div class="like-tabs">
                   
                     
				    
                        <div class="entry-2 tab-menu active green" style="display: inline-block">
                            <?php echo Yii::t('app', 'Оцінити'); ?>
                        </div>
                        <div
                                class="entry-2 tab-menu  red" ><?php echo Yii::t('app', 'Я відмовився'); ?>
						</div>
                  
                </div>
				

                <?php
				
                if ($offer_comment) {
                    $comment_item = $offer_comment;
                } else {
                    $comment_item = $comment;
                }

               
                    ?>
                    <div class="tab-entry" style="display: block;"  >
                    
                        <?php
                        $form = ActiveForm::begin([
                            'action' => ['cabinet/accepted'],
                            'fieldConfig' => ['template' => "{input}", 'options' => ['tag' => false]]
                        ]);
                        echo $form->field($comment_item,
                            'userFromID')->hiddenInput(['value' => Yii::$app->user->id])->label(false);
                        echo $form->field($comment_item,
                            'userToID')->hiddenInput(['value' => $offer->userID])->label(false);
                        echo $form->field($comment_item, 'offerID')->hiddenInput(['value' => $offer->ID])->label(false);
                        echo $form->field($comment_item,
                            'rating')->hiddenInput(['value' => Comment::RATING_GOOD])->label(false);
                        if ($offer_comment) {
                            echo $form->field($comment_item,
                                'ID')->hiddenInput(['value' => $offer_comment->ID])->label(false);
                        }
                        ?>

                        <div class="testimonial-edit tabs-block">
						<div class="comment">
						
                            <div class="smile-entry smile-button tab-menu inline-align-middle align-1 active">
                                <span value="<?php echo Comment::RATING_GOOD ?>" class="positive icon"><i class="icon-smile "></i></span>
                            </div>
                            <div class="smile-entry smile-button tab-menu inline-align-middle align-1">
                                <span value="<?php echo Comment::RATING_NEUTRAL ?>" class="neutral icon"><i class="icon-meh "></i></span>
                            </div>
                            <div class="smile-entry smile-button tab-menu inline-align-middle">
                                <span value="<?php echo Comment::RATING_BAD ?>" class="negative icon"><i class="icon-frown "></i></span>
                            </div>
                            <div class="testimonial-edit-title tab-entry positive" style="display: block;">
                               <a class="button style-1 size-2 shadow submit-form" href="#">
									<span><?php echo Yii::t('app', ' Надійний продавець'); ?></span>
								</a>
                            </div>
                            <div class="testimonial-edit-title tab-entry neutral">
                               <a class="button style-1 size-2 shadow submit-form" href="#">
									<span><?php echo Yii::t('app', 'Нормальний продавець'); ?></span>
								</a>
                            </div>
                            <div class="testimonial-edit-title tab-entry negative">
                           <a class="button style-1 size-2 shadow submit-form" href="#">
									<span><?php echo Yii::t('app', 'Ненадійний продавець'); ?></span>
								</a>
                            </div>
							
						</div> 
                          
                            <?php
                            echo $form->field($comment_item, 'comment')->textarea([
                                'class' => 'simple-input size-3',
                                'placeholder' => Yii::t('app', 'Залиште відгук')
                            ])->label(false);
                            ?>
                           
                           
                       	<div class="empty-space col-xs-b30 col-sm-b30"></div>
                        </div>
                        <?php ActiveForm::end(); ?>
                   
				</div>
               
                <div class="tab-entry" >
				
                    <?php
                    $form = ActiveForm::begin([
                        'action' => ['cabinet/accepted'],
                        'fieldConfig' => ['template' => "{input}", 'options' => ['tag' => false]]
                    ]);
                    echo $form->field($comment_item,
                        'userFromID')->hiddenInput(['value' => Yii::$app->user->id])->label(false);
                    echo $form->field($comment_item,
                        'userToID')->hiddenInput(['value' => $offer->userID])->label(false);
                    echo $form->field($comment_item, 'offerID')->hiddenInput(['value' => $offer->ID])->label(false);
                    if ($offer_comment) {
                        echo $form->field($comment_item,
                            'ID')->hiddenInput(['value' => $offer_comment->ID])->label(false);
                    }
                    ?>
                    <div class="comment-2">
					<div class="row">
                   
                        <?php
                        foreach (Yii::$app->params['refuse'] as $key => $refuse_item) :
                            ?>
                            <div class="col-sm-12 col-xs-b15">
                                <label class="checkbox-entry radio">
                                    <?php
                                    echo \yii\helpers\Html::radio('Comment[refuseID]',
                                        $offer_comment->refuseID == $key ? true : false, ['value' => $key]);
                                    ?>
                                    <span><?php echo $refuse_item ?></span>
                                </label>
                            </div>
                            <?php
                        endforeach;
                        ?>
                   
					
					 <a class="button style-1 size-2 shadow submit-form" href="#">
                        <span>
                            <?php echo Yii::t('app', 'ЗАЛИШИТИ'); ?></span></a>
					
					</div>
                    <div class="row">
                        <div class="col-sm-12 ">
                            <label class="checkbox-entry display-block radio">
                                <?php
                                echo \yii\helpers\Html::radio('Comment[refuseID]', false, ['value' => 0]);
                                ?>
                                <span>
                                    <?php
                                    echo $form->field($comment_item, 'comment')->textarea([
                                        'class' => 'simple-input size-3',
                                        'onfocus' => 'jQuery("input[type=radio][value=0]").attr("checked", true)',
                                        'placeholder' => Yii::t('app', 'Інша причина відмови')
                                    ])->label(false);
                                    ?>
                                </span>
                            </label>
								<div class="empty-space col-xs-b10 col-sm-b10"></div>
                        </div>
                    </div>
					 </div>
                   
                    <?php
                    ActiveForm::end();
                    ?>
			
               
				</div>
            </div>
		</div>
		
	 
            <?php
        endif;
        ?>
      
		  <?php
                $comments = $offer->getAnswer($offer->order->userID)->one();
              
                ?>
                <?php if ($comments) : ?>
				
                   
                  
                    <?php $rating = Comment::Rating($comments->rating) ?>
                    <div class="<?php echo $rating['class']; ?> ">
                        <div class="cloud">
							<div class="user-photo-left">
								<div class="first-letter">
									<?php  $string = mb_substr(strip_tags($comments->userFrom->username), 0, 1);echo $string   ; ?>
								</div> 
							</div> 
						
                            <span class="title"><?php echo $rating['name'] . ' ' . Yii::t('app', 'покупець'); ?></span>
                            <span class="description"><?php echo strip_tags($comments->comment); ?></span>
							  <div class="left-cloud-data">
                         
                               <?= $comments->getUpdatedAt() ?>
                           
                         
                        </div>
							
							
                        </div>
                          <div class="empty-space col-xs-b20 col-sm-b20"></div>
                      
                    </div>
                <?php endif; ?>

    </div>
