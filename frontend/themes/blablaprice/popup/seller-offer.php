<?php

use yii\helpers\Html;
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
 * @var \common\models\Order $order
 * @var \common\models\Offer $offer
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
            <div class="simple-article extralarge  "><b>

                            <?php echo Yii::t('app', 'Бюджет'); ?>

                                <?php echo $offer->order->priceFrom ?>
                                <?php echo Yii::t('app', 'грн'); ?>



                    </b></div>

         
            <div class="h6 grey "><?= Yii::t('app', 'Куплю'); ?> <?php echo $offer->order->product->name ?>.
				 <?php echo strip_tags($offer->order->comment) ?>

			</div>
			


            <div class="row">
             <div class="col-md-12">
                    <div style="display: none" id="datepicker"><?php echo strtotime($offer->order->deadLine) * 1000; ?></div>



                    <div class="text-grey-icon ">

                    <div class="cust-tooltip ">

			            <div class="time-entry inline-align-middle" data-rel="17">
                        <div class="inline-align-middle">
                                                       <span class="days2">
                                                         <?php 
                                                           $now=new DateTime(); 
                                                           $date = DateTime::createFromFormat("Y-m-d H:i:s", $offer->order->deadLine); 
                                                           $interval = $now->diff($date); 
                                                           echo $interval->d>0?'<i class="icon-hourglass "></i>'.$interval->d:'<i class="icon-fire-station "></i>'.$interval->h;
                                                         ?>
                                                       </span><?=$interval->d>0?Yii::t('app', ' днів '):Yii::t('app', ' годин '); ?>
                        
                        </div>


                     </div>


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
		  <div class="empty-space col-xs-b15 col-sm-b15"></div>
		 <div class="left-cloud">
		   <div class="user-photo-left">
				<div class="first-letter">
					<?php  $string = mb_substr(strip_tags($offer->order->user->username ), 0, 1);echo $string   ; ?>
				</div> 
			</div>
          <div class="simple-article extralarge "><b>

                            <?php echo Yii::t('app', 'Бюджет:'); ?>

                                <?php echo $offer->order->priceFrom ?>
                                <?php echo Yii::t('app', 'грн'); ?>



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
                ?><br>
				 <?php echo strip_tags($offer->order->comment) ?>
				

			</div>

			<div class="row">
             <div class="col-md-12">
                    <div style="display: none" id="datepicker"><?php echo strtotime($offer->order->deadLine) * 1000; ?></div>



                    <div class="text-grey-icon ">

                    <div class="cust-tooltip ">

			           <div class="time-entry inline-align-middle" data-rel="17">
                        <div class="inline-align-middle">
                                                       <span class="days2">
                                                         <?php 
                                                           $now=new DateTime(); 
                                                           $date = DateTime::createFromFormat("Y-m-d H:i:s", $offer->order->deadLine); 
                                                           $interval = $now->diff($date); 
                                                           echo $interval->d>0?'<i class="icon-hourglass "></i>'.$interval->d:'<i class="icon-fire-station "></i>'.$interval->h;
                                                         ?>
                                                       </span><?=$interval->d>0?Yii::t('app', ' днів '):Yii::t('app', ' годин '); ?>
                        
                        </div>


                     </div>


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











    <div class="popup-paddings-wide text-right ">
   

		<div class="right-cloud">
		<div class="right-cloud-data"><?= $offer->getUpdatedAt() ?></div>
            
          
			  
                <div class="h6 grey inline ">
					 <b><?php echo $offer->price  . ' ' . Yii::t('app','грн'); ?></b>
						<?= $offer->comment ?>
						
						
				</div>
				
			
		</div>
		
    </div>

		<?php if ($offer->order->bestOffer->price <  $offer->price):?>
							  
		<div class="popup-paddings-wide ">
	<div class="blabla-comment">  
	  <div class="user-photo-left icon-logo">
													<img src="/img/icon-logo.png" alt="">
												</div>
	 <span>
	  
			<?php echo Yii::t('app', 'Найкраща ціна '); ?>
			<b><?php echo $offer->order->bestOffer->price . ' ' . Yii::t('app','грн'); ?></b> 
			<?php echo Yii::t('app', 'Ви можете знижувати ціну поки клієнт не обере одну з пропозицій'); ?>
			</span>
		</div>
		</div>
	<?php endif; ?>
	


<div class="empty-space col-xs-b25 col-sm-b25"></div>
	
    <div class="popup-paddings-wide" style="margin-left:35px;">
		
	
        <?php
        $form = ActiveForm::begin([
            'action' => ['cabinet/offer'],
            'fieldConfig' => ['template' => "{input}", 'options' => ['tag' => false]]
        ]);
        echo $form->field($offer, 'userID')->hiddenInput(['value' => Yii::$app->user->id])->label(false);
        echo $form->field($offer, 'ID')->hiddenInput(['value' => $offer->ID])->label(false);
        echo $form->field($offer, 'orderID')->hiddenInput(['value' => $offer->order->ID])->label(false);
        ?>


       
		<div class="cust-tooltip" style="display: inline-block;">
        <?php echo $form->field($offer, 'price')->textInput([
            'class' => 'simple-input size-5 ',
            'placeholder' => Yii::t('app', 'Введіть ціну'),
           
        ])->label(false) ?>
		 <div class="up-label"><?= Yii::t('app', 'Оновити ціну'); ?> </div>
                        <div class="tooltip-content left-price-popup ">
                           <?php echo Yii::t('app', 'Вкажіть нову ціну '); ?>
                        </div>
		 </div>
		 <span class="price-val"><?= Yii::t('app', 'грн'); ?></span>
		
		 <a class="button style-30  submit-form" href="#"><span><?php echo Yii::t('app',
                            'Змінити'); ?></span></a>

       		<div class="empty-space col-xs-b10 col-sm-b10"></div>





            <div class="row">
				    <div class="col-sm-12 ">
				     <?php echo $form->field($offer, 'comment')->textarea([
						'class' => 'simple-input size-3',
						'placeholder' => Yii::t('app', 'Ваш коментар')
						])->label(false) ?>
                    </div>
					 <div class="col-sm-12 ">

						    <div class="previews-row">

									<div class="list-files-uploaded">
										<a class="button style-21 " href="#"> 
											<span>
												<i class="icon-picture"></i>
												<?php echo Yii::t('app','Змінити фото'); ?>
											</span>
											<input type="hidden" name="MAX_FILE_SIZE" value="1000">
											<input type="hidden" name="Offer[offerImage]" value="">
											<input type="file" id="offer-offerimage" class="file-upload" name="Offer[offerImage]" accept="image/*">
										</a>
									</div>

									<?php

										echo "<pre>";
										print_r($offer->image);
										echo "</pre>";

									?>

                                   <?php if ($offer->image) : ?>
                                    <ul class="gallery-offer edit-photo-offer">
                                        <?php
                                            $images = json_decode($offer->image);
											echo "<pre>";
											print_r($images);
											echo "</pre>";
                                        ?>

                                        <?php foreach ($images as $image) : ?>
											<?php
											echo "<pre>";
											print_r($image);
											echo "</pre>";
                                        ?>
                                            <li><a data-fancybox="gallery" href="<?php echo $image; ?>"><img src="<?php echo $image; ?>" alt=""></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
                    </div>


            </div>



		 
        <?php
        ActiveForm::end();
        ?>
			<div class="empty-space col-xs-b20 col-sm-b20"></div>


    </div>

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