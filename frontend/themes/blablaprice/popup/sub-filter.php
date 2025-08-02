<?php

foreach ($this->context->category as $category_item) :
    if ($category_item->ID == $categoryID) :
        $i = 0;
        if ($category_item->parentID == 0) :
            ?>
            <label class="checkbox-entry size-1">
                <?php
                $sel = false;
                foreach ($user->category as $selected) {
                    if ($selected->ID == $category_item->ID) {
                        $sel = true;
                        break;
                    }
                }
                ?>
                <input type="checkbox" <?php echo $sel ? 'checked' : '' ?> class="filters-title category-submit"
                       value="<?php echo $category_item->ID ?>"
                       name="category[]"><span><?php echo $category_item->name ?></span>
            </label>
            <div class="empty-space col-xs-b10"></div>
            <?php
            foreach ($category_item->subCategory as $category_subitem) :
                if ($i > 4) {
                    echo '<div class="filters-toggle">';
                }
                ?>
                <div class="filter-entry">
                    <label class="checkbox-entry">
                        <?php
                        $sel = false;
                        foreach ($user->category as $selected) {
                            if ($selected->ID == $category_subitem->ID) {
                                $sel = true;
                                break;
                            }
                        }
                        ?>
                        <input type="checkbox" <?php echo $sel ? 'checked' : '' ?> class="category-submit"
                               value="<?php echo $category_subitem->ID ?>"
                               name="category[]"><span><?php echo $category_subitem->name ?></span>
                    </label>
                    <?php
                    if ($category_subitem->subCategory) :
                        ?>
                        <div class="filter-arrow open-popup" <?php echo $user->getSelectedChildCategory($category_subitem->ID) ? 'style="background-color: #c8e8a1"' : '' ?>
                             data-param="<?php echo $category_subitem->ID ?>" data-rel="seller-filter"></div>
                        <?php
                    endif;
                    ?>
                </div>
                <?php
                if ($i > 4) {
                    echo '</div>';
                }
                $i++;
            endforeach;

            if ($i > 5) :
                ?>
                <div class="filters-toggle-button">
                    <a class="button style-2 size-5" href="#"><span><?php echo Yii::t('app',
                                'ПОКАЗАТИ БІЛЬШЕ'); ?></span><span><?php echo Yii::t('app',
                                'ПОКАЗАТИ МЕНШЕ'); ?></span></a>
                </div>
                <?php
            endif;
        endif;
    endif;
endforeach;