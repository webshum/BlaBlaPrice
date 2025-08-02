<?php

use yii\helpers\Html;

$filters = json_decode($filters);

/**
 * @var \yii\web\View $this
 * @var \common\models\Category[] $category
 * @var string $breadcrumb
 */
?>

<div class="popup-container wide">
    <div class="popup-breadcrumbs">
        <?php echo $breadcrumb; ?>
        <a class="button style-10 size-3 shadow close-popup-all"><i class="icon-cancel-2 "></i> alt=""></span></a>
    </div>
    <div class="popup-paddings">
        <div class="empty-space col-xs-b30"></div>
        <?php
        
        // echo Html::beginForm('', 'post', ['class' => 'category-form']);
        ?>
        <div class="row category-items">
            <?php
            foreach ($category as $category_item) :
                ?>
                <div class="col-sm-6 col-md-4">
                    <div class="filter-entry">
                        <label class="checkbox-entry">
                            <?php
                            $sel = false;
                            foreach (Yii::$app->user->identity->category as $selected) {
                                if ($selected->ID == $category_item->ID) {
                                    $sel = true;
                                    break;
                                }
                            }
                            ?>
                            <input <?php echo $sel ? 'checked' : '' ?> type="checkbox" class="category-submit"
                                                                       value="<?php echo $category_item->ID; ?>"
                                                                       name="category[]" <?php echo (in_array($category_item->ID, $filters->category)) ? 'checked' : ''; ?>><span><?php echo $category_item->name; ?></span>
                        </label>
                        <?php
                        if ($category_item->subCategory) :
                            ?>
                            <div class="filter-arrow open-popup" data-param="<?php echo $category_item->ID; ?>"
                                 data-rel="seller-filter"></div>
                            <?php
                        endif;
                        ?>
                    </div>
                </div>
                <?php
            endforeach;
            ?>
        </div>
        <?php
        // echo Html::endForm();
        ?>
        <div class="empty-space col-xs-b30"></div>
    </div>
</div>