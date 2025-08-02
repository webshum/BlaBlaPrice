<?php
/**
 * @var \yii\web\View $this
 * @var \common\models\Order $order
 */
?>

<div class="popup-container wide">
    <?php
    $form = \yii\widgets\ActiveForm::begin();
    if ($order->product) :
        ?>
        <div class="popup-header popup-paddings-wide">
            <?php echo $order->product->name; ?>
            <a class="button style-10 size-3 shadow close-popup"><i class="icon-cancel-2 "></i></span></a>
        </div>
        <div class="popup-paddings-wide">
            <div class="empty-space col-xs-b25 col-sm-b50"></div>
            <div class="swiper-container popup-products-swiper" data-slides-per-view="auto">
                <div class="swiper-button-prev hidden"></div>
                <div class="swiper-button-next hidden"></div>

                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <a class="product-thumnail open-popup" data-param="<?php echo $order->productID; ?>"
                           data-type="product" data-rel="gallery"><img src="<?php echo $order->product->image; ?>"
                                                                       alt=""/></a>
                    </div>
                    <!--<div class="swiper-slide">
                        <a class="product-thumnail open-popup" data-rel="7"><img src="img/thumbnail-4.jpg" alt="" /></a>
                    </div>
                    <div class="swiper-slide">
                        <a class="product-thumnail open-popup" data-rel="7"><img src="img/thumbnail-5.jpg" alt="" /></a>
                    </div>
-->
                </div>
            </div>
            <div class="empty-space col-xs-b15 col-sm-b25"></div>
            <div class="simple-article large"><?php echo $order->product->description; ?></div>
            <div class="empty-space col-xs-b25 col-sm-b50"></div>
        </div>
        <div class="grey-line"></div>

        <div class="popup-paddings-wide grey">
            <div class="empty-space col-xs-b25 col-sm-b50"></div>
            <a class="button style-1 size-1 shadow submit-form" href="<?php echo \yii\helpers\Url::to([
                'cabinet/order-disable',
                'id' => $order->getID()
            ]) ?>"><span><?php echo Yii::t('app', 'ВИДАЛИТИ'); ?></span></a>
            <div class="empty-space col-xs-b25 col-sm-b50"></div>
        </div>
        <?php
    else :
        ?>
        <div class="popup-header popup-paddings-wide">
            <?php echo $order->category->name; ?>
            <a class="button style-10 size-3 shadow close-popup"><span><i class="icon-cancel-2 "></i></span></a>
        </div>
        <div class="popup-paddings-wide">
            <div class="empty-space col-xs-b25 col-sm-b50"></div>
            <div class="swiper-container popup-products-swiper" data-slides-per-view="auto">
                <div class="swiper-button-prev hidden"></div>
                <div class="swiper-button-next hidden"></div>

                <div class="swiper-wrapper">

                </div>
            </div>
            <div class="empty-space col-xs-b15 col-sm-b25"></div>
            <div class="simple-article large"><?php echo strip_tags($order->filter); ?></div>
            <div class="empty-space col-xs-b25 col-sm-b50"></div>
        </div>
        <div class="grey-line"></div>
        <div class="popup-paddings-wide grey">
            <div class="empty-space col-xs-b25 col-sm-b50"></div>
            <a class="button style-1 size-1 shadow submit-form" href="<?php echo \yii\helpers\Url::to([
                'cabinet/order-disable',
                'id' => $order->getID()
            ]) ?>"><span><?php echo Yii::t('app', 'ВИДАЛИТИ'); ?></span></a>
            <div class="empty-space col-xs-b25 col-sm-b50"></div>
        </div>

        <?php
    endif;
    ?>
    <div class="grey-line"></div>
    <div class="popup-paddings-wide">
        <div class="empty-space col-xs-b15 col-sm-b30"></div>
        <div class="row text-center">
            <div class="col-sm-6 col-xs-b15 col-sm-b0">
                <div class="simple-article grey"><?php echo Yii::t('app', 'Ви отримали'); ?>
                    <b><?php echo count($order->offers) ?> <?php echo Yii::t('app', 'пропозицій'); ?></div>
            </div>
            <div class="col-sm-6">
                <div class="simple-article grey"><?php echo Yii::t('app', 'Ваш запит отримало'); ?>
                    <b> <?php echo $order->getActiveSellers() + $free_user . ' ' . Yii::t('app',
                                'компаній із категорії') . ' "' . $order->category->name . '"'; ?></b></div>
            </div>
        </div>
        <div class="empty-space col-xs-b15 col-sm-b30"></div>
    </div>
    <div class="main-table-max-height">
        <?php
        if ($order->offers) :
            ?>
            <table class="main-table offers">
                <thead>
                <tr>
                    <th style="width: 100px;"><?php echo Yii::t('app', 'Дата'); ?></th>
                    <th><?php echo Yii::t('app', 'Продавець'); ?></th>
                    <th style="width: 100px;"><?php echo Yii::t('app', 'Рейтинг'); ?></th>
                    <th><?php echo Yii::t('app', 'Коментар'); ?></th>
                    <th style="width: 100px;"><?php echo Yii::t('app', 'Ціна'); ?></th>
                    <th style="width: 100px;"></th>
                </tr>
                </thead>
                <?php
                foreach ($order->offers as $offer_item) :
                    ?>
                    <tr>
                        <td data-name="<?php echo Yii::t('app',
                            'Дата:'); ?>&nbsp;"><?php echo $offer_item->updated ?></td>
                        <td data-name="<?php echo Yii::t('app', 'Продавець:'); ?>&nbsp;">
                            <div class="table-thumbnail-entry">
                                <a class="table-thumbnail size-2 open-popup" data-param="<?php echo $offer_item->ID ?>"
                                   data-rel="user-offer">
                                    <img src="<?php echo $offer_item->user->thumbUrl; ?>" alt=""/>
                                </a>
                                <div class="table-thumbnail-description">
                                    <div class="cell-view">
                                        <a class="open-popup" data-param="<?php echo $offer_item->ID ?>"
                                           data-rel="user-offer">
                                            <b><?php echo $offer_item->user->username ?></b>
                                        </a>
                                        <br/>
                                        <div class="simple-article extrasmall lightgrey"><?php echo $offer_item->user->address ?></div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td data-name="<?php echo Yii::t('app', 'Рейтинг:'); ?>&nbsp;">
                            <div class="table-rate table-green"><?php echo $offer_item->user->userRating; ?></div>
                            <a class="simple-article extrasmall lightgrey open-popup"
                               data-param="<?php echo $offer_item->ID ?>"
                               data-rel="user-offer"><?php echo $offer_item->user->countComment . ' ' . Yii::t('app',
                                        'відгуків'); ?></a>
                        </td>
                        <td data-name="<?php echo Yii::t('app', 'Коментар:'); ?>&nbsp;">
                            <div class="text-left"><?php echo strip_tags($offer_item->comment) ?></div>
                        </td>
                        <td data-name="<?php echo Yii::t('app', 'Ціна:'); ?>&nbsp;">
                            <div class="table-green"><b><?php echo $offer_item->price ?><?php echo Yii::t('app',
                                        'грн.'); ?></b></div>
                            <div class="simple-article extrasmall lightgrey"></div>
                        </td>
                        <td><a class="button style-1 size-2 shadow block open-popup"
                               data-param="<?php echo $offer_item->ID ?>"
                               data-rel="user-view-contact"><span><?php echo Yii::t('app',
                                        'Обрати продавця'); ?></span></a></td>
                    </tr>
                    <?php
                endforeach;
                ?>
            </table>
            <?php
        endif;
        ?>
        <a class="button style-9 size-2 shadow block visible-xs toggle-max-height"><span
                    class="max-height-text"><?= Yii::t('app', 'ПЕГЛЯНУТИ ВСІ +'); ?></span><span
                    class="max-height-text"><?= Yii::t('app', 'ПЕГЛЯНУТИ ВСІ -'); ?></span></a>
    </div>
    <?php
    \yii\widgets\ActiveForm::end();
    ?>
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