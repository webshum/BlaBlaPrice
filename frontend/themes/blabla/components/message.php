<?php 
	$regionList = [];
	$regionList = array_merge($regionList, Yii::$app->params['region'][Yii::$app->language]);
?>

<div class="<?= (!empty($direction)) ? 'text-right' : '' ?>">
	<div class="message <?= (!empty($class)) ? $class : null; ?>">
		<div class="box">
			<?php if (!empty($avatar)) : ?>
				<div class="avatar">
					<?= mb_substr(strip_tags($avatar), 0, 1) ?>
				</div>
			<?php endif ?>

			<div class="inner">
				<?php if (!empty($nameReviews)) : ?>
					<div class="name-reviews">
						<strong><?= $nameReviews->user->userName ?></strong>

						<div class="positive-count">
							<?php if ($nameReviews->user->countPositive) : ?>
								<svg><use xlink:href="#positive"></use></svg>
							<?php else : ?>
								<svg><use xlink:href="#happy"></use></svg>
							<?php endif; ?>
							<span><?= $nameReviews->user->countPositive; ?></span>
						</div>

						<div class="neutral-count">
							<?php if ($nameReviews->user->countNeutral) : ?>
								<svg><use xlink:href="#neutral"></use></svg>
							<?php else : ?>
								<svg><use xlink:href="#happy"></use></svg>
							<?php endif; ?>
							<?= $nameReviews->user->countNeutral; ?>
						</div>

						<div class="negative-count">
							<?php if ($nameReviews->user->countNegative) : ?>
								<svg ><use xlink:href="#negative"></use></svg>
							<?php else : ?>
								<svg><use xlink:href="#happy"></use></svg>
							<?php endif; ?>
							<?= $nameReviews->user->countNegative; ?>
						</div>

						<?php 
							echo $this->render('@appTheme/components/reviews', [
								'reviews' => $nameReviews->user,
							]); 
						?>
					</div>
				<?php endif; ?>

				<?php if (!empty($class)) : ?>
					<div class="emoticon">
						<?php if ($class == 'positive') : ?>
							<svg><use xlink:href="#positive"></use></svg>
						<?php elseif ($class == 'neutral') : ?>
							<svg><use xlink:href="#neutral"></use></svg>
						<?php else : ?>
							<svg><use xlink:href="#negative"></use></svg>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<?php if (!empty($title)) : ?>
					<div class="title"><?= $title ?></div>
				<?php endif ?>

				<?php if (!empty($budget)) : ?>
					<div class="budget">
						<strong><?= Yii::t('app', 'Ціна -') ?></strong> 
						<?= $budget . ' ' . Yii::t('app', 'грн') ?>
					</div>
				<?php endif ?>

				<?php if (!empty($rating)) : ?>
	                <div class="rating"><?= $rating ?></div>
	            <?php endif; ?>

				<?php if (!empty($comment)) : ?>
	                <div class="comment">
	                	<?= $comment; ?>
	                </div>
	            <?php endif; ?>

	            <?php if (!empty($deadline)) : ?>
		            <div class="deadline">
		                <div style="display: none" id="datepicker">
		                	<?= strtotime($deadline) * 1000 ?>
		                </div>

		                <div class="time-entry" data-rel="17">
						<?= Yii::t('app', 'Залишилось -'); ?>
		                    <span class="days"></span><?= Yii::t('app', 'днів'); ?>
		                </div>
					</div>
				<?php endif; ?>

				<?php if (!empty($regionList[$region])) : ?>
					<div class="region">
						<?= Yii::t('app', 'Регіон - '); ?>

		                <?= $regionList[$region] ?>
					</div>
				<?php endif; ?>

				<div class="contacts">
					<?php if (!empty($name)) : ?>
						<div class="name"><?= $name ?></div>
					<?php endif ?>

					<?php if (!empty($phone)) : ?>
						<div class="phone"><?= $phone ?></div>
					<?php endif ?>

					<?php if (!empty($email)) : ?>
						<div class="email"><?= $email ?></div>
					<?php endif ?>
				</div>
						
				<?php 
				$imagesDecoded = json_decode($images);
				if (!empty($imagesDecoded) && is_array($imagesDecoded)) : ?>
					<div class="list-files-uploaded">
						<div class="wrap">
							<ul class="gallery-offer">
								<?php foreach ($imagesDecoded as $image) : ?>
									<li>
										<a data-fancybox="gallery" href="<?= htmlspecialchars($image, ENT_QUOTES); ?>">
											<img src="<?= htmlspecialchars($image, ENT_QUOTES); ?>" alt="">
										</a>
									</li>
								<?php endforeach; ?>
							</ul>
						</div>
					</div>
				<?php endif; ?>

				<?php if (!empty($button)) : ?>
					<?= $button ?>
				<?php endif ?>

				<?php if (!empty($edit)) : ?>
					<a href="#" class="js-edit-comment"><?= Yii::t('app', 'редагувати'); ?></a>
				<?php endif ?>

				<?php if (!empty($date)) : ?>
	                <div class="date"><?= $date ?></div>
	            <?php endif; ?>
			</div>
		</div>
		<?php if (!empty($menu) && $menu) : ?>
        	<div class="drop-menu active">
        		<a href="#">
        			<span><?= Yii::t('app', 'Ваші дії'); ?></span>	 <svg><use xlink:href="#dot"></use></svg>
        		</a>

        		<ul class="drop">
        			<li>
        				<a href="#" data-tab="tab-answer" class="js-answer" style="color:#2da066">
        					<svg><use xlink:href="#offers"></use></svg>
        					<?= Yii::t('app', 'Відповісти'); ?>	
        				</a>
        			</li>
        			<li>
        				<a href="#" data-tab="tab-spam" class="js-spam" style="color:#d62a2b">
        					<svg><use xlink:href="#delete"></use></svg>
        					<?= Yii::t('app', 'Видалити'); ?>	
        				</a>
        			</li>
        		</ul>
        	</div>
        <?php endif; ?>
	</div>
</div>

<script type="text/javascript">
	if (document.getElementById('comment-comment') != null) {
		document.getElementById('comment-comment').addEventListener('focus', e => {
		    document.querySelector('.radio-comment').checked = true;
		});
	}
</script>