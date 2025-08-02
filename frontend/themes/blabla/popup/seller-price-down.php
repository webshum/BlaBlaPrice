<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

/**
 * @var \yii\web\View $this
 * @var \common\models\Offer $offer
 */

?>

<div class="popup-container wide" >
    <div class="popup-header popup-paddings-wide">
        <?php
        if ($offer->order->product) {
            echo $offer->order->product->name;
        } else {
            echo $offer->order->category->name;
        }
        ?>
        <a class="button style-10 size-3 shadow close-popup-all"><span><i class="icon-cancel-2 "></i></span></a>
    </div>
    <div class="popup-paddings-wide">
	<div class="empty-space col-xs-b70 col-sm-b70"></div>
        <?php
        $form = ActiveForm::begin([
            'action' => ['cabinet/offer'],
            'fieldConfig' => ['template' => "{input}", 'options' => ['tag' => false]]
        ]);
        echo $form->field($offer, 'userID')->hiddenInput(['value' => Yii::$app->user->id])->label(false);
        echo $form->field($offer, 'ID')->hiddenInput(['value' => $offer->ID])->label(false);
        echo $form->field($offer, 'orderID')->hiddenInput(['value' => $offer->order->ID])->label(false);
        ?>
        <div class="empty-space col-xs-b25 col-sm-b50"></div>

        <div class="simple-article large dark inline-align-middle"><b><?php echo Yii::t('app', 'Ваша ціна:'); ?></b>
        </div>

        <?php echo $form->field($offer, 'price')->textInput([
            'class' => 'simple-input size-2 inline-align-middle',
            'placeholder' => Yii::t('app', 'Введіть ціну'),
            'style' => 'width: 165px;'
        ])->label(false) ?>

        <div class="empty-space col-xs-b20"></div>

        <?php echo $form->field($offer, 'comment')->textarea([
            'class' => 'simple-input size-3',
            'placeholder' => Yii::t('app', 'Ваш коментар')
        ])->label(false) ?>

        <div class="empty-space col-xs-b30"></div>

        <div class="row">
            <div class="col-sm-8 col-xs-b10 col-sm-b0">
                <div class="inline-align-middle col-xs-b10">
                    <a class="button style-2 size-2" href="#">
                        <span><?php echo Yii::t('app', 'Додати фото'); ?></span>
                        <?php
                        echo $form->field($offer, 'offerImage')->fileInput([
                            'class' => 'file-upload',
                            'accept' => '.jpg'
                        ])->label(false);
                        ?>
                    </a>
                </div>

                <div class="inline-align-middle col-xs-b10">
                    <a class="file-name-block"><span id="file-name"></span><span target="#offer-offerimage"
                                                                                 holder="#file-name"
                                                                                 class="remove-upload"></span></a>
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
                <!--                <div class="inline-align-middle col-xs-b10">
                                    <a class="product-thumnail"><img src="/img/thumbnail-3.jpg" alt=""><span class="remove-upload"></span></a>
                                </div>
                                <div class="inline-align-middle col-xs-b10">
                                    <a class="product-thumnail"><img src="/img/thumbnail-3.jpg" alt=""><span class="remove-upload"></span></a>
                                </div>
                                <div class="inline-align-middle col-xs-b10">
                                    <a class="product-thumnail"><img src="/img/thumbnail-3.jpg" alt=""><span class="remove-upload"></span></a>
                                </div>
                                <div class="inline-align-middle col-xs-b10">
                                    <a class="product-thumnail"><img src="/img/thumbnail-3.jpg" alt=""><span class="remove-upload"></span></a>
                                </div>-->
            </div>
            <div class="col-sm-4 text-right">
                <a class="button style-1 size-1 shadow submit-form" href="#"><span><?php echo Yii::t('app',
                            'НАДІСЛАТИ'); ?></span></a>
            </div>
        </div>
        <?php
        ActiveForm::end();
        ?>
        <div class="empty-space col-xs-b25 col-sm-b50"></div>
    </div>
</div>