<?php
use common\models\User;
?>

<section class="faq">
	<h3 class="title">
		<?= Yii::t('app', 'Популярні питання'); ?>
		
	</h3>

	<ul class="accordeon">
	
	<li class="item-accordeon active">
	        <div class="btn-accordeon">
	        	<span><?= Yii::t('app', 'Для чого Blablaprice.com корисний?'); ?></span>
	        	<svg width="11" height="7"><use xlink:href="#arrow"></use></svg>
	        </div>
	
	        <div class="content-accordeon">
	            <div class="inner-accordeon">
	            	<?= Yii::t('app', 'Blablaprice.com - це онлайн-платформа, яка дозволяє покупцям створювати запити на товари чи послуги, а продавцям пропонувати свої ціни.'); ?>
	            </div>
	        </div>
	    </li>
	
	<?php $currentPageUrl = $_SERVER['REQUEST_URI'];?>
    <?php if (Yii::$app->user->identity->role == User::ROLE_USER) : ?>
	
		<li class="item-accordeon">
	        <div class="btn-accordeon">
	        	<span><?= Yii::t('app', 'Це безкоштовно?'); ?></span>
	        	<svg width="11" height="7"><use xlink:href="#arrow"></use></svg>
	        </div>
	
	        <div class="content-accordeon">
	            <div class="inner-accordeon">
	            	<?= Yii::t('app', 'Так. Ти можеш безкоштовно надсилати запити і обмінюватись контактами з продавцями.'); ?>
	            </div>
	        </div>
	    </li>

	    
	
		<li class="item-accordeon">
			<div class="btn-accordeon">
				<span><?= Yii::t('app', 'Як я можу видалити свій відправлений запит?'); ?></span>
				<svg width="11" height="7"><use xlink:href="#arrow"></use></svg>
			</div>
			<div class="content-accordeon">
				<div class="inner-accordeon">
					<?= Yii::t('app', 'У меню запиту вибери пункт "Видалити чат"'); ?>
				</div>
			</div>
		</li>

	
		<li class="item-accordeon">
			<div class="btn-accordeon">
				<span><?= Yii::t('app', 'Чи можу я змінити свій запит після того, як відправив його?'); ?></span>
				<svg width="11" height="7"><use xlink:href="#arrow"></use></svg>
			</div>
			<div class="content-accordeon">
				<div class="inner-accordeon">
					<?= Yii::t('app', 'На жаль, після відправлення запиту змінити його неможливо. Проте, ти можеш видалити свій запит і створити новий з необхідними змінами.'); ?>
				</div>
			</div>
		</li>

		

	
		<li class="item-accordeon">
			<div class="btn-accordeon">
				<span><?= Yii::t('app', 'Чи можу я відповісти на пропозиції продавців?'); ?></span>
				<svg width="11" height="7"><use xlink:href="#arrow"></use></svg>
			</div>
			<div class="content-accordeon">
				<div class="inner-accordeon">
					<?= Yii::t('app', 'Ти можеш обмінятися контактною інформацією з продавцем, щоб продовжити спілкування поза сервісом.'); ?>
				</div>
			</div>
		</li>

		<li class="item-accordeon">
			<div class="btn-accordeon">
				<span><?= Yii::t('app', 'Як я можу переглянути рейтинг продавця?'); ?></span>
				<svg width="11" height="7"><use xlink:href="#arrow"></use></svg>
			</div>
			<div class="content-accordeon">
				<div class="inner-accordeon">
					<?= Yii::t('app', 'Щоб переглянути рейтинг продавця, натисни на його нікнейм. Відкриється вікно з відгуками та історією продаж продавця.'); ?>
				</div>
			</div>
		</li>

		
		<li class="item-accordeon">
			<div class="btn-accordeon">
				<span><?= Yii::t('app', 'Чи можу я відмовитися від пропозиції, якщо мені не підходять умови продавця?'); ?></span>
				<svg width="11" height="7"><use xlink:href="#arrow"></use></svg>
			</div>
			<div class="content-accordeon">
				<div class="inner-accordeon">
					<?= Yii::t('app', 'Так, якщо пропозиція продавця не влаштовує тебе, ти можеш відмовитися від неї. Після цього буде можливість відкрити контакти іншого продавця.'); ?>
				</div>
			</div>
		</li>

		
		<li class="item-accordeon">
			<div class="btn-accordeon">
				<span><?= Yii::t('app', 'Чи можна відкрити одночасно декілька контактів продавців?'); ?></span>
				<svg width="11" height="7"><use xlink:href="#arrow"></use></svg>
			</div>
			<div class="content-accordeon">
				<div class="inner-accordeon">
					<?= Yii::t('app', 'Спачатку відкрий контакти одного продавця. Після спроби контактувати з продавцем, якщо ви не домовилися, ти можеш відмовитися від його пропозиції і відкрити контакти іншого продавця.'); ?>
				</div>
			</div>
		</li>

		
		<li class="item-accordeon">
			<div class="btn-accordeon">
				<span><?= Yii::t('app', 'Чи можна відкрити контакти продавця, якщо я ще не готовий здійснити покупку?'); ?></span>
				<svg width="11" height="7"><use xlink:href="#arrow"></use></svg>
			</div>
			<div class="content-accordeon">
				<div class="inner-accordeon">
					<?= Yii::t('app', 'Так, ти можеш відкрити контакти з продавцем, навіть якщо ти ще не готовий здійснити покупку. Це дозволить тобі обговорити деталі замовлення та умови угоди безпосередньо з продавцем.'); ?>
				</div>
			</div>
		</li>
		
		<li class="item-accordeon">
			<div class="btn-accordeon">
				<span><?= Yii::t('app', 'Коли я можу залишити відгук про продавця??'); ?></span>
				<svg width="11" height="7"><use xlink:href="#arrow"></use></svg>
			</div>
			<div class="content-accordeon">
				<div class="inner-accordeon">
					<?= Yii::t('app', 'Якщо ти погодився на пропозицію продавця - можеш оцінити продавця і залишити відгук'); ?>
				</div>
			</div>
		</li>
		<li class="item-accordeon">
			<div class="btn-accordeon">
				<span><?= Yii::t('app', 'Чи можу я змінити свій відгук і оцінку?'); ?></span>
				<svg width="11" height="7"><use xlink:href="#arrow"></use></svg>
			</div>
			<div class="content-accordeon">
				<div class="inner-accordeon">
					<?= Yii::t('app', 'Так, вибери пункт меню "Змінити відгук"'); ?>
				</div>
			</div>
		</li>
 <?php endif; ?>
 
 <?php if (Yii::$app->user->identity->role == User::ROLE_SELLER) : ?>
 <li class="item-accordeon">
	        <div class="btn-accordeon">
	        	<span><?= Yii::t('app', 'Чи потрібно платити за реєстрацію на сервісі?'); ?></span>
	        	<svg width="11" height="7"><use xlink:href="#arrow"></use></svg>
	        </div>
	
	        <div class="content-accordeon">
	            <div class="inner-accordeon">
	            	<?= Yii::t('app', 'Ні, реєстрація на BlaBlaPrice.com абсолютно безкоштовна'); ?>
	            </div>
	        </div>
	    </li>

	    
	
		<li class="item-accordeon">
			<div class="btn-accordeon">
				<span><?= Yii::t('app', 'Які переваги мають продавці на BlaBlaPrice.com?'); ?></span>
				<svg width="11" height="7"><use xlink:href="#arrow"></use></svg>
			</div>
			<div class="content-accordeon">
				<div class="inner-accordeon">
					<?= Yii::t('app', 'Продавці можуть безкоштовно надсилати свої пропозиції клієнтам поки клієнт не обере одну з пропозицій.'); ?>
				</div>
			</div>
		</li>

	
		<li class="item-accordeon">
			<div class="btn-accordeon">
				<span><?= Yii::t('app', 'Чи обмежена кількість відповідей на запити клієнтів для продавців?'); ?></span>
				<svg width="11" height="7"><use xlink:href="#arrow"></use></svg>
			</div>
			<div class="content-accordeon">
				<div class="inner-accordeon">
					<?= Yii::t('app', 'Сервіс показує продавцям найкращу запропоновану ціну на запит. Продавці можуть змінювати свою пропозицію до моменту, поки клієнт не вибере пропозицію одного з продавців. Таким чином, ти можеш адаптувати свою пропозицію, щоб забезпечити найкращий варіант для клієнта.'); ?>
				</div>
			</div>
		</li>

		

	
		


		
		<li class="item-accordeon">
			<div class="btn-accordeon">
				<span><?= Yii::t('app', 'Що означає рейтинг біля імені покупця і продавця?'); ?></span>
				<svg width="11" height="7"><use xlink:href="#arrow"></use></svg>
			</div>
			<div class="content-accordeon">
				<div class="inner-accordeon">
					<?= Yii::t('app', 'Рейтинг, який відображається біля імені, відображає репутацію покупця чи продавця на BlaBlaPrice.com. Після здійснення покупки як покупець, так і продавець можуть обмінюватися відгуками про взаємодію, яка відбулась.'); ?>
				</div>
			</div>
		</li>

		
		<li class="item-accordeon">
			<div class="btn-accordeon">
				<span><?= Yii::t('app', 'Як я отримаю оплату за товари чи послуги?'); ?></span>
				<svg width="11" height="7"><use xlink:href="#arrow"></use></svg>
			</div>
			<div class="content-accordeon">
				<div class="inner-accordeon">
					<?= Yii::t('app', 'Покупець і продавець самі домовляються про зручні способи оплати. Blablaprice лише допомагає покупцям знайти продавців.'); ?>
				</div>
			</div>
		</li>
 <?php endif; ?>
	    
	</ul>	
</section>

