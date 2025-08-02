<div class="table-responsive-vertical pricing-plan">
    <table>
        <thead>
            <tr>
                <th><?= Yii::t('app', 'Міні'); ?></th>
                <th><?= Yii::t('app', 'Стандарт'); ?></th>
                <th><?= Yii::t('app', 'Максимум'); ?></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= $_ENV['POINT_MINI'] . " " . Yii::t('app', 'балів'); ?></td>
                <td><?= $_ENV['POINT_STANDART'] . " " . Yii::t('app', 'балів'); ?></td>
                <td><?= $_ENV['POINT_MAX'] . " " . Yii::t('app', 'балів'); ?></td>
            </tr>
            <tr>
                <td>$<?= $_ENV['PRICE_MINI'] ?></td>
                <td>$<?= $_ENV['PRICE_STANDART'] ?></td>
                <td>$<?= $_ENV['PRICE_MAX'] ?></td>
            </tr>
            <tr>
                <td>$1 <?= Yii::t('app', 'за бал'); ?></td>
                <td>$0.67 <?= Yii::t('app', 'за бал'); ?></td>
                <td>$0.60 <?= Yii::t('app', 'за бал'); ?></td>
            </tr>
            <tr>
                <td> 
					<a href="<?= $_ENV['PAYMENT_MINI'] ?>&user_id=<?= Yii::$app->user->identity->id ?>" class="cta-button">
                        <?= Yii::t('app', 'Купити'); ?>
					</a>
				</td>
                <td>
                    <a href="<?= $_ENV['PAYMENT_STANDART'] ?>&user_id=<?= Yii::$app->user->identity->id ?>" class="cta-button">
                        <?= Yii::t('app', 'Купити'); ?>
                    </a>
                </td>
                <td>
                    <a href="<?= $_ENV['PAYMENT_MAX'] ?>&user_id=<?= Yii::$app->user->identity->id ?>" class="cta-button">
                        <?= Yii::t('app', 'Купити'); ?>
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
</div>