<?php

use yii\helpers\Html;

?>

<div class="bottom">
    <div class="menu-column clearfix">
        <div class="menu-back-wrapper hidden-lg">
            <div class="button style-3 size-3"><span><img src="img/icon-24.png" alt=""></span></div>
            <div class="title"><?php echo $breadcrumb; ?></div>
        </div>
        <div class="overflow">
            <?php
            foreach ($this->context->category as $category_item) :
                $subMenu = false;
                if ($category_item->parentID == $id) :
                    foreach ($this->context->category as $subCategory) {
                        if ($category_item->ID == $subCategory->parentID) {
                            $subMenu = true;
                            break;
                        }
                    }
                    echo Html::a($category_item->name, $subMenu ? ['site/sub-category', 'id' => $category_item->ID] : [
                        'site/filter',
                        'id' => $category_item->ID,
                        '#' => 'characteristics'
                    ], ['class' => $subMenu ? 'submenu' : '']);
                endif;
            endforeach;
            ?>
        </div>
    </div>
</div>