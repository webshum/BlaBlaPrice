<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\AppAsset;

use frontend\models\SignupForm;


/**
 * @var \yii\web\View $this
 * @var \common\models\User $user
 * @var integer $count_order
 */

// generate regions
$regionList = [];
$regionList[0] = Yii::t('app', '--- Не вказано ---');
$regionList = array_merge($regionList, Yii::$app->params['region']);
?>

    <div id="content-block">

        <?= $this->render('user-sidebar', ['active' => 'settings']) ?>

        <div class="sidebar-content">

            <div class="float-container ">
                <div class="container">
				 <div class="empty-space col-xs-b60 col-sm-b60"></div>
						<div class="blabla-comment">
							<div class="user-photo-left icon-logo">
								<img src="/img/icon-logo.png" alt="">
							</div>
							<?php echo Yii::t('app','Для доступу до всіх функцій сервісу необхідно заповнити профіль користувача та підтвердити контактну інформацію'); ?>


						</div>
                    <div class="empty-space col-xs-b30 col-lg-b30"></div>





                       <div class="inner-block-2">
					   <div class="empty-space col-xs-b10 col-lg-b10"></div>
                        <div class="row m10">

                            <div class="row m5 ">
                             <div class="empty-space col-xs-b15 col-lg-b15"></div>
                                <div class="simple-article large dark col-xs-b5">
                                    <h3><?= Yii::t('app', 'Особисті дані'); ?></h3>
									 <div class="empty-space col-xs-b5 col-lg-b5"></div>
									 <div class="text-how-it-works"><?= Yii::t('app', 'Ім’я та регіон доступні всім зареєстрованим користувачам сервісу'); ?></div>
                                </div>
                                <div class="empty-space col-xs-b30 col-lg-b30"></div>

                            </div>

                            <?php $form = ActiveForm::begin([
                                'action' => Url::toRoute('cabinet/settings-update'),
                                'id' => 'settings-update'
                            ]) ?>

                            <div class="row m10 ">
							   <div class="cust-tooltip ">
                                    <?= $form->field($user, 'username')->textInput([
                                        'id' => 'user-name',
                                        'class' => 'simple-input size-5',
                                        'placeholder' => Yii::t('app', 'Ваше ім’я')
                                    ])->label(false) ?>
									<div class="tooltip-content left-password" ">
                                                 <?= Yii::t('app', 'Твоє ім’я на сайті'); ?>

                                    </div>
								 <div class="up-label"><?= Yii::t('app', 'Ваше ім’я'); ?> </div>
                               </div>
							</div>
                            <div class="empty-space col-xs-b20 col-lg-b20"></div>
                            <div class="row m10 ">
						   	  <div class="cust-tooltip ">
							    <div class="select-wrapper size-5">

                                        <?= $form->field($user, 'region_id')->dropDownList($regionList, [
                                            'class' => 'SlectBox',
                                            'id' => 'user-region-id'
                                        ])->label(false) ?>
										<div class="tooltip-content left-password" ">
                                                 <?= Yii::t('app', 'Вкажи свій регіон, і сервіс буде надсилати запити лише продавцям, що працюють з даною локацією '); ?>

                                    </div>
									<div class="up-label"><?= Yii::t('app', 'Ваш регіон'); ?> </div>
                                </div>
                              </div>
							</div>



                            <div class="row m10 text-right">

                                    <a class="button style-1 size-2 shadow submit-form">
                                        <span><?= Yii::t('app', 'ЗБЕРЕГТИ') ?></span>
                                    </a>
							

                            </div>
							<div class="empty-space col-xs-b10 col-lg-b10"></div>

                            <?php ActiveForm::end() ?>
                        </div>
					   </div>

					     <div class="empty-space col-xs-b10 col-lg-b10"></div>

					    <div class="inner-block-2">

                         <div class="row m10 ">
                            <div class="row m5  ">

                                <div class="simple-article large dark col-xs-b5">
								 <div class="empty-space col-xs-b15 col-lg-b15"></div>
                                    <h3><?= Yii::t('app', 'Контактна інформація'); ?></h3>
									 <div class="empty-space col-xs-b5 col-lg-b5"></div>
									 <div class="text-how-it-works"><?= Yii::t('app', 'Контактні дані доступні лише обраним тобою продавцям '); ?></div>
                                    <div class="empty-space col-xs-b30 col-lg-b30"></div>
                                </div>
                            </div>



<?php


?>
                <div class="row m10 col-xs-b30">





					 <div class="col-sm-9 col-xs-b20 col-sm-b0">

                           <?php $form = ActiveForm::begin([
                                    'action' => Url::toRoute('cabinet/settings-update-phone'),
                                    'id' => 'settings-update'
                                ]) ?>

                           <?php
                                        $StyleLinkTooltip='display:none';
                                        $TextInButton=$user->getPhone();
                                        $TextStyleButton='text-green-2';
                                        if ($user->getPhoneApproved() == '0000-00-00 00:00:00') {
											$tooltip = Yii::t('app', ' Ти ще не підтвердив свій телефон, тому не зможеш надсилати запити');
                                            $confirmation = Yii::t('app', 'Не підтверджено');
                                            $TextStyleButton='text-grey';
                                            $glyphicon = 'info-circled-alt';
											$TextInButton = Yii::t('app', 'Додайте ваш номер');
											$StyleLinkTooltip='color: #0098d0;';
                                        } elseif ($user->getPhoneApproved() != '0000-00-00 00:00:00') {
                                            $confirmation = Yii::t('app', 'Номер телефону підтверджено');
											$tooltip = Yii::t('app', ' Все гаразд. Телефон підтверджений, тепер ти зможеш надсилати запити');
                                            $glyphicon = 'ok';
                                        }

                                    ?>
									<div class="cust-tooltip ">
                                        <a class="button style-20 size-7 js-add-cookie-phone open-static-popup"  data-rel="registration-user-phone">
                                          <span><?= $TextInButton ?></span>
                                        </a>
										<div class="tooltip-content left-cabinet" >
                                                 <?= $tooltip ?>
                                                 <a class="open-static-popup js-add-cookie-phone"  style="<?= $StyleLinkTooltip ?>" data-rel="registration-user-phone">
                                                 <span> <?= Yii::t('app', ' Підтвердити телефон '); ?></span>
                                                 </a>
                                        </div>
										<div class="up-label <?=  $TextStyleButton ?>"> <i class="icon-<?= $glyphicon ?> "> </i><?= $confirmation ?></div>
						            </div>
					</div>
					 <?php ActiveForm::end() ?>
                 </div>
				 <div class="empty-space col-xs-b10 col-lg-b10"></div>
                 <div class="row m10 col-xs-b30">

					<div class="col-sm-9 col-xs-b20 col-sm-b0">
					  <?php $form = ActiveForm::begin([
                                    'action' => Url::toRoute('cabinet/settings-update-email'),
                                    'id' => 'settings-update'
                                ]) ?>

                                     <?php
                                         $StyleLinkTooltip='display:none';

                                        if ( $user->getEmailApproved() == '0000-00-00 00:00:00' ) {
                                            $confirmation = Yii::t('app', 'Твій e-mail не підтверджено');
											$tooltip = Yii::t('app', ' На твій e-mail надісланий лист з посиланням для підтведження реєстрації. У разі відсутності листа - перевір папку "Спам".');
                                            $glyphicon = 'info-circled-alt';
											$TextStyleButton='text-grey';
											$StyleLinkTooltip='color: #0098d0;';


                                        } elseif ($user->getEmailApproved() != '0000-00-00 00:00:00') {
                                            $confirmation = Yii::t('app', 'E-mail підтверджено');
											$tooltip = Yii::t('app', ' Все гаразд , твій e-mail підтверджено');
                                            $glyphicon = 'ok';
											$TextStyleButton='text-green-2';
                                        }

                                    ?>
									 <div class="cust-tooltip ">
                                      <a class="button style-20 size-7  open-static-popup"  data-rel="email-address">
                                        <span><?= $user->getEmail() ?></span>
                                    </a>






                                                <div class="tooltip-content left-cabinet" ">
                                                 <?= $tooltip ?>
                                                 <a class=" open-static-popup"  style="<?= $StyleLinkTooltip ?>" data-rel="email-address">
                                                 <span> <?= Yii::t('app', ' Надіслати ще раз '); ?></span>
                                    </a>
                                                </div>
									<div class="up-label <?=  $TextStyleButton ?>"> <i class="icon-<?= $glyphicon ?> "> </i><?= $confirmation ?></div>
                                     </div>
                       <?php ActiveForm::end() ?>
                     </div>

                 </div>
                </div>
               </div>





                         <div class="empty-space col-xs-b10 col-lg-b10"></div>
                       <div class="inner-block-2">
                         <div class="row m10">

                            <?= Html::beginForm(['cabinet/change-password']); ?>

                            <div class="row m5">
                         <div class="empty-space col-xs-b15 col-lg-b15"></div>
                                <div class="simple-article large dark col-xs-b5">
                                    <h3><?= Yii::t('app', 'Зміна паролю') ?></h3>
									  <div class="empty-space col-xs-b5 col-lg-b5"></div>
									 <div class="text-how-it-works"><?= Yii::t('app', 'Зміна паролю для входу в особистий кабінет '); ?></div>

                                    <div class="empty-space col-xs-b30 col-lg-b30"></div>
                                </div>
                            </div>

                            <div class="row m10  ">



                                    <div class="col-sm-4 col-xs-b20">
								    <div class="cust-tooltip ">
                                    <?= Html::input('password', 'old-password', null, [
                                        'class' => 'simple-input size-5',
                                        'id' => 'old-password',
                                        'placeholder' => Yii::t('app', 'Введіть пароль')
                                    ]) ?>
									<div class="tooltip-content left-password" ">
                                                 <?= Yii::t('app', ' Для відновлення паролю натисни '); ?>
                                      <a class=" open-static-popup"  style="color: #8abce2;" data-rel="account-reset-password">
                                                 <span> <?= Yii::t('app', ' Надіслати пароль'); ?></span>
                                      </a>
                                    </div>
									 <div class="up-label"><?= Yii::t('app', 'Ваш пароль'); ?> </div>
                                </div>
                                    </div>

							</div>
                             <div class="empty-space col-xs-b10 col-lg-b10"></div>
                            <div class="row m10 ">


							   <div class="col-sm-4 col-xs-b20">
							    <div class="cust-tooltip ">
                                    <?= Html::input('password', 'new-password', null, [
                                        'minlength' => '6',
                                        'class' => 'simple-input size-5',
                                        'id' => 'new-password',
                                        'placeholder' => Yii::t('app', 'Новий пароль')
                                    ]) ?>
									 <div class="tooltip-content left-password" ">
                                                 <?= Yii::t('app', ' Придумайте новий пароль '); ?>

                                    </div>
									 <div class="up-label"><?= Yii::t('app', 'Новий пароль'); ?> </div>
                                </div>
                                </div>

                            </div>
							<div class="empty-space col-xs-b10 col-lg-b10"></div>

                            <div class="row m10  ">


							   <div class="col-sm-6 col-xs-b20">
							    <div class="cust-tooltip ">
                                    <?= Html::input('password', 'confirm-password', null, [
                                        'class' => 'simple-input size-5',
                                        'id' => 'confirm-password',
                                        'placeholder' => Yii::t('app', 'Повторіть новий пароль')
                                    ]) ?>
									<div class="tooltip-content left-password" ">
                                                 <?= Yii::t('app', ' Напишіть новий пароль ще раз'); ?>

                                    </div>
									 <div class="up-label"><?= Yii::t('app', 'Повторіть новий пароль'); ?> </div>
                                </div>
                                </div>

                            </div>


                                <div class="row m10 text-right">
                                    <a class="button style-1 size-2 shadow submit-form" href="#">
                                        <span><?= Yii::t('app', 'ЗБЕРЕГТИ'); ?></span>
                                    </a>
                                </div>
								 <div class="empty-space col-xs-b10 col-lg-b10"></div>

                            <?php echo Html::endForm(); ?>
                        </div>
					  </div>
					     <div class="empty-space col-xs-b40 col-lg-b40"></div>

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
            <div class="footer-main-link" style="left:12%;">

               <a href="/cabinet/order" class="link-footer"><i class="icon-logout"></i><span><?= Yii::t('app', 'Запити'); ?></a>
               <a href="/cabinet/accepted" class="link-footer "><i class="icon-users-outline"></i><span><?= Yii::t('app', 'Контакти'); ?></span></a>
               <a href="/cabinet/comment" class="link-footer "><i class="icon-chat-alt"></i><span><?= Yii::t('app', 'Відгуки'); ?></span></a>




        </div>
        </div>
			<div class="float-container-min ">
				<div class="container-min page-flash-messages">
					<div class="h3-float-container">
					   <?= Yii::t('app', 'Особисті дані'); ?>
					</div>
				</div>



			</div>


            <div class="clear"></div>
        </div>
    </div>

    <div class="popup-wrapper">
        <div class="close-layer"></div>
        <?= $this->render('@app/themes/blablaprice/popup/popup-email-verification') ?>
        <?= $this->render('@app/themes/blablaprice/popup/popup-phone-verification') ?>
        <?= $this->render('@app/themes/blablaprice/popup/language'); ?>
        <?= $this->render('@app/themes/blablaprice/popup/popup-account-reset-password'); ?>

		  <!-- <div class="popup-content" data-rel="account-reset-password"></div> -->

    </div>

    <script type="text/javascript">
        $('#settings-update').on('beforeSubmit', function () {
            $.ajax({
                url: '/cabinet/settings-update',
                type: 'post',
                data: $(this).closest('form').serialize(),
                dataType: 'json'
            }).done(function (data) {
                $('.page-flash-messages').html('');
                if (data.result == true) {
                    var flashSuccess = '<div class="alert alert-info">';
                    flashSuccess += '<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close"></a>';
                    flashSuccess += '<strong><?= Yii::t('app', 'Дані користувача успішно змінено!') ?></strong> ';
                    flashSuccess += '</div>';
                    $('.page-flash-messages').append(flashSuccess);
                } else if (data.result == false) {
                    $.each(data.errors, function () {
                        $.each(this, function (key, value) {
                            var flashError = '<div class="alert alert-danger">';
                            flashError += '<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close"></a>';
                            flashError += '<strong><?= Yii::t('app', 'Помилка!') ?></strong> ' + value;
                            flashError += '</div>';
                            $('.page-flash-messages').append(flashError);
                        });
                    });
                }
            });
            return false;
        });
    </script>

<?= $this->render('/site/footer') ?>
