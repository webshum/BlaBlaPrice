<div class="float-container-bottom hidden-lg" >
    <div class="footer-main-link">
        <a href="/cabinet/order" class="link-footer">
            <i class="icon-login"></i>
            <span><?= Yii::t('app', 'Запити'); ?>
            <span><?php echo $this->context->count_orders ?></span>
        </a>

        <a href="/cabinet/offer" class=" link-footer">
            <i class="icon-logout"></i>
            <span><?= Yii::t('app', 'Пропозиції'); ?></span>
            <?php if ($this->context->send_offers > 0): ?>
                <span><?php echo $this->context->send_offers ?></span>
            <?php endif; ?>
        </a>

        <a href="/cabinet/accepted" class="link-footer">
            <i class="icon-users-outline"></i>
            <span><?= Yii::t('app', 'Контакти'); ?></span>
            <?php if ($this->context->accepted_offers > 0): ?>
                <span><?php echo $this->context->accepted_offers ?></span>
            <?php endif; ?>
        </a>

        <a href="/cabinet/comment" class="link-footer">
            <i class="icon-chat-alt"></i>
            <span><?= Yii::t('app', 'Відгуки'); ?></span>
            <?php if ($this->context->count_feedback > 0): ?>
                <span><?php echo $this->context->count_feedback ?></span>
            <?php endif; ?>
        </a>
    </div>
</div>
