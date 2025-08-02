<?php 

use yii\helpers\Html;

?>

<div class="popup-content"  data-rel="language">
    <div class="popup-container">
         <a class="button style-10 size-3  close-popup-all"><span><i class="icon-cancel-2 blue-icon"></i></span></a>

        <div class="popup-paddings">
            <div class="empty-space col-xs-b80"></div>

            <div class="row">
                
                <?php foreach (Yii::$app->params['lang'] as $code => $lang) : ?>
                    <div class="col-sm-6 ">
                        <a href="/?lang=<?php echo $code; ?>" class="h4-b "><?= Yii::t('app', $lang); ?></a>
							<div class="empty-space col-xs-b15 col-sm-b15"></div>
                    </div>
				
                <?php endforeach; ?>

            </div>

            <div class="empty-space col-xs-b50"></div>
        </div>
    </div>
</div>