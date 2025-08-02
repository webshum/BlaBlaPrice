<!-- SIDEBAR MOBILE -->
<div class="float-container-bottom hidden-lg" >
    <div class="footer-main-link" style="left:12%;">
        <a href="/cabinet/order" class="link-footer">
            <i class="icon-logout"></i>
            <span><?= Yii::t('app', 'Запити'); ?>
            <?php if ($this->context->count_orders > 0): ?>
                <span><?= $this->context->count_orders ?></span>
            <?php endif; ?>
        </a>   

        <a href="/cabinet/accepted" class="link-footer">
            <i class="icon-users-outline"></i>
            <span><?= Yii::t('app', 'Контакти'); ?></span>
            <?php if ($this->context->accepted_offers > 0): ?>
                <span><?= $this->context->accepted_offers ?></span>
            <?php endif; ?>
        </a>
        
        <a href="/cabinet/comment" class="link-footer">
            <i class="icon-chat-alt"></i>
            <span><?= Yii::t('app', 'Відгуки'); ?></span>
            <?php if ($this->context->count_feedback > 0): ?>
                <span><?= $this->context->count_feedback ?></span>
            <?php endif; ?>
        </a>
    </div>
</div>
<!-- // SIDEBAR MOBILE -->