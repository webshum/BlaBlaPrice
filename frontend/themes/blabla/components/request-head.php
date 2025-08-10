<div class="request-head">
    <div>
        <?php if (!empty($title)) : ?>
        	<h2 class="title"><?= $title; ?></h2>
        <?php endif; ?>

        <?php if (!empty($from)) : ?>
    		<div class="from">
                <?= $from; ?>
            </div>
        <?php endif; ?>
    </div>

    <?php if (empty($button)) : ?>
        <a class="close-popup-all">
            <svg width="12" height="12"><use xlink:href="#close-layer"></use></svg>
        </a>
    <?php endif; ?>

    <?php if (!empty($button)) : ?>
        <?php if ($button === true) : ?>
            <div class="controls">
                <button>
                    <svg width="24" height="24"><use xlink:href="#open"></use></svg>
                </button>
            </div>
        <?php elseif ($button === 'order') : ?>
            <a href="#" class="menu-button">
                <?= Yii::t('app', 'Змінити'); ?>
                <svg width="11" height="7"><use xlink:href="#arrow"></use></svg>
            </a>
        <?php endif; ?>
    <?php endif; ?>
</div>