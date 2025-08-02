<?php 

$title = Yii::t('app', 'Сервіс BlaBlaPrice.com');
$description = Yii::t('app', 'Опис сервісу BlaBlaPrice.com');

?>

<div class="wrap share-chat">
    <p><?= Yii::t('app', 'Пошир blablaprice'); ?></p>
    <div>
        <!-- Facebook -->
        <a href="javascript:void(0)" 
           onclick="window.open('http://www.facebook.com/sharer.php?u=<?= urlencode(Yii::getAlias('@frontend_url')) ?>', 'facebook', 'width=555,height=640,toolbar=0,status=0'); return false;" 
           class="share-button facebook" 
           target="_blank" 
           title="<?php echo $title ?>">
            <span>facebook</span>
        </a>

        <!-- WhatsApp -->
        <a href="https://api.whatsapp.com/send?text=<?php echo $description ?>" 
           class="share-button whatsapp" 
           target="_blank" 
           title="<?php echo $title; ?>">
            <span>whatsapp</span>
        </a>

        <!-- Telegram -->
        <a href="https://t.me/share/url?url=<?= urlencode(Yii::getAlias('@frontend_url')) ?>&text=<?php echo $description ?>" 
           onclick="javascript:window.open(this.href, 'telegram', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" 
           class="share-button telegram" 
           target="_blank" 
           title="<?php echo $title; ?>">
            <span>telegram</span>
        </a>

        <!-- Twitter -->
        <a href="https://twitter.com/share?url=<?= urlencode(Yii::getAlias('@frontend_url')) ?>&text=<?php echo $description ?>" 
           onclick="javascript:window.open(this.href, 'twitter', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" 
           class="share-button twitter" 
           target="_blank" 
           title="<?php echo $title; ?>">
            <span>twitter</span>
        </a>
    </div>
</div>