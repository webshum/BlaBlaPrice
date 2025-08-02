<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\User;
use frontend\models\Category;
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
    if ($order->product) :
        ?>



        <div class="popup-paddings-wide ">
		 <div class="popup-product-name">
		 <?php echo $order->product->name ?>
		 </div>
		  <span class="popup-user-name">
				<?php echo Yii::t('app', 'Запит від '); ?>
					<span class="cust-tooltip " >
						<span class="popup-user-name-first-letter"> <?php echo $order->user->userName; ?></span>
						<div class="tooltip-content left-user-popup" >
							<b><?= Yii::t('app', 'Телефон перевірено.'); ?> </b><br>
					        <b><?= Yii::t('app', 'Оцінки :'); ?> </b><br>
                            <b><?php echo $order->user->countPositive; ?> </b> <?= Yii::t('app', '    позитивних '); ?>   <br>
                            <b><?php echo $order->user->countNeutral; ?> </b> <?= Yii::t('app', '    нейтральних '); ?>    <br>
                            <b><?php echo $order->user->countNegative; ?> </b><?= Yii::t('app', '    негативних '); ?>    <br>

                        </div>
						<i class="icon-ok "></i>
					</span>
			</span>
        <a class="button style-10 size-3  close-popup"><span><i class="icon-cancel-2 blue-icon"></i></span></a>

             <div class="empty-space col-xs-b15 col-sm-b15"></div>
		 <div class="left-cloud">
		 <div class="user-photo-left">
				<div class="first-letter">
					<?php  $string = mb_substr(strip_tags($order->user->username ), 0, 1);echo $string   ; ?>
				</div>
			</div>









			 <div class="simple-article extralarge "><b>

                            <?php echo Yii::t('app', 'Бюджет'); ?> <?php echo $order->priceFrom ?> <?php echo Yii::t('app', 'грн'); ?>



                    </b></div>


            <div class="h6 grey "><?= Yii::t('app', 'Куплю'); ?> <?php echo $order->product->name ?>.<br>
				 <?php echo strip_tags($order->comment) ?><br>

			</div>


 <div class="row">
             <div class="col-md-12">
                    <div style="display: none" id="datepicker"><?php echo strtotime($order->deadLine) * 1000; ?></div>



                    <div class="text-grey-icon ">

                    <div class="cust-tooltip ">

			          <div class="time-entry inline-align-middle" data-rel="17">
                        <div class="inline-align-middle">
                                                       <span class="days2">
                                                         <?php
                                                           $now=new DateTime();
                                                           $date = DateTime::createFromFormat("Y-m-d H:i:s", $order->deadLine);
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
                                <?php echo $regionList[$order->regionID];  ?>
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
    else :
        ?>



        <div class="popup-paddings-wide  ">
		 <div class="popup-product-name">
			<?php echo $order->category->name.' ('.$order->category->price.'$)' ?>
		 </div>
			<span class="popup-user-name">
				<?php echo Yii::t('app', 'Запит від '); ?>
					<span class="cust-tooltip " >
						<span class="popup-user-name-first-letter"> <?php echo $order->user->userName; ?></span>
						<div class="tooltip-content left-user-popup" >
							<b><?= Yii::t('app', 'Телефон перевірено.'); ?> </b><br>
					        <b><?= Yii::t('app', 'Оцінки :'); ?> </b><br>
                            <b><?php echo $order->user->countPositive; ?> </b> <?= Yii::t('app', '    позитивних '); ?>   <br>
                            <b><?php echo $order->user->countNeutral; ?> </b> <?= Yii::t('app', '    нейтральних '); ?>    <br>
                            <b><?php echo $order->user->countNegative; ?> </b><?= Yii::t('app', '    негативних '); ?>    <br>

                        </div>
						<i class="icon-ok "></i>
					</span>
			</span>
        <a class="button style-10 size-3  close-popup"><span><i class="icon-cancel-2 blue-icon"></i></span></a>
		 <div class="empty-space col-xs-b15 col-sm-b15"></div>
		 <div class="left-cloud">
		  <div class="user-photo-left">
				<div class="first-letter">
					<?php  $string = mb_substr(strip_tags($order->user->username ), 0, 1);echo $string   ; ?>
				</div>
			</div>







			 <div class="simple-article extralarge  ">
			     <b><?php echo Yii::t('app', 'Бюджет'); ?> <?php echo $order->priceFrom ?> <?php echo Yii::t('app', 'грн'); ?>
				 </b>
			 </div>

            <div class="h6 grey "><?= Yii::t('app', 'Запропонуйте'); ?> <?php echo $order->category->name ?>  <br>
				<?php
                $string = '';
                $filter = explode('; ', $order->filter);
                foreach ($filter as $filter_item) {
                    $filter_value = explode(': ', $filter_item);
                    if ($filter_value[0] != '' && isset($filter_value[1])) {
                        $string .= '<b>' . $filter_value[0] . ':</b> ' . $filter_value[1] . '; <br>  ';
                    }
                }
                echo $string;
                ?>
				 <?php echo strip_tags($order->comment) ?>
				<br>

			</div>










           <div class="row">
             <div class="col-md-12">
                    <div style="display: none" id="datepicker"><?php echo strtotime($order->deadLine) * 1000; ?></div>



                    <div class="text-grey-icon ">

                    <div class="cust-tooltip ">

			          <div class="time-entry inline-align-middle" data-rel="17">
                        <div class="inline-align-middle">
                                                       <span class="days2">
                                                         <?php
                                                           $now=new DateTime();
                                                           $date = DateTime::createFromFormat("Y-m-d H:i:s", $order->deadLine);
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
                                <?php echo $regionList[$order->regionID];  ?>
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
  <?php if (($user->bal <= 0) || ($category->price > $user->bal)) : ?>
  <div class="popup-paddings-wide popups-grey">
		<div class="blabla-comment">
			<div class="user-photo-left icon-logo">
				<img src="/img/icon-logo.png" alt="">
			</div>
			<b><?php echo Yii::t('app', 'На вашому балансі недостатньо коштів'); ?></br>
			<?php echo Yii::t('app', 'Щоб мати можливість надсилати пропозиції - '); ?></b>
					   <a href="/cabinet/payment">
					     <span style="color:#5098d0;border-bottom: #5098d0 1px dotted;"><?php echo Yii::t('app', ' поповніть ваш баланс'); ?> </span>
                       </a>
		</div>
		 <div class="empty-space col-xs-b20 col-sm-b20"></div>
    </div>
   
   
<?php else : ?>

<?php if ($user->phone_approved  == '0000-00-00 00:00:00') : ?>
	<div class="popup-paddings-wide popups-grey">
		<div class="blabla-comment">
			<div class="user-photo-left icon-logo">
				<img src="/img/icon-logo.png" alt="">
			</div>
			<b><?php echo Yii::t('app', 'Ви ще не підтвердили свій телефон'); ?></b>
			<a href="/cabinet/settings">
					     <span style="color:#5098d0;border-bottom: #5098d0 1px dotted;"><?php echo Yii::t('app', ' Контактна інформація'); ?> </span>
            </a>
					   
		</div>
		 <div class="empty-space col-xs-b20 col-sm-b20"></div>
    </div>
  <?php endif; ?>

 <div class="tabs-block " >
        <div class="popup-paddings-wide  ">
            <div class="popup-tabs clearfix tab-menu-wrapper" >

                <div class="toggle">
                    <div class="entry tab-menu active"><i class="icon-article "></i><?php echo Yii::t('app', 'Відповісти'); ?></div>
                    <div class="entry tab-menu"><i class="icon-embassy "></i><?php echo Yii::t('app', 'Поскаржитись'); ?></div>
                </div>
            </div>
        </div>

        <div class="tab-entry" style="display: block;">
            <div class="popup-paddings-wide ">
                <?php
                $form = ActiveForm::begin([
                    'action' => ['cabinet/order'],
                    'options' => [
                        'class' => 'validate-form'
                    ],
                    'fieldConfig' => [
                        'template' => "{input}",
                        'options' => [
                            'enctype' => 'multipart/form-data',
                            'tag' => false,
                        ]
                    ],
                ]);

                echo $form->field($offer, 'orderUserEmail')->hiddenInput(['value' => $order->user->email])->label(false);
                echo $form->field($offer, 'userID')->hiddenInput(['value' => Yii::$app->user->id])->label(false);
                echo $form->field($offer, 'categoryID')->hiddenInput(['value' => $order->categoryID])->label(false);
                echo $form->field($offer, 'orderID')->hiddenInput(['value' => $order->ID])->label(false);
                ?>
                <div class="empty-space col-xs-b50 col-sm-b50"></div>
				<div class="row ">
				 <div class="col-sm-12">
				
				    <div class="cust-tooltip" style="display: inline-block;">
					    <?php echo $form->field($offer, 'price')->input('number', [
                        'class' => 'simple-input size-5 inline-align-middle',
                        'placeholder' => Yii::t('app', 'Введіть ціну'),
                        'style' => '',
                        'required' => true,])->label(false) ?>
                        <div class="up-label"><?= Yii::t('app', 'Ваша ціна'); ?> </div>
                        <div class="tooltip-content left-price-popup ">
                           <?php echo Yii::t('app', 'Запропонуйте  конкурентну ціну '); ?>
                        </div>
						
                   </div>
				   <span class="price-val"><?= Yii::t('app', 'грн'); ?></span>
				  
                        <?php $category = Category::findOne(['ID' => $order->categoryID]); ?>

                        <?php if ($user->phone_approved  == '0000-00-00 00:00:00') : ?>
						   <span class="cust-tooltip ">
						 <a class="button style-30 no-active "  ><span><?php echo Yii::t('app',
                                        'НАДІСЛАТИ '); ?></span></a>
						<div class="tooltip-content no-active-tooltip">
							<b><?php echo Yii::t('app', 'Потрібно підтвердити ваш номер телефону  '); ?> </b><br> 
							<a href="/cabinet/settings">
								<span style="color:#5098d0;border-bottom: #5098d0 1px dotted;"><?php echo Yii::t('app', ' Контактна інформація'); ?> </span>
							</a>
					       
                           
                        </div> 
						
					</span>
						
                           
                        <?php else : ?>
                           
                                
                                <a class="button style-30   submit-form" href="#">
                                  <span><?php echo Yii::t('app', 'НАДІСЛАТИ '); ?></span>
                                </a>
                            
                        <?php endif; ?>
				   </div>
				</div>
				<div class="empty-space col-xs-b10 col-sm-b10"></div>
				<div class="row ">
				  <div class="col-sm-12">

					<div class="cust-tooltip" >
					    <?php echo $form->field($offer, 'comment')->textarea([
                        'class' => 'simple-input size-3',
                        'placeholder' => Yii::t('app', 'Ваш коментар')])->label(false) ?>

                        <div class="tooltip-content left-price-popup ">
                           <?php echo Yii::t('app', 'Опишіть деталі пропозиції '); ?>
                        </div>
				    </div>
			      </div>




					 <div class="col-sm-12">
					  <div class="empty-space col-xs-b5 col-sm-b5"></div>
					  <div class="list-files-uploaded">
						  <a class="button style-21 " href="#"><span> <i class="icon-picture"></i><?php echo Yii::t('app',
                                        'Додати фото'); ?></span>

                                <?php if(!empty($offer->logo)){
                                    echo Html::img($offer->logo, $options = ['class' => 'postImg', 'style' => ['width' => '180px']]);
                                } ?>

                                                <input type="hidden" name="MAX_FILE_SIZE" value="1000">
                                <?php
                                echo $form->field($offer, 'offerImage')->fileInput([
                                    'class' => 'file-upload',
                                    // 'multiple' => true,
                                     'accept' => 'image/*'
                                ])->label(false);
                                ?>
                          </a>
                        </div>
                    </div>
                 </div>
                <?php
                ActiveForm::end();
                ?>
            </div>
        </div>

        <div class="tab-entry">
            <div class="popup-paddings-wide " >
                <div class="empty-space col-xs-b30 col-sm-b30"></div>
                <div class="simple-article large dark inline "><b>
					<?php echo Yii::t('app','Що не так?'); ?></b>
				</div>
				 <?php
                        $form = ActiveForm::begin([
                            'action' => ['cabinet/order'],
                            'fieldConfig' => ['template' => "{input}", 'options' => ['tag' => false]]
                        ]);
                        echo $form->field($comment,
                            'userFromID')->hiddenInput(['value' => Yii::$app->user->id])->label(false);
                        echo $form->field($comment, 'userToID')->hiddenInput(['value' => $order->userID])->label(false);
                        echo $form->field($comment, 'orderID')->hiddenInput(['value' => $order->ID])->label(false);
                        ?>
				<?php if ($user->phone_approved  == '0000-00-00 00:00:00') : ?>
						   <span class="cust-tooltip ">
						   <a class="button style-30   no-active" style="transform: translate(0, 17px);" >
                            <span>
                                <?php echo Yii::t('app', 'Поскаржитись'); ?>
                            </span>
                        </a>
						 
						<div class="tooltip-content no-active-tooltip">
							<b><?php echo Yii::t('app', 'Потрібно підтвердити ваш номер телефону  '); ?> </b><br> 
					       
                           
                        </div> 
						
					</span>
						
                           
                        <?php else : ?>
                           
                                
                                <a class="button style-30   submit-form" style="transform: translate(0, 17px);" href="#">
                            <span>
                                <?php echo Yii::t('app', 'Поскаржитись'); ?>
                            </span>
                        </a>
                            
                       
                        
						<?php endif; ?>
						
                        <div class="empty-space col-xs-b20 "></div>
                <div class="row">
                    <div class="col-md-12">

                       
                        <div class="row">
                            <?php
                            foreach (Yii::$app->params['refuse'] as $key => $refuse_item) :
                                ?>
                                <div class="col-sm-12 col-xs-b15">
                                    <label class="checkbox-entry radio">
                                        <?php
                                        echo \yii\helpers\Html::radio('Comment[refuseID]',
                                            $comment->refuseID == $key ? true : false, ['value' => $key]);
                                        ?>
                                        <span><?php echo $refuse_item ?></span>
                                    </label>
                                </div>
                                <?php
                            endforeach;
                            ?>
                        </div>
                        <div class="row">

                            <div class="col-sm-12 ">
                                <label class="checkbox-entry display-block radio">
                                    <?php
                                    echo \yii\helpers\Html::radio('Comment[refuseID]', false, ['value' => 0]);
                                    ?>
                                    <span>
                                        <?php
                                        echo $form->field($comment, 'comment')
                                            ->textarea([
                                                'class' => 'simple-input size-3',
                                                'onfocus' => 'jQuery("input[type=radio][value=0]").attr("checked", true)',
                                                'placeholder' => Yii::t('app', 'Інше')
                                            ])
                                            ->label(false);
                                        ?>
                                    </span>
                                </label>
                            </div>

                        </div>

                        </div>



                        <?php ActiveForm::end(); ?>
						 
                    </div>
					
                    <div class="empty-space col-xs-b20 col-sm-b20"></div>
                </div>

            </div>
        </div>

    
<?php endif; ?>
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
		if (days == 0) days = '1<';
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
