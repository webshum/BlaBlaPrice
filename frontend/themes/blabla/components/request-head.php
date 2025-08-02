<div class="request-head">
    <div>
    	<h2 class="title"><?= $title; ?></h2>

		<div class="from">
            <?= $from; ?>
        </div>
    </div>

    <?php if ($button === true) : ?>
        <div class="controls">
            <button>
                <svg width="24" height="24"><use xlink:href="#open"></use></svg>
            </button>
        </div>
    <?php elseif ($button === false) : ?>
        <a class="close-popup-all">
            <svg width="12" height="12"><use xlink:href="#close-layer"></use></svg>
        </a>
    <?php elseif ($button === 'order') : ?>
        <a href="#" class="menu-button">
            <?= Yii::t('app', 'Змінити'); ?>
            <svg width="11" height="7"><use xlink:href="#arrow"></use></svg>
        </a>
    <?php endif; ?>
</div>