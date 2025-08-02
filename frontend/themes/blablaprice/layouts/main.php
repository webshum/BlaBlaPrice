<?php

/* @var $this \yii\web\View */

/* @var $content string */

use frontend\assets\AppAsset;
use yii\helpers\Html;
use frontend\models\SignupForm;
use yii\widgets\ActiveForm;

$user = Yii::$app->user->identity;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
        <meta name="format-detection" content="telephone=no"/>
        <meta name="apple-mobile-web-app-capable" content="yes"/>
        <meta name="viewport"
              content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no, minimal-ui"/>

        <title><?= Html::encode($this->title) ?></title>

        <?= Html::csrfMetaTags() ?>

        <!-- head begin -->

        <?php $this->head(); ?>

        <!-- head end -->
    </head>
    <body>

    <?php $this->beginBody() ?>

    <?php
    //  echo $this->render('header');
    ?>

    <?php
    if (!Yii::$app->user->isGuest) {
        //if (Yii::$app->user->identity->role == User::ROLE_USER) {
        echo $this->render('header-user');
        //}
    } else {
        echo $this->render('header');
    }
    ?>

<?php $flash = Yii::$app->session->getAllFlashes(); ?>

<?php if (!empty($flash)) : ?>
    <div class="popup-wrapper active">
        <div class="close-layer"></div>
        <div class="popup-content active">
            <div class="popup-container">
                 <a class="button style-10 size-3  close-popup-all"><span><i class="icon-cancel-2 blue-icon"></i></span></a>
                <div class="popup-paddings text-center">
                    <div class="empty-space col-xs-b50"></div>
                    <div class="h3"><b><?php echo Yii::t('app', 'Повідомлення'); ?></b></div>
                    <div class="empty-space col-xs-b15"></div>
                    <div class="simple-article large">
                        <b>
                            <?php
                            $message = '';
                            foreach ($flash as $errorName => $errorMessage) {
                                if (is_array($errorMessage) && isset($errorMessage['0'])) {
                                    $message .= $errorMessage['0'] . PHP_EOL;
                                } else {
                                    $message .= $errorMessage . PHP_EOL;
                                }
                            }
                            echo $message;
                            ?>
                        </b>
                    </div>
                    <div class="empty-space col-xs-b30"></div>
                    <a class="button style-1 size-1 close-popup" href="#">
                        <span><?= Yii::t('app', 'Закрити'); ?></span>
                    </a>
                    <div class="empty-space col-xs-b60"></div>
                </div>
            </div>
        </div>
    </div>
    </div>
<?php endif; ?>

    <?= $content ?>


    <?php
    $this->registerJs("

$(function(){
  var lang =  $('#lang').text()

  switch(lang){
  case 'Україна':
    months = ['Січень','Лютий','Березень','Квітень','Травень','Червень','Липень','Серпень','Вересень','Жовтень','Листопад','Грудень'];
    days = ['Нед','Пон','Вів','Сер','Чет','Пят','Суб'];
    break;
  case 'Россия':
    months = ['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'];
    days = ['Вос','Пон','Вто','Сре','Чет','Пят','Суб'];
    break;
  case 'Polska':
    months = ['Styczeń','Luty','Marzec','Kwiecień','Maj','Czerwiec','Lipiec','Sierpień','Wrzesień','Październik','Listopad','Grudzień'];
    days = ['Nie','Pon','Wto','Śro','Czw','Pią','Sob'];
    break;
  default:
    months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
  }
  
    $.extend($.fn.pickadate.defaults, {
      monthsFull: months,
      weekdaysShort: days,
    });
    
    var date = new Date();
    var valueDate = date.getDate() + ' ' + months[date.getMonth()] + ', ' + date.getFullYear();
    $('#datepicker').val(valueDate);
    
    var datepickerInterval;
    $('#datepicker').pickadate({
        min: new Date(),
        firstDay: 1,
        formatSubmit: 'mm/dd/yyyy',

        onSet: function(thingSet) {
            clearInterval(datepickerInterval);
            setTimer($('.time-entry[data-rel=\"'+$('#datepicker').data('rel')+'\"]'), thingSet.select);
            datepickerInterval = setInterval(function(){setTimer($('.time-entry[data-rel=\"'+$('#datepicker').data('rel')+'\"]'), thingSet.select);}, 1000);
        }
    });


    function setTimer(wrapper, finalTime){
        var today = new Date().getTime();
        var interval = finalTime - today;
        if(interval<0) interval = 0;
        var days = parseInt(interval/(1000*60*60*24));
        var daysLeft = interval%(1000*60*60*24);
        var hours = parseInt(daysLeft/(1000*60*60));
        var hoursLeft = daysLeft%(1000*60*60);
        var minutes = parseInt(hoursLeft/(1000*60));
        var minutesLeft = hoursLeft%(1000*60);
        var seconds = parseInt(minutesLeft/(1000));
        wrapper.find('.days').text(days);
        wrapper.find('.hours').text(hours);
        wrapper.find('.minutes').text(minutes);
        wrapper.find('.seconds').text((seconds<10)?'0'+seconds:seconds);
    }
});

", \yii\web\View::POS_END);

    ?>

    <?php $this->endBody() ?>

    <script>
        window.onload = function() {
            var today = new Date();
            today.setDate(today.getDate()+10);
        }

        /*  PHONE MASK
        ---------------------------------------------- */
        if ($("input[name='SignupForm[phone]']").length) {
            var maskPhoneCountry = {
                'ua' : '+380',
                'pl' : '+48',
                'ru' : '+7'
            };

            var strCodePhone = maskPhoneCountry["<?php echo $_SESSION['language'] ?>"] + "-99-999-9999";

            $("input[name='SignupForm[phone]']").mask(strCodePhone);
            $("input[name='phone']").mask(strCodePhone);
        }
    </script>

    </body>
    </html>

<?php $this->endPage() ?>
