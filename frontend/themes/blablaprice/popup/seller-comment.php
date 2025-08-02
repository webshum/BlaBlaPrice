<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\User;
use yii\helpers\Url;
use frontend\models\SignupForm;
use common\models\Comment;

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
 * @var \common\models\Order $order
 * @var \common\models\Offer $offer
 */
?>

<div class="popup-container wide">


 


	<?php
    if ($offer->order->product) :
        ?>

		
		<div class="popup-paddings-wide  ">
			<div class="popup-product-name">
				<?php echo $offer->order->product->name ?>
			</div>
			<span class="popup-user-name">
				<?php echo Yii::t('app', 'Запит від '); ?>
					<span class="cust-tooltip " >
						<span class="popup-user-name-first-letter"> <?php echo $offer->order->user->userName; ?></span>
						<div class="tooltip-content left-user-popup" >
							<b><?= Yii::t('app', 'Телефон перевірено.'); ?> </b><br> 
					        <b><?= Yii::t('app', 'Оцінки :'); ?> </b><br>  
                            <b><?php echo $offer->order->user->countPositive; ?> </b> <?= Yii::t('app', '    позитивних '); ?>   <br>  
                            <b><?php echo $offer->order->user->countNeutral; ?> </b> <?= Yii::t('app', '    нейтральних '); ?>    <br>
                            <b><?php echo $offer->order->user->countNegative; ?> </b><?= Yii::t('app', '    негативних '); ?>    <br> 
                           
                        </div> 
						<i class="icon-ok "></i>
					</span>
			</span>
        <a class="button style-10 size-3  close-popup-all"><span><i class="icon-cancel-2 blue-icon"></i></span></a>
		<div class="empty-space col-xs-b15 col-sm-b15"></div>
		 <div class="left-cloud">
		  <div class="user-photo-left">
				<div class="first-letter">
					<?php  $string = mb_substr(strip_tags($offer->order->user->username ), 0, 1);echo $string   ; ?>
				</div> 
			</div> 
			<div class="simple-article extralarge "><b>
			    <?php echo Yii::t('app', 'Бюджет'); ?> <?php echo $offer->order->priceFrom ?> <?php echo Yii::t('app', 'грн'); ?></b>
			</div>
         
           
            <div class="h6 grey "><?= Yii::t('app', 'Куплю'); ?> <?php echo $offer->order->product->name ?>.<br>
				 <?php echo strip_tags($offer->order->comment) ?><br>

			</div>
			


            <div class="row">
             <div class="col-md-12">
			    <div class="text-grey-icon ">
  				    <div class="cust-tooltip ">
					    <div class="inline-align-middle"><i class="icon-hourglass "></i> <?php echo substr(strip_tags($offer->order->deadLine), 0, 10)  ?></div>
							<div class="tooltip-content left-info-popup " >
							<?php echo Yii::t('app', 'Вказаний клієнтом час актуальності запиту'); ?>                        									 
							</div>
					</div>
                </div>
					 
				<div class="text-grey-icon inline ">	 
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
		
		
        

        <?php else :?>
       
       <div class="popup-paddings-wide  ">
			<div class="popup-product-name">
				<?php echo $offer->order->category->name ?> 
			</div>
			<span class="popup-user-name">
				<?php echo Yii::t('app', 'Запит від '); ?>
					<span class="cust-tooltip " >
						<span class="popup-user-name-first-letter"> <?php echo $offer->order->user->userName; ?></span>
						<div class="tooltip-content left-user-popup" >
							<b><?= Yii::t('app', 'Телефон перевірено.'); ?> </b><br> 
					        <b><?= Yii::t('app', 'Оцінки :'); ?> </b><br>  
                            <b><?php echo $offer->order->user->countPositive; ?> </b> <?= Yii::t('app', '    позитивних '); ?>   <br>  
                            <b><?php echo $offer->order->user->countNeutral; ?> </b> <?= Yii::t('app', '    нейтральних '); ?>    <br>
                            <b><?php echo $offer->order->user->countNegative; ?> </b><?= Yii::t('app', '    негативних '); ?>    <br> 
                           
                        </div> 
						<i class="icon-ok "></i>
					</span>
			</span>
       <a class="button style-10 size-3  close-popup-all"><span><i class="icon-cancel-2 blue-icon"></i></span></a>
       <div class="empty-space col-xs-15 col-sm-b15"></div>
		 <div class="left-cloud">
		  <div class="user-photo-left">
								<div class="first-letter">
										<?php  $string = mb_substr(strip_tags($offer->order->user->username ), 0, 1);echo $string   ; ?>
								</div> 
							</div> 
          
           <div class="simple-article extralarge "><b>

                            <?php echo Yii::t('app', 'Бюджет'); ?> <?php echo $offer->order->priceFrom ?> <?php echo Yii::t('app', 'грн'); ?>
                              
                           
			             
                    </b></div>
					 
            
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
				<br>

			</div>
			
			 




              
          
          
			
			
           <div class="row">
             <div class="col-md-12">
                   
					
					
					
                    <div class="text-grey-icon ">
					
                    <div class="cust-tooltip ">
				    
			           <div class="inline-align-middle"><i class="icon-hourglass "></i> <?php echo substr(strip_tags($offer->order->deadLine), 0, 10)  ?></div>
                            
                   
				    <div class="tooltip-content left-info-popup " >
                         <?php echo Yii::t('app', 'Вказаний клієнтом час актуальності запиту'); ?>                        									 
                    </div>
				   </div>
                    
					</div>
				<div class="text-grey-icon inline ">	 
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
        
        <?php
    endif;
    ?>


  
       
     
       
        <div class="popup-paddings-wide text-right">
			<div class="right-cloud">
				<div class="right-cloud-data"><?= $offer->getUpdatedAt() ?></div>
				<div class="simple-article extralarge ">
                    <b><?php echo Yii::t('app', 'Ціна'); ?> <?php echo $offer->price; ?> <?php echo Yii::t('app', 'грн.'); ?></b></div>
                    <div class="h6 grey ">
                        <?php echo strip_tags($offer->comment); ?>
                    </div>
                    <div class="previews-row">
                        <?php if (is_array($offer->getGalleryImage()))
								{
									foreach ($offer->getGalleryImage() as $image) 
									{
										echo '<a class="product-thumnail open-popup" data-param="' . $offer->ID . '" data-type="offer" data-rel="gallery"><img src="' . $image . '" alt="" /></a>';
                                    }
                                }
                        ?>
                    </div>
            </div>
		</div>
     
    

      
          
            <div class="popup-paddings-wide ">    
				<div class="left-cloud">
					<div class="user-photo-left">
						<div class="first-letter">
							<?php  $string = mb_substr(strip_tags($offer->order->user->username ), 0, 1);echo $string   ; ?>
						</div> 
					</div>
					<div class="h6 grey ">
		             	<b><?php echo Yii::t('app','Мої контакти : '); ?></b><br/>
                        <?= $offer->order->user->username ?><br/>
						<?php echo $offer->order->user->phone; ?><br/>
						 <?php echo $offer->order->user->email; ?>
                    </div>
				</div>
			</div>
			 
		
	
	
	
              
    <div class="popup-paddings-wide ">
		
        <div class="row">
		 <div class="col-sm-12">
                <?php
                $comments = $offer->getAnswer($offer->userID)->one();
                $refuse = $offer->getRefuse($offer->order->userID)->one();
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
						
                            <span class="title"><?php echo $rating['name'] . ' ' . Yii::t('app', 'продавець'); ?></span>
                            <span class="description"><?php echo strip_tags($comments->comment); ?></span>
							  <div class="left-cloud-data">
                         
                               <?= $comments->getUpdatedAt() ?>
                           
                         
                        </div>
							
							
                        </div>
                      
                      
                    </div>
                <?php elseif ($refuse) : ?>
                    <div class="neutral refusal ">
                        <div class="cloud">
						     <div class="user-photo-left">
								<div class="first-letter">
										<?php  $string = mb_substr(strip_tags($refuse->userFrom->username), 0, 1);echo $string   ; ?>
								</div> 
							</div> 
                             <div class="cust-tooltip ">
														  <span class="title"><?php echo Yii::t('app',
                                                                'Відмовився'); ?>
																 <i class="icon-help-circled-alt "></i>
														  </span>
														
					   
			                                              <div class="tooltip-content left-best-price ">
					                                        <?php echo $refuse->userFrom->username; ?><?php echo Yii::t('app',' відмовився від вашої пропозиції і вказав причину відмови'); ?>  
                                                          </div> 
					          </div>
                           <?php if ($refuse->comment ) :
                    ?>
					 <span class="description"><?php echo $refuse->comment ?></span>
					  
                   
					 <?php else : ?>
				    <span class="description"><?php echo  Yii::$app->params['refuse'][$refuse->refuseID]  ?></span>
					 
					 <?php
                    endif;
                    ?>
					 <div class="feft-cloud-data">
                          
                                <?php echo $refuse->getUpdatedAt() ?>
                         
                          
                        </div>
                        </div>
                       
                       
                    </div>
                    <?php
                endif;
                ?>
            </div>
            <div class="col-sm-12" >
                <?php
                $answer = $offer->getAnswer($offer->userID)->all();
                $refuse = $offer->getRefuse($offer->order->userID)->all();
                if (!empty($answer) && empty($refuse)) :
                    ?>
					
                    <div class="cloud-save-wrapper"
					
                         style="display: <?php echo $offer->getComment($offer->userID)->one() ? 'none' : 'block' ?> ">
						 <div class="left-cloud">
							<div class="user-photo-left icon-logo">
								<img src="/img/icon-logo.png" alt="">
							</div>
							<b>
								<?php echo Yii::t('app', 'Оцініть покупця -'); ?> <?= $offer->order->user->username ?>
							</b>
						</div>
                        <?php
                        echo Html::beginForm(['cabinet/comment']);
                        echo Html::hiddenInput('Comment[userFromID]', $offer->userID);
                        echo Html::hiddenInput('Comment[userToID]', $offer->order->userID);
                        echo Html::hiddenInput('Comment[offerID]', $offer->ID);
                        if ($offer->getComment($offer->userID)->one()) {
                            echo Html::hiddenInput('Comment[ID]', $offer->getComment($offer->userID)->one()->ID);
                        } else {
                            echo Html::hiddenInput('Comment[ID]', '');
                        }
                        echo Html::hiddenInput('Comment[rating]', Comment::RATING_GOOD);
                        ?>
						<div class="padding-tabs ">
                        <div class="testimonial-edit tabs-block">
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
									<span><?php echo Yii::t('app', ' Надійний покупець'); ?></span>
								</a></div>
                                <div class="testimonial-edit-title tab-entry neutral"> <a class="button style-1 size-2 shadow submit-form" href="#">
									<span><?php echo Yii::t('app', ' Нормальний покупець'); ?></span>
								</a></div>
                                <div class="testimonial-edit-title tab-entry negative"> <a class="button style-1 size-2 shadow submit-form" href="#">
									<span><?php echo Yii::t('app', ' Ненадійний покупець'); ?></span>
								</a></div>
								  </div>
                            <?php
                            echo Html::textarea('Comment[comment]',
                                $offer->getComment($offer->userID)->one() ? strip_tags($offer->getComment($offer->userID)->one()->comment) : '',
                                [
                                    'class' => 'simple-input size-3',
									
                                    'placeholder' => Yii::t('app', 'Залиште відгук (необов\'язково)')
									

                                ]);
                            ?>
                     
					 
						
						</div>
						</div>
                        <?php
                        echo Html::endForm();
                        ?>
                    </div>
				
                    <?php
                endif;

                if ($offer->getComment($offer->userID)->one()) :
                    $rating = Comment::Rating($offer->getComment($offer->userID)->one()->rating);
                    ?>
                    <div class="cloud-edit-wrapper" style="display: block;">
                        <div class="<?php echo $rating['class']; ?> text-right">
                            <div class="cloud">
						
                                <span class="title"><?php echo $rating['name'] . ' ' . Yii::t('app',
                                            'покупець'); ?></span>
                                <span class="description"><?php echo strip_tags($offer->getComment($offer->userID)->one()->comment) ?></span>
								 <div class="cloud-edit"><?php echo Yii::t('app', 'редагувати'); ?></div> 
                            </div>
							
                          
                        </div>
                    </div>
                   
                 
                    <?php
                endif;
                ?>
            </div>
           
        </div>
      
    </div>

	
	<div class="empty-space col-xs-b20 col-sm-b20"></div>
</div>

<script type="text/javascript">

    setInterval(function () {
        setTimer($('.time-entry[data-rel="17"]'), $('#datepicker').html());
    }, 1000);

    function setTimer(wrapper, finalTime) {
        var today = new Date().getTime();
        var interval = finalTime - today;
        if (interval < 0) interval = 0;
        var days = parseInt(interval / (1000 * 60 * 60 * 24));
        var daysLeft = interval % (1000 * 60 * 60 * 24);
        var hours = parseInt(daysLeft / (1000 * 60 * 60));
        var hoursLeft = daysLeft % (1000 * 60 * 60);
        var minutes = parseInt(hoursLeft / (1000 * 60));
        var minutesLeft = hoursLeft % (1000 * 60);
        var seconds = parseInt(minutesLeft / (1000));
        wrapper.find('.days').text(days);
        wrapper.find('.hours').text(hours);
        wrapper.find('.minutes').text(minutes);
        wrapper.find('.seconds').text((seconds < 10) ? '0' + seconds : seconds);
    }
</script>