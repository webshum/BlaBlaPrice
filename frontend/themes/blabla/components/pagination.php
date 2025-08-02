<?php 

use yii\helpers\Url; 

?>

<?php if (!empty($pages->pageCount) && $pages->pageCount > 1) : ?>
    <div class="pagination-wrapper">
        <?php if ($pages->pageCount > 1) {
            $currentPage = $pages->page + 1;
            $totalPages = $pages->pageCount;

            // Показати стрілку "вліво" якщо не на першій сторінці
            if ($currentPage > 1) { ?>
                <a class="button style-32 inline-block"
                   href="<?= Url::to([$url, 'page' => $currentPage - 1]) ?>">
                    <span>&laquo;</span>
                </a>
            <?php }

            // Вивести три сторінки
            for ($i = max(1, $currentPage - 1); $i <= min($totalPages, $currentPage + 1); $i++) { ?>
                <a class="button <?= $i == $currentPage ? 'style-31' : 'style-32' ?> inline-block"
                   href="<?= Url::to([$url, 'page' => $i]) ?>">
                    <span><?= $i ?></span>
                </a>
            <?php }

            // Показати стрілку "вправо" якщо не на останній сторінці
            if ($currentPage < $totalPages) { ?>
                <a class="button style-32 inline-block"
                   href="<?= Url::to([$url, 'page' => $currentPage + 1]) ?>">
                    <span>&raquo;</span>
                </a>
            <?php }
        } ?>
    </div>
<?php endif; ?>

<!-- 

<div class="pagination-wrapper">
    <?php
	    $active = false;
        
	    if($pages->pageCount>1) {
            for ($i = 1; $i <= $pages->pageCount; $i++) {
                if ($i - 1 == $pages->page) $active = true;
                ?>

                    <a class="button <?= $active ? 'style-31' : 'style-32' ?> inline-block"
                       href="<?= Url::to([$url, 'page' => $i]) ?>">
                        <span><?= $i ?></span>
                    </a>

                <?php
                $active = false;
            }
        }
    ?>
</div> -->