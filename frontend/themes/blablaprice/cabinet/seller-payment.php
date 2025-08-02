<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div id="content-block">
<?= $this->render('seller-sidebar', ['active' => 'payment']) ?>

<div class="sidebar-content">
    <div class="float-container">
	 <div class="empty-space col-xs-b70 col-sm-b40"></div>
        <div class="container">
		<div class="blabla-comment">
				<div class="user-photo-left icon-logo">
					
				</div>
				<?= Yii::t('app', 'Сервіс отримує комісію за обмін контактами з потенційним покупцем '); ?>
				
		</div>
		 <div class="empty-space col-xs-b5 col-lg-b5"></div>
		 <div class="blabla-comment">
				<div class="user-photo-left icon-logo">
					<img src="/img/icon-logo.png" alt="">
				</div>
				
					<?= Yii::t('app','Ваш баланс'); ?> <?php echo $user->bal . ' ' . Yii::t('app', 'балів'); ?>
					</br>
					<?= Yii::t('app','Курс: 1бал = 1$ '); ?>
				
				
		</div>
		 <div class="empty-space col-xs-b20 col-lg-b20"></div>


			<div class="inner-block-2">

			<div class="container">

				 <div class="empty-space col-xs-b5 col-lg-b5"></div>
                    <div class="row m5 ">
                        <div class="simple-article large dark col-xs-b5">
							<h3>           
								<?= Yii::t('app','Поповнити баланс'); ?>
							</h3>
				
									 <div class="empty-space col-xs-b5 col-lg-b5"></div>
									 <div class="text-how-it-works"></div>
                                </div>
                               
                    </div>
					 <div class="row m10  ">

                    <?php $form = ActiveForm::begin([
                        'action' => 'https://www.liqpay.ua/api/3/checkout',
                        'id' => 'form-payment',
                        'options' => [
                            'class' => 'validate-form'
                        ]
                    ]); ?>




							  <div class="payment-input">
							  <div class="cust-tooltip ">
                                <?= $form->field($user, 'balance')->textInput([
									'type' => 'number',
									'min' => '1',
                                    'id' => 'user-balance',
                                    'class' => 'simple-input size-5',
                                    'value' => '',
                                    'placeholder' => Yii::t('app', 'Введіть суму '),
                                    'required' => true,
                                ])->label(false) ?>
								
								<div class="tooltip-content left-password" ">
                                                 <?= Yii::t('app', 'Введіть суму в доларах США'); ?>

                                    </div>
									 <div class="up-label"><?= Yii::t('app', 'Сума поповнення'); ?> </div>
									 <span class=""><?= Yii::t('app', 'дол'); ?></span>



							</div>
							 </div>
							 <a class="button style-1 size-2 shadow submit-form">
                                    <span><?= Yii::t('app', 'Поповнити') ?></span>
                             </a>



                        </div>
						  <div class="empty-space col-xs-b10 col-lg-b10"></div>

                    <?php ActiveForm::end(); ?>



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

               <a href="/cabinet/order" class="link-footer"><i class="icon-login"></i><span> <?= Yii::t('app', 'Запити'); ?></a>
               <a href="/cabinet/offer" class="link-footer  "><i class="icon-logout"></i><span> <?= Yii::t('app', 'Пропозиції'); ?></span></a>
               <a href="/cabinet/accepted" class="link-footer "><i class="icon-users-outline"></i><span> <?= Yii::t('app', 'Контакти'); ?></span></a>
               <a href="/cabinet/comment" class="link-footer "><i class="icon-chat-alt"></i><span> <?= Yii::t('app', 'Відгуки'); ?></span></a>




        </div>
    </div>
	<div class="float-container-min seller">

                <div class="container-min" >
                   <div class="h3-float-container">
					    <?= Yii::t('app', '  Оплати '); ?>
				   </div>

                </div>



        </div>
</div>

<div class="popup-wrapper">
    <div class="close-layer"></div>
    <?= $this->render('@app/themes/blablaprice/popup/language'); ?>
</div>

<?= $this->render('/site/footer'); ?>
