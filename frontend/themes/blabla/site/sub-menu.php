<?php

use yii\helpers\Html;

/**
 * @var integer $id
 */
?>

<div class="header-menu-column">
    <div class="menu-back-wrapper hidden-lg">
       <i class="icon-angle-left "></i>
        <div class="title"><?php echo $breadcrumb; ?></div>
    </div>
    <div class="header-menu-scroll-overflow">
        <div class="header-menu-scroll-container">
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
                    echo Html::a('
                                    <span class="title">' . $category_item->name . '</span>',
                        $subMenu ? ['site/sub-menu', 'id' => $category_item->ID] : [
                            'site/filter',
                            'id' => $category_item->ID
                        ], ['class' => $subMenu ? 'submenu' : '']);
                endif;
            endforeach;
            ?>
        </div>
    </div>
    <div class="menu-scroll-top"></div>
    <div class="menu-scroll-bottom"></div>
</div>