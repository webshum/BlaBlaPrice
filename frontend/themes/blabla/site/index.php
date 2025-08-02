<?php

use yii\helpers\Html;
use yii\web\Session;
use common\models\Category;
$session = Yii::$app->session;
use yii\web\Cookie;

$cookies = \Yii::$app->getRequest()->getCookies();

/* @var $this yii\web\View */

$this->title = 'BlaBlaPrice.com';
?>

<div class="center page-filter">
	<div class="request-head">
		<?= $this->render('@appTheme/layouts/header'); ?>
	</div>
	
	<div class="blabla-comment  dark first" style="margin-top:20vh;">
    	<div class="text">
    		<p><?= Yii::t('app', 'Привіт! Тут знайдеш хорошу ціну на товар чи послугу') ?></p>
		</div>
    </div>

    <div class="blabla-comment  dark not-first last">
    	<div class="text">
    		<p> <?= Yii::t('app', 'Спробуй, це зручно і безкоштовно.') ?> </p>
			<a class="menu-button green" style="margin-top:20px">
				<?= Yii::t('app', 'Почати пошук ціни'); ?>
				<svg width="16" height="16"><use xlink:href="#search"></use></svg>
            </a>
    	</div>
    </div>
	
	<div class="blabla-comment  dark not-first last">
		<div class="text">
			<?= Yii::t('app', 'Оберіть країну'); ?>		

			<ul class="text-right sub-filter">
			<?php foreach (Yii::$app->params['lang'] as $code => $lang) : ?>
				<li>
					<a href="/?lang=<?php echo $code; ?>" <?= (Yii::$app->language == $code) ? 'class="active"' : ''; ?>>
						<?= Yii::t('app', $lang); ?>
					</a>
				</li>
			<?php endforeach; ?>
			</ul>
		</div>
	</div>

	<!-- ASIDE RIGHT -->
	<div class="wrap-aside h-991">
		<?= $this->render('@appTheme/layouts/aside-right'); ?>
	</div>
	<!-- // ASIDE RIGHT -->
</div>

<div class="popup-wrapper <?php if ($cookies->has('register_social')) {echo $cookies->getValue('register_social');} ?>">
    <div class="close-layer"></div>

    <?= $this->render('@app/themes/blabla/popup/popup-account-login') ?>
    <?= $this->render('@app/themes/blabla/popup/popup-account-registration') ?>
    <?= $this->render('@app/themes/blabla/popup/popup-account-reset-password') ?>
    <?= $this->render('@app/themes/blabla/popup/language'); ?>
</div>

<?= $this->render('footer'); ?>