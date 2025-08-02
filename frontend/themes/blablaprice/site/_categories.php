<?php

use yii\helpers\Url;

/**
 * @var \yii\web\View $this
 * @var \common\models\Category[] $category
 */

$i = 4;
for ($j = 0; $j < count($category); $j++) :
    if (!is_float($i / 4)) {
        echo '<div class="row categories-row">';
    }
    $i++;
    ?>
    <a class="category-entry col-xs-6 col-sm-3"
       href="<?php echo Url::to(['site/sub-category', 'id' => $category[$j]->ID]) ?>">
        <span class="icon"><img src="<?php echo Yii::$app->params['icons'][$category[$j]->name] ?>" alt=""/></span>
        <span class="title"><?php echo $category[$j]->name; ?></span>
    </a>
    <?php
    if (!is_float($i / 4)) :
        ?>
        </div>
        <div class="category-row-description-wrapper">
            <div class="category-row-description-wrapper-close"></div>
            <div class="category-row-description">

            </div>
        </div>
        <div class="empty-space col-sm-b30"></div>
        <?php
    endif;
endfor;

if (is_float($i / 4)) :
    ?>
    </div>
    <div class="category-row-description-wrapper">
        <div class="category-row-description-wrapper-close"></div>
        <div class="category-row-description">

        </div>
    </div>
    <div class="empty-space col-sm-b30"></div>
    <?php
endif;