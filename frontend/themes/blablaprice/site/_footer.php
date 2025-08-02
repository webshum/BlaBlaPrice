<?php

use yii\helpers\Html;
use yii\helpers\Url;
use common\models\User;

?>
<!-- FOOTER BEGIN -->
<!--<div style="position: absolute; left: -10000px; top: -10000px;">-->

<?php if (Yii::$app->user->identity->role == User::ROLE_USER) : ?>
<footer class="col-xs-text-center col-sm-text-left visible-lg <?= $Text?>">

      <div class="footer-content">
        <div class="empty-space col-xs-b10 col-sm-b10"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-9 ">

                    <div class="empty-space col-xs-b10"></div>
                    <div class="simple-article-2">
                       <?= Yii::t('app', 'Поширте BlaBlaPrice щоб отримувати більше пропозицій') ?>
                    </div>


                </div>
<div class="col-md-3 text-center"> <div class="social-entry">

                        <a href="#">
                            <img src="/img/icon-4.png" alt="">                        </a>
                        <a href="#">
                            <img src="/img/icon-5.png" alt="">                        </a>
                        <a href="#">
                            <img src="/img/icon-6.png" alt="">                        </a>
                        <a href="#">
                            <img src="/img/icon-7.png" alt="">                        </a>
                    </div></div>
            </div>
        </div>
        <div class="empty-space col-xs-b10 col-sm-b10"></div>
    </div>
</footer>

<?php elseif (Yii::$app->user->identity->role == User::ROLE_SELLER) : ?>
<footer class="col-xs-text-center col-sm-text-left visible-lg">

      <div class="footer-content">
        <div class="empty-space col-xs-b10 col-sm-b10"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-9 ">

                    <div class="empty-space col-xs-b10"></div>
                    <div class="simple-article-2">
                       <?= Yii::t('app', 'Поширте BlaBlaPrice щоб отримувати більше запитів') ?>
                    </div>


                </div>
<div class="col-md-3 text-center"> <div class="social-entry">

                        <a href="#">
                            <img src="/img/icon-4.png" alt="">                        </a>
                        <a href="#">
                            <img src="/img/icon-5.png" alt="">                        </a>
                        <a href="#">
                            <img src="/img/icon-6.png" alt="">                        </a>
                        <a href="#">
                            <img src="/img/icon-7.png" alt="">                        </a>
                    </div></div>
            </div>
        </div>
        <div class="empty-space col-xs-b10 col-sm-b10"></div>
    </div>
</footer>
<?php elseif (Yii::$app->user->identity->role <> User::ROLE_SELLER) : ?>
<footer class="col-xs-text-center col-sm-text-left ">

      <div class="footer-content">
        <div class="empty-space col-xs-b10 col-sm-b10"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-9 ">

                    <div class="empty-space col-xs-b10"></div>
                    <div class="simple-article-2">
                        <a class="footer-link" href="/site/howitworks">Як це працює?</a>
                        <a class="footer-link" href="#">Про компанію</a>
                        <a class="footer-link" href="#">Карта сайту</a>
                        <a class="footer-link" href="#">Угода</a>
                        <a class="footer-link" href="/site/contact">Контакти</a>
                    </div>


                </div>
<div class="col-md-3 text-center"> <div class="social-entry">

                        <a href="#">
                            <img src="/img/icon-4.png" alt="">                        </a>
                        <a href="#">
                            <img src="/img/icon-5.png" alt="">                        </a>
                        <a href="#">
                            <img src="/img/icon-6.png" alt="">                        </a>
                        <a href="#">
                            <img src="/img/icon-7.png" alt="">                        </a>
                    </div></div>
            </div>
        </div>
        <div class="empty-space col-xs-b10 col-sm-b10"></div>
    </div>
</footer>
 <?php endif;?>
<div id="responsive-point" class="hidden-lg"></div>
<!--</div>-->
<!-- FOTER END -->