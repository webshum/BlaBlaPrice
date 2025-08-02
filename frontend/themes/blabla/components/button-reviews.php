<?php 

use common\models\Comment;

?>

<div class="button-reviews">
	<button value="<?= Comment::RATING_GOOD ?>" data-text="<?= Yii::t('app', 'Позитивний') ?>">
		<svg><use xlink:href="#positive"></use></svg>
	</button> 

	<button value="<?= Comment::RATING_NEUTRAL ?>" data-text="<?= Yii::t('app', 'Нейтральний') ?>">
		<svg><use xlink:href="#neutral"></use></svg>
	</button> 

	<button value="<?= Comment::RATING_BAD ?>" data-text="<?= Yii::t('app', 'Негатвний') ?>">
		<svg><use xlink:href="#negative"></use></svg>
	</button>
</div>

<script>
	const buttons = document.querySelectorAll('.button-reviews button');
	const form = buttons[0].closest('form');
	const text = form.querySelector('.input-reviews .text');
	const input = document.querySelector('input[name="Comment[rating]"]');

	buttons.forEach(button => {
		button.addEventListener('click', e => {
			e.preventDefault();

			const btn = e.target.closest('button');

			form.removeAttribute('class');

			if (btn.value == 2) {
				form.classList.add('position');
				input.value = 2;
			} else if (btn.value == 1) {
				form.classList.add('neutral');
				input.value = 1;
			} else {
				form.classList.add('negative');
				input.value = 0;
			}

			text.textContent = btn.dataset.text;
		});
	});
</script>