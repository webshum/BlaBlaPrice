<?php

use yii\helpers\Html;
use common\models\User;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use frontend\models\SignupForm;
use frontend\models\Category;

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
 * @var \common\models\Offer $offer_item
 */
?>

<div class="popup-container wide">
  <div class="popup-paddings-wide ">

    <?php if ($order->product) : ?>



			<div class="popup-product-name">
				<?php echo $order->product->name ?>
			</div>
			<span class="popup-user-name">
				<?php echo Yii::t('app', 'Надіслано '); ?>
				<?php echo $order->getActiveSellers() + $free_user . ' '. Yii::t('app', 'компаніям'); ?>
			</span>

			<a class="button style-10 size-3 close-popup"><span><i class="icon-cancel-2 blue-icon"></i></span></a>
			<div class="empty-space col-xs-b15 col-sm-b15"></div>


		 <div class="text-right">
		 <div class="right-cloud">
			<div class="simple-article extralarge ">
				<b>
					<?php echo Yii::t('app', 'Бюджет'); ?>
					<?php echo $order->priceFrom ?>
                    <?php echo Yii::t('app', 'грн'); ?>
				</b>
			</div>


            <div class="h6 grey "><?= Yii::t('app', 'Куплю'); ?> <?php echo $order->product->name ?>.<br>
				 <?php echo strip_tags($order->comment) ?><br>

			</div>



            <div class="row">
             <div class="col-md-12">
                    <div style="display: none" id="datepicker"><?php echo strtotime($order->deadLine) * 1000; ?></div>



                    <div class="text-blue-icon ">

                    <div class="cust-tooltip ">

			          <div class="time-entry inline-align-middle" data-rel="17">
                        <div class="inline-align-middle"><i class="icon-hourglass "></i> <span class="days">0</span><?php echo Yii::t('app', ' днів '); ?></div>


                     </div>


				    <div class="tooltip-content left-info-popup " >
                         <?php echo Yii::t('app', 'Вказаний клієнтом час актуальності запиту'); ?>
                    </div>
				   </div>

					</div>


				<div class="text-blue-icon inline ">
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


    <?php else : ?>

			<div class="popup-product-name">
				<?php echo $order->category->name ?>
			</div>
			<span class="popup-user-name">
				<?php echo Yii::t('app', 'Надіслано '); ?>
				 <?php echo $order->getActiveSellers() + $free_user . ' '. Yii::t('app', 'компаніям'); ?>
			</span>
			<a class="button style-10 size-3  close-popup"><span><i class="icon-cancel-2 blue-icon"></i></span></a>
			<div class="empty-space col-xs-b15 col-sm-b15"></div>
			<div class="text-right">
			<div class="right-cloud">

				<div class="simple-article extralarge ">
				  <b>
					<?php echo Yii::t('app', 'Бюджет'); ?>
					<?php echo $order->priceFrom ?>
                    <?php echo Yii::t('app', 'грн'); ?>
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
                ?><br>
				 <?php echo strip_tags($order->comment) ?>
				<br>

			</div>











           <div class="row">
             <div class="col-md-12">
                    <div style="display: none" id="datepicker"><?php echo strtotime($order->deadLine) * 1000; ?></div>



                    <div class="text-blue-icon ">

                    <div class="cust-tooltip ">

			          <div class="time-entry inline-align-middle" data-rel="17">
                        <div class="inline-align-middle"><i class="icon-hourglass "></i> <span class="days">0</span><?php echo Yii::t('app', ' днів '); ?></div>


                     </div>


				    <div class="tooltip-content left-info-popup " >
                         <?php echo Yii::t('app', 'Вказаний клієнтом час актуальності запиту'); ?>
                    </div>
				   </div>

					</div>
				<div class="text-blue-icon inline ">
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

<span class="popup-delete-order">
				<?= Html::a( Yii::t('app', 'Видалити'), Url::to(['cabinet/order-disable', 'id' => $order->getID()]) ) ?>
			</span>
            </div>
		</div>
		</div>




    <?php endif; ?>




   <?php $k=count($order->offers); if ($k>0) : ?>
		<div class="blabla-comment">
			<div class="user-photo-left icon-logo">
				<img src="/img/icon-logo.png" alt="">
			</div>
			<b>
				<?php echo Yii::t('app', 'Ти отримав'); ?>
                <?php echo count($order->offers) ?>
                <?php echo Yii::t('app', 'пропозицій'); ?>
				</b>
		</div>
		<div class="empty-space col-xs-b5 col-sm-b5"></div>
	<?php else :  ?>
	<div class="blabla-comment">
			<div class="user-photo-left icon-logo">
				<img src="/img/icon-logo.png" alt="">
			</div>

				<b>
					<?php echo Yii::t('app', 'Чекай на пропозиції'); ?>
				</b>


	</div>
	<?php endif; ?>







        <?php  if ($order->offers) : ?>
			<?php foreach ($order->offers as $offer_item) : ?>
				<div class="left-cloud ">
					<div class="left-cloud-data"> <?= $offer_item->getUpdatedAt() ?></div>
					<div class="user-photo-left">
						<div class="first-letter">
							<?php  $string = mb_substr(strip_tags($offer_item->user->username ), 0, 1);echo $string   ; ?>
						</div>
					</div>
					<div class="h6 grey inline">
						<div class="cust-tooltip " style="cursor:pointer">
			              <a class="seller open-popup" data-param="<?php echo $offer_item->ID ?>" data-rel="user-offer"><?= $offer_item->user->username ?>
							<span class="positive-count">
								<i class="icon-thumbs-up "></i><?php echo $offer_item->user->countPositive; ?>
							</span>
							<span class="negative-count">
								<i class="icon-frown"></i><?php echo $offer_item->user->countNegative; ?>
							</span>
							<div class="tooltip-content left-user-popup" >
								<b><?= Yii::t('app', 'Відгуків :'); ?> </b><br>
								<b><?php echo $offer_item->user->countPositive; ?> </b> <?= Yii::t('app', '    позитивних '); ?>   <br>
								<b><?php echo $offer_item->user->countNeutral; ?> </b> <?= Yii::t('app', '    нейтральних '); ?>    <br>
								<b><?php echo $offer_item->user->countNegative; ?> </b><?= Yii::t('app', '    негативних '); ?>    <br>

							</div>
						  </a>
					  </div>
					</div>
					<div class="empty-space col-xs-b5 col-sm-b5"></div>
					<div class="h6 grey ">

							<b>
							    <?= Yii::t('app', 'Ціна') ;?>
								<?php echo $offer_item->price ?>
								<?php echo Yii::t('app',' грн'); ?>
							</b>
							<?php if ($offer_item->oldPrice != null) : ?>
								<div class="cust-tooltip " >
									<span class="popups-yellow  simple-article small">
										   <?= Yii::t('app', 'стара ціна ') ;?>
									 	   <?php echo $offer_item->oldPrice ?>
										   <?= Yii::t('app',' грн') ; ?>
									</span>
									<i class="icon-help-circled-alt "></i>
									<div class="tooltip-content  left-best-price-cabinet " >
					                        <?= Yii::t('app', 'Найкраща запропонована ціна'); ?>
									</div>
								</div>

							<?php endif; ?>
					<div class="h6 grey ">
						<?php
							$string = mb_substr(strip_tags($offer_item->comment),0,300);
                            echo $string;
                        ?>
					</div>
					<ul class="gallery-offer">
                        <?php $images = json_decode($offer_item->image); ?>
						<?php foreach ($images as $image) : ?>
							<li>
								<a data-fancybox="gallery" href="<?php echo $image; ?>"><img src="<?php echo $image; ?>" alt=""></a>
							</li>
                        <?php endforeach; ?>
                    </ul>
					<div class="empty-space col-xs-b5 col-sm-b5"></div>

					<?php
            $category = Category::findOne(['ID' => $order->categoryID]);            
						echo Html::beginForm(['cabinet/accepted-offer']);
                        echo Html::hiddenInput('id', $offer_item->ID);
					?>

                    <input type="hidden" name="price_category" value="<?php echo $category->price; ?>">
                    <input type="hidden" name="user_id" value="<?php echo $offer_item->userID; ?>">

                    <a class="button style-1 size-1 shadow block submit-form">
						<i class="icon-address-card-o "></i>
                        <?php echo Yii::t('app', 'Обмінятись контактами'); ?>
                    </a>
                    <?php echo Html::endForm(); ?>



					</div>

                    </div>
                    <div class="empty-space col-xs-b20 col-sm-b20"></div>
                    <?php
                endforeach;
                ?>



            <?php
        endif;
        ?>





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
