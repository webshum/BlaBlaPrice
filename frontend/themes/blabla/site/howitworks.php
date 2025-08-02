<?php

use yii\helpers\Html;
use common\models\User;
use yii\helpers\Url;
use common\models\Order;
use yii\widgets\ActiveForm;

$this->title = 'How it works';
?>

<div class="center">
    <div class="request-head">
        <?= $this->render('@appTheme/layouts/header'); ?>
    </div>

    <div class="request-body page-works request-main">
        <h2 class="heading"><?= Yii::t('app', 'Хто продає'); ?></h2>

        <p><?= Yii::t('app', 'BlaBlaPrice працює у 6 країнах. Вже зареєстровано понад 200 тис продавців з 456 категорій товарів і послуг '); ?></p>

        <a href="#" class="menu-button"><?= Yii::t('app', '+ Стати продавцем в Україні'); ?></a>

        <h3 class="mt50"><?= Yii::t('app', 'BlaBlaPrice для покупців'); ?></h3>

        <div class="accordeon">
            <div class="accordeon-entry">
                <div class="accordeon-title active">
                    <strong><?= Yii::t('app', 'Це безкоштовно ?'); ?></strong>
                </div>
                <div class="accordeon-toggle" style="display: block;">
                    <?= Yii::t('app', 'Так. Ви можете безкоштовно надсилати запити і обмінюватись контактами з обраними продавцями. '); ?>
                </div>
            </div>
            <div class="accordeon-entry mt10">
                <div class="accordeon-title">
                    <strong><?= Yii::t('app', 'Хто бачить мої контакти?'); ?></strong>
                </div>
                <div class="accordeon-toggle">
                    <?= Yii::t('app', 'Ви самі обираєте з ким обмінятись контактами. '); ?>
                </div>
            </div>
            <div class="accordeon-entry mt10">
                <div class="accordeon-title">
                    <strong><?= Yii::t('app', 'Чи обовязково обирати продавця? '); ?></strong>
                </div>
                <div class="accordeon-toggle">
                    <?= Yii::t('app', 'Не обовязково. Якщо вам не підійшли умови ви можете проігноравати пропозиції , або обмінятись контактами і ще поторгуватись з обраним продавцем.'); ?>
                </div>
            </div>
            <div class="accordeon-entry mt10">
                <div class="accordeon-title">
                    <strong><?= Yii::t('app', 'Чому ціна у пропозиціях змінюється?'); ?></strong>
                </div>
                <div class="accordeon-toggle">
                    <?= Yii::t('app', 'Продавці можуть знижувати ціну, конкуруючи між собою..'); ?>
                </div>
            </div>
            <div class="accordeon-entry mt10">
                <div class="accordeon-title">
                    <strong><?= Yii::t('app', 'Чи можу я погодитись на дві пропозиції одночасно?'); ?></strong>   
                </div>
                <div class="accordeon-toggle">
                    <?= Yii::t('app', 'Після відмови від пропозиції запит знову стає актуальним для всіх зацікавлених продавців та появиться можливість вибору іншої пропозиції '); ?>
                </div>
            </div>
        </div>

        <h3 class="mt50"><?= Yii::t('app', 'BlaBlaPrice для продавців'); ?></h3>

        <div class="accordeon">
            <div class="accordeon-entry">
                <div class="accordeon-title active">
                    <strong><?= Yii::t('app', 'Що я зможу продавати на BlaBlaPrice ?'); ?></strong>
                </div>
                <div class="accordeon-toggle" style="display: block;">
                    <?= Yii::t('app', 'Ви можете пропонувати свої ціни на товари і послуги. Ознойомитись з категоріями товарів та послуг ви можете у кабінеті продавця http://blablaprice.com/cabinet/filter  '); ?>
                </div>
            </div>
            <div class="accordeon-entry mt10">
                <div class="accordeon-title">
                    <strong><?= Yii::t('app', 'Клієнтам з яких регіонів я можу надсилати свої пропозиції?'); ?></strong>
                </div>
                <div class="accordeon-toggle">
                    <?= Yii::t('app', 'Сервіс BlaBlaPrice працює в Україні, Польщі, Туреччині, Чехії та Росії. У Вас є можливість отримувати запити лише з вибраних регіонів налаштувавши відповідні фільтри.  '); ?>
                </div>
            </div>
            <div class="accordeon-entry mt10">
                <div class="accordeon-title">
                    <strong><?= Yii::t('app', 'Відправлення пропозиції безкоштовне ?'); ?></strong>        
                </div>
                <div class="accordeon-toggle">
                    <?= Yii::t('app', 'Так, надсилання пропозицій є безкоштовним. Сервіс BlaBlaPrice знімає комісіюлише за обмін контактами з потенційним покупцем. Ознайомитись з тарифами можна за посиланням '); ?>
                </div>
            </div>
            <div class="accordeon-entry mt10">
                <div class="accordeon-title">
                    <strong><?= Yii::t('app', 'Що робити якщо я отримав СПАМ'); ?></strong>
                </div>
                <div class="accordeon-toggle">
                    <?= Yii::t('app', 'Допоможіть виявляти недобросовісних покупців. Надсилайте скаргу на запити, що містять ознаку спаму. '); ?>
                </div>
            </div>
             <div class="accordeon-entry mt10">
                <div class="accordeon-title">
                    <strong><?= Yii::t('app', 'Як я можу торгуватись за клієнта?'); ?></strong>
                </div>
                <div class="accordeon-toggle">
                    <?= Yii::t('app', 'Продавцеві доступна інформація про найнижчу ціну по кожній з запропонованих Вами пропозицій. Це дає змогу здійснювати аукціонні торги, конкуруючи за кожне замовлення. '); ?>
                </div>
            </div>
             <div class="accordeon-entry mt10">
                <div class="accordeon-title">
                    <strong><?= Yii::t('app', 'Скільки часу я можу надсилати пропозиції на запит клієнта?'); ?></strong>
                </div>
                <div class="accordeon-toggle">
                    <?= Yii::t('app', 'Кожне замовлення має дед-лайн, встановлений покупцем. Впродовж цього у Вас буде можливість надсилати пропозиції. '); ?>
                </div>
            </div>
            <div class="accordeon-entry mt10">
                <div class="accordeon-title">
                    <strong><?= Yii::t('app', 'Чи може клієнт погодитись на дві пропозиції одночасно?'); ?></strong>
                </div>
                <div class="accordeon-toggle">
                    <?= Yii::t('app', 'Після відмови покупцем від пропозиції запит знову стає актуальним для всіх зацікавлених продавців та появиться можливість для повторного надсилання пропозицій.  '); ?>
                </div>
            </div>
            <div class="accordeon-entry mt10">
                <div class="accordeon-title">
                    <strong><?= Yii::t('app', 'Як залишити відгук про клієнта?'); ?></strong>
                </div>
                <div class="accordeon-toggle">
                    <?= Yii::t('app', 'Відгук є основним критерієм довіри та рейтингу продавця. Обов’язково обмінюйтесь відгуками після кожної завершеної операції купівлі-продажу.'); ?>
                </div>
            </div>
            <div class="accordeon-entry mt10">
                <div class="accordeon-title">
                    <strong><?= Yii::t('app', 'Що робити якщо клієнт залишив про мене негативний відгук. '); ?></strong>   
                </div>
                <div class="accordeon-toggle">
                    <?= Yii::t('app', 'На сервісі є можливість заміни відгуків. Узгоджуйте всі розбіжності з покупцем та покращіть свій рейтинг отримуючи лише позитивні відгуки.'); ?>
                </div>
            </div>
        </div>
    </div>
</div>  

<div class="popup-wrapper">
    <div class="close-layer"></div>

    <?= $this->render('@appTheme/popup/popup-account-login') ?>
    <?= $this->render('@appTheme/popup/popup-account-registration') ?>
    <?= $this->render('@appTheme/popup/popup-account-reset-password') ?>
	<?= $this->render('@appTheme/popup/language'); ?>
</div>