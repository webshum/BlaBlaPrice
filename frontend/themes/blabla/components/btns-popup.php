<a href="#" class="menu-button js-close-popup">
	<?= Yii::t('app', 'Назад'); ?>
    <svg width="11" height="7"><use xlink:href="#soc"></use></svg>
</a>
<div class="menu-button js-social">
	<div>
		<?= Yii::t('app', 'Розказати друзям'); ?>
		<svg width="11" height="7"><use xlink:href="#soc"></use></svg>
	</div>
	
    <?= $this->render('@appTheme/components/social'); ?>
</div>