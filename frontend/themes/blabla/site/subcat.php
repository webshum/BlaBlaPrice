<?php
use yii\helpers\Url;
?>

<div id="content-block">


                    <div class="logged-menu">
                        <?php foreach ($categories->all() as $category) : ?>
                        <a href="<?php echo Url::toRoute(['site/filter','id'=>$category->id]) ?>">
                        <i class="icon-sliders"></i>
                        <span><?php echo $category->name; ?></span>
                        </a>
                        <?php endforeach; ?>
                    </div>    
</div>

<?= $this->render('/site/footer'); ?>