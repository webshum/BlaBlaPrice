<div class="reviews">
	<div>
		<?php if ($reviews->countPositive) : ?>
			<svg><use xlink:href="#positive"></use></svg>
		<?php else : ?>
			<svg><use xlink:href="#happy"></use></svg>
		<?php endif; ?>

		<strong><?= $reviews->countPositive; ?></strong> <?= Yii::t('app', 'позитивних'); ?>
	</div> 

	<div>
		<?php if ($reviews->countNeutral) : ?>
			<svg><use xlink:href="#neutral"></use></svg>
		<?php else : ?>
			<svg><use xlink:href="#happy"></use></svg>
		<?php endif; ?>

		<strong><?= $reviews->countNeutral; ?></strong> <?= Yii::t('app', 'нейтральних'); ?>
	</div> 

	<div>
		<?php if ($reviews->countNegative) : ?>
			<svg ><use xlink:href="#negative"></use></svg>
		<?php else : ?>
			<svg><use xlink:href="#happy"></use></svg>
		<?php endif; ?>

		<strong><?= $reviews->countNegative; ?></strong> <?= Yii::t('app', 'негативних'); ?>
	</div>
</div>