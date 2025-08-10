<?php
use common\models\User;
?>
<?php $currentPageUrl = $_SERVER['REQUEST_URI'];?>
<aside id="aside-right">
	<div class="wrap">
	<?php if (!Yii::$app->user) : ?>
		<div class="aside-dialog">
			<div class="item">
				<div class="image"><img src="/blabla/img/man-3.png" alt=""></div>
				<div>
					<h3 class="title"><?= Yii::t('app', 'Розкажіть що шукаєте') ?></h3>
					<p><?= Yii::t('app', 'Ми поширемо ваш запит серед продавців з потрібної категорії') ?></p>
				</div>
			</div>	

			<div class="item">
				<div class="image"><img src="/blabla/img/man-7.png" alt=""></div>
				<div>
					<h3 class="title"><?= Yii::t('app', 'Отримуйте пропозиції') ?></h3>
					<p><?= Yii::t('app', 'Обміняйтесь контактами з обраним продавцем') ?></p>
				</div>
			</div>	
		</div>
	<?php endif; ?>

		<!-- FAQ -->
		<?= $this->render('@appTheme/components/faq'); ?>
		<!-- // FAQ -->

		
			<div class="links">
				<a href="/site/contact"><?= Yii::t('app', 'Контакти'); ?></a>
				<a href="/site/termsofuse"><?= Yii::t('app', 'Умови'); ?></a>
				<a href="/site/privacypolicy"><?= Yii::t('app', 'Конфіденційність'); ?></a>	
				<a href="/site/pricing"><?= Yii::t('app', 'Ціни'); ?></a>
				<a href="/site/refund"><?= Yii::t('app', 'Повернення коштів'); ?></a>					
			</div>
		
	</div>	
</aside>