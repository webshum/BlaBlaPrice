<?php
/**
 * @var \common\models\Product $product
 * @var \common\models\Order $order
 */
?>

<div id="content-block">
    <div class="sidebar-content-right-wrapper">
        <div class="sidebar-content">

            <div class="container">
                <div class="empty-space col-xs-b50 col-lg-b100"></div>
                <h2 class="h2"><b><?php echo $product->name ?></b></h2>
                <div class="empty-space col-xs-b25 col-sm-b50"></div>
                <div class="swiper-container popup-products-swiper" data-slides-per-view="auto">
                    <div class="swiper-button-prev hidden"></div>
                    <div class="swiper-button-next hidden"></div>

                    <div class="swiper-wrapper">

                        <div class="swiper-slide">
                            <a class="product-thumnail open-popup" data-rel="7"><img src="<?php echo $product->image ?>"
                                                                                     alt=""/></a>
                        </div>
                        <!--                        <div class="swiper-slide">
                                                    <a class="product-thumnail open-popup" data-rel="7"><img src="img/thumbnail-5.jpg" alt="" /></a>
                                                </div>
                                                <div class="swiper-slide">
                                                    <a class="product-thumnail open-popup" data-rel="7"><img src="img/thumbnail-4.jpg" alt="" /></a>
                                                </div>
                                                <div class="swiper-slide">
                                                    <a class="product-thumnail open-popup" data-rel="7"><img src="img/thumbnail-5.jpg" alt="" /></a>
                                                </div>
                                                <div class="swiper-slide">
                                                    <a class="product-thumnail open-popup" data-rel="7"><img src="img/thumbnail-4.jpg" alt="" /></a>
                                                </div>
                                                <div class="swiper-slide">
                                                    <a class="product-thumnail open-popup" data-rel="7"><img src="img/thumbnail-5.jpg" alt="" /></a>
                                                </div>
                                                <div class="swiper-slide">
                                                    <a class="product-thumnail open-popup" data-rel="7"><img src="img/thumbnail-4.jpg" alt="" /></a>
                                                </div>
                                                <div class="swiper-slide">
                                                    <a class="product-thumnail open-popup" data-rel="7"><img src="img/thumbnail-5.jpg" alt="" /></a>
                                                </div>
                                                <div class="swiper-slide">
                                                    <a class="product-thumnail open-popup" data-rel="7"><img src="img/thumbnail-4.jpg" alt="" /></a>
                                                </div>
                                                <div class="swiper-slide">
                                                    <a class="product-thumnail open-popup" data-rel="7"><img src="img/thumbnail-5.jpg" alt="" /></a>
                                                </div>-->

                    </div>
                </div>
                <div class="empty-space col-xs-b15 col-sm-b25"></div>
                <div class="simple-article large"><?php echo strip_tags($product->description) ?> </div>
                <div class="empty-space col-xs-b25 col-sm-b50"></div>
                <!--                <div class="tabs-block">
                                    <div class="popup-tabs clearfix tab-menu-wrapper">
                                        <div class="title visible-xs button style-3 size-2"><span>Основні характеристики</span></div>
                                        <div class="toggle">
                                            <div class="entry tab-menu active">Основні характеристики</div>
                                            <div class="entry tab-menu">Додаткові характеристики</div>
                                        </div>
                                    </div>
                                    <div class="empty-space col-xs-b20 col-sm-b0"></div>
                                    <div class="grey-line"></div>
                                    <div class="empty-space col-xs-b20 col-sm-b30"></div>
                                    <div class="tab-entry" style="display: block;">
                                        <div class="row">
                                            <div class="col-md-8">

                                                <table class="product-description">
                                                    <tr>
                                                        <td><span>Виробник</span></td>
                                                        <td><span>LG</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span>Дозвіл запису (кадрів / сек.)</span></td>
                                                        <td><span>2560x1280 (30 кадрів / сек)</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span>Режим фото</span></td>
                                                        <td><span>16 МП (5660x2830 точок)</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span>Мікрофон</span></td>
                                                        <td><span>+ (з підтримкою запису 5.1-канального звуку)</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span>Дисплей</span></td>
                                                        <td><span>Немає</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span>Об'єм вбудованої пам'яті</span></td>
                                                        <td><span>4 ГБ</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span>Підтримка карт пам'яті</span></td>
                                                        <td><span>MicroSD</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span>Водонепроникність</span></td>
                                                        <td><span>Немає</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span>Пилозахист</span></td>
                                                        <td><span>Немає</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span>Ударостійкість</span></td>
                                                        <td><span>Немає</span></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-entry">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <table class="product-description">
                                                    <tr>
                                                        <td><span>Дисплей</span></td>
                                                        <td><span>Немає</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span>Об'єм вбудованої пам'яті</span></td>
                                                        <td><span>4 ГБ</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span>Підтримка карт пам'яті</span></td>
                                                        <td><span>MicroSD</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span>Водонепроникність</span></td>
                                                        <td><span>Немає</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span>Пилозахист</span></td>
                                                        <td><span>Немає</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span>Ударостійкість</span></td>
                                                        <td><span>Немає</span></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->
                <?php
                if (Yii::$app->user->isGuest || Yii::$app->user->identity->role != \common\models\User::ROLE_SELLER) :
                    $form = \yii\widgets\ActiveForm::begin();
                    echo $form->field($order,
                        'categoryID')->hiddenInput(['value' => $product->categoryID])->label(false);
                    echo $form->field($order, 'productID')->hiddenInput(['value' => $product->ID])->label(false);
                    echo $form->field($order, 'userID')->hiddenInput(['value' => Yii::$app->user->id])->label(false);
                    echo $form->field($order,
                        'status')->hiddenInput(['value' => \common\models\Order::STATUS_ACTIVE])->label(false);
                    ?>
                    <div class="accordeon">
                        <div class="accordeon-entry">
                            <div class="accordeon-title active">
                                <?php echo Yii::t('app', '1. Вкажіть Ваш бюджет на даний товар'); ?>
                            </div>
                            <div class="accordeon-toggle" style="display: block;">
                                <div class="row">
                                    <div class="col-md-3 col-xs-b5 col-md-b0">
                                        <div class="simple-article large grey"><b><?php echo Yii::t('app',
                                                    'Вкажіть ціну товару'); ?></b></div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-sm-3 col-xs-b20 col-sm-b0">
                                                <?php
                                                $min = ($product->price - ($product->price * 0.3));
                                                echo $form->field($order, 'priceFrom')->textInput([
                                                    'type' => 'number',
                                                    'class' => 'simple-input size-2',
                                                    'min' => $min,
                                                    'placeholder' => Yii::t('app', 'Від')
                                                ])->label(false);
                                                ?>
                                                <!--<input type="text" class="simple-input size-2" value="" placeholder="Від" />-->
                                            </div>
                                            <!--                                        <div class="col-sm-3 col-xs-b20 col-sm-b0">
                                            <?php /*echo $form->field($order, 'priceTo')->textInput(['class' => 'simple-input size-2', 'placeholder' => Yii::t('app','До')])->label(false); */
                                            ?>
                                            <!--<input type="text" class="simple-input size-2" value="" placeholder="До" />-->
                                            <!--</div>-->
                                            <div class="col-sm-6">
                                                <div class="input-description"><?php echo Yii::t('app',
                                                        'Середня ціна: '); ?>
                                                    <b><?php echo $product->price . ' ' . Yii::t('app', 'грн'); ?>.</b>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="empty-space col-xs-b25 col-sm-b50"></div>
                                <a class="button style-2 size-1 block accordeon-next"
                                   href="#"><span><?php echo Yii::t('app', 'ПЕРЕЙТИ ДАЛІ'); ?></span></a>
                                <div class="empty-space col-xs-b25 col-sm-b50"></div>
                            </div>
                        </div>
                        <div class="accordeon-entry">
                            <div class="accordeon-title">
                                <?= Yii::t('app', '2. Вкажіть деталі'); ?>
                            </div>
                            <div class="accordeon-toggle">
                                <div class="inline-align-middle">
                                    <label class="checkbox-entry radio">
                                        <input type="radio" name="limit" value="1"><span><?php echo Yii::t('app',
                                                'З обмеженням'); ?></span>
                                    </label>
                                    <div class="empty-space col-xs-b15"></div>
                                </div>
                                <div class="inline-align-middle datepicker-wrapper">
                                    <?php
                                    echo $form->field($order, 'deadLine')
                                        ->textInput([
                                            'class' => 'simple-input size-3 datepicker',
                                            'id' => 'datepicker',
                                            'placeholder' => Yii::t('app', 'Оберіть дату'),
                                            'data-rel' => '1',
                                        ])
                                        ->label(false); ?>
                                    <div class="empty-space col-xs-b15"></div>
                                </div>
                                <div class="inline-align-middle">
                                    <div class="time-entry" data-rel="1">
                                        <div class="entry"><span class="days">0</span><?php echo Yii::t('app',
                                                'днів'); ?></div>
                                        <div class="entry"><span class="hours">0</span><?php echo Yii::t('app',
                                                'год'); ?></div>
                                        <div class="entry"><span class="minutes">0</span><?php echo Yii::t('app',
                                                'хв'); ?></div>
                                        <div class="entry"><span class="seconds">0</span><?php echo Yii::t('app',
                                                'с'); ?></div>
                                    </div>
                                    <div class="empty-space col-xs-b15"></div>
                                </div>
                                <div class="clear"></div>
                                <div class="inline-align-middle">
                                    <label class="checkbox-entry radio">
                                        <input type="radio" name="limit" value="0" checked>
                                        <span>
                                        <?= Yii::t('app', 'Без обмежень'); ?>
                                    </span>
                                    </label>
                                    <div class="empty-space col-xs-b15"></div>
                                </div>
                                <div class="empty-space col-xs-b25 col-sm-b50"></div>
                                <div class="row">
                                    <div class="col-md-3 col-xs-b5">
                                        <div class="simple-article large grey"><b><?php echo Yii::t('app',
                                                    'Вкажіть місце проживання або адресу доставки'); ?></b></div>
                                    </div>
                                    <div class="col-md-3 col-xs-b20">
                                        <div class="select-wrapper size-3">
                                            <?php echo $form->field($order,
                                                'regionID')->dropDownList(Yii::$app->params['region'],
                                                ['class' => 'SlectBox'])->label(false) ?>
                                            <!--                                        <select class="SlectBox">
                                                                                        <option disabled="disabled" selected="selected">Регіон</option>
                                                                                        <option value="volvo">Volvo</option>
                                                                                        <option value="saab">Saab</option>
                                                                                        <option value="mercedes">Mercedes</option>
                                                                                        <option value="audi">Audi</option>
                                                                                    </select>-->
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-xs-b20">
                                        <input type="text" class="simple-input size-3" value=""
                                               placeholder="<?php echo Yii::t('app', 'Місто'); ?>">
                                    </div>
                                    <div class="clear"></div>
                                    <div class="col-md-6 col-md-offset-3">
                                        <?php echo $form->field($order, 'comment')->textarea([
                                            'class' => 'simple-input size-3',
                                            'placeholder' => Yii::t('app', 'Коментар')
                                        ])->label(false); ?>
                                        <!--<textarea class="simple-input size-3" value="" placeholder="Коментар"></textarea>-->
                                    </div>
                                </div>
                                <div class="empty-space col-xs-b20 col-sm-b35"></div>
                                <a class="button style-2 size-1 block accordeon-next"
                                   href="#"><span><?php echo Yii::t('app', 'ПЕРЕЙТИ ДАЛІ'); ?></span></a>
                                <div class="empty-space col-xs-b25 col-sm-b50"></div>
                            </div>
                        </div>

                        <div class="accordeon-entry">
                            <div class="accordeon-title">
                                <?= Yii::t('app', '3. Вкажіть деталі'); ?>
                            </div>
                            <div class="accordeon-toggle">
                                <div class="simple-article large">
                                    <b><?php echo Yii::t('app',
                                            'Пропозиції компаній будуть відображенні в особистому кабінеті та надійдуть Вам на пошту'); ?></b>
                                </div>
                                <div class="empty-space col-xs-b20 col-sm-b40"></div>
                                <?php if (Yii::$app->user->isGuest) : ?>
                                    <div class="tabs-block">

                                        <div class="popup-tabs clearfix horizontal-in-responsive">
                                            <div class="entry tab-menu">
                                                <?= Yii::t('app', 'Авторизуйтесь на нашому сайті'); ?>
                                            </div>
                                            <div class="entry tab-menu active">
                                                <?= Yii::t('app', 'Зареєструватись на нашому сайті'); ?>
                                            </div>
                                        </div>
                                        <div class="empty-space col-xs-b20 col-sm-b0"></div>

                                        <div class="grey-line"></div>
                                        <div class="empty-space col-xs-b20 col-sm-b30"></div>
                                        <div class="tab-entry">
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <a class="button style-5 size-6 shadow block"
                                                       href="/site/auth?authclient=facebook"><span>Facebook</span></a>
                                                    <div class="empty-space col-xs-b20"></div>
                                                    <a class="button style-6 size-6 shadow block" href="#"><span>Vkontakte</span></a>
                                                    <div class="empty-space col-xs-b20"></div>
                                                    <a class="button style-7 size-6 shadow block"
                                                       href="#"><span>Google+</span></a>
                                                    <div class="empty-space col-xs-b50 col-sm-b0"></div>
                                                </div>
                                                <div class="col-sm-2 col-md-1">
                                                    <div class="empty-space col-sm-b95"></div>
                                                    <div class="popup-circle-title grey"><?php echo Yii::t('app',
                                                            'або'); ?></div>
                                                </div>
                                                <div class="col-sm-6 col-md-4">
                                                    <input type="text" class="simple-input size-2" value=""
                                                           placeholder="<?php echo Yii::t('app', 'Ваш email'); ?>"/>
                                                    <div class="empty-space col-xs-b20"></div>
                                                    <input type="text" class="simple-input size-2" value=""
                                                           placeholder="<?php echo Yii::t('app', 'Пароль'); ?>"/>
                                                    <div class="empty-space col-xs-b20"></div>
                                                    <a class="button style-1 size-1 shadow block"
                                                       href="#"><span><?php echo Yii::t('app', 'ВХІД'); ?></span></a>
                                                    <div class="empty-space col-xs-b10"></div>
                                                    <a class="simple-link open-popup"
                                                       data-rel="10"><?php echo Yii::t('app', 'Забули пароль?'); ?></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-entry" style="display: block;">
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <a class="button style-5 size-6 shadow block"
                                                       href="#">Facebook'</span></a>
                                                    <div class="empty-space col-xs-b20"></div>
                                                    <a class="button style-6 size-6 shadow block" href="#"><span>Vkontakte</span></a>
                                                    <div class="empty-space col-xs-b20"></div>
                                                    <a class="button style-7 size-6 shadow block"
                                                       href="#"><span>Google+</span></a>
                                                    <div class="empty-space col-xs-b50 col-sm-b0"></div>
                                                </div>
                                                <div class="col-sm-2 col-md-1">
                                                    <div class="empty-space col-sm-b95"></div>
                                                    <div class="popup-circle-title grey"><?php echo Yii::t('app',
                                                            'або'); ?></div>
                                                </div>
                                                <div class="col-sm-6 col-md-4">
                                                    <input type="text" class="simple-input size-2" value=""
                                                           placeholder="<?php echo Yii::t('app', 'Ваше ім\'я *'); ?>"/>
                                                    <div class="empty-space col-xs-b20"></div>
                                                    <input type="text" class="simple-input size-2" value=""
                                                           placeholder="<?php echo Yii::t('app',
                                                               'Ваш телефон *'); ?>"/>
                                                    <div class="empty-space col-xs-b20"></div>
                                                    <input type="text" class="simple-input size-2" value=""
                                                           placeholder="<?php echo Yii::t('app', 'Ваш email *'); ?>"/>
                                                    <div class="empty-space col-xs-b20"></div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="empty-space col-xs-b25 col-sm-b50"></div>
                                <a class="button style-2 size-1 block open-popup submit-form"
                                   data-rel="11"><span><?php echo Yii::t('app', 'ОФОРМИТИ ЗАЯВКУ'); ?></span></a>
                                <div class="empty-space col-xs-b25 col-sm-b50"></div>
                            </div>
                        </div>
                    </div>
                    <?php
                    \yii\widgets\ActiveForm::end();
                endif;
                ?>
                <div class="empty-space col-xs-b30 col-lg-b100"></div>
            </div>

        </div>

        <?php echo $this->render('right-sidebar'); ?>
    </div>
</div>

<div class="popup-wrapper">
    <div class="close-layer">

        <div class="popup-content" data-rel="11">
            <div class="popup-container text">
                <a class="button style-3 size-3 shadow close-popup" href="#">
                    <span>
                        <?= Html::img('/img/icon-1.png') ?>
                    </span>
                </a>
                <div class="popup-paddings">
                    <img class="text-popup-image hidden-xs" src="img/icon-65.png" alt=""/>
                    <div class="row">
                        <div class="col-sm-7 col-sm-offset-5">
                            <div class="empty-space col-xs-b40 col-sm-b80"></div>
                            <div class="h3"><b><?php echo Yii::t('app', 'Вашу заявку прийнято!'); ?></b></div>
                            <div class="empty-space col-xs-b20"></div>
                            <div class="simple-article large"><?php echo Yii::t('app',
                                    'Ваше оголошення додано у нашу базу і надіслано усіх продавцям. Найближчим часом Ви отримаєте пропозиції на пошту та в кабінеті'); ?></div>
                            <div class="empty-space col-xs-b20"></div>
                            <div class="button style-1 size-1 shadow"><span><?php echo Yii::t('app',
                                        'ПРОДОВЖИТИ ПОШУК'); ?></span><input type="submit"/></div>
                            <div class="empty-space col-xs-b40 col-sm-b80"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="popup-content" data-rel="7">
            <div class="popup-container middle">
                <a class="button style-3 size-3 shadow close-popup" href="#">
                    <span>
                        <?= Html::img('/img/icon-1.png') ?>
                    </span>
                </a>
                <div class="swiper-container popup-detail-swiper">
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>

                    <div class="swiper-wrapper">

                        <div class="swiper-slide">
                            <div data-background="img/thumbnail-10.jpg" class="swiper-lazy popup-detail-image">
                                <div class="swiper-lazy-preloader"></div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div data-background="img/thumbnail-11.jpg" class="swiper-lazy popup-detail-image">
                                <div class="swiper-lazy-preloader"></div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div data-background="img/thumbnail-12.jpg" class="swiper-lazy popup-detail-image">
                                <div class="swiper-lazy-preloader"></div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div data-background="img/thumbnail-13.jpg" class="swiper-lazy popup-detail-image">
                                <div class="swiper-lazy-preloader"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?= $this->render('footer') ?>
