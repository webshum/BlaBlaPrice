<?php

use yii\helpers\Html;
use yii\helpers\Url;
use common\models\User;

?>
<!-- FOOTER BEGIN -->
<!--<div style="position: absolute; left: -10000px; top: -10000px;">-->


<?php if (Yii::$app->user->identity == User::ROLE_USER) : ?>
<footer class="col-xs-text-center col-sm-text-left visible-lg <?= $Text?>">
</footer>
<?php elseif (Yii::$app->user->identity->role == User::ROLE_SELLER) : ?>
<footer class="col-xs-text-center col-sm-text-left visible-lg">
</footer>
<?php elseif (Yii::$app->user->identity->role <> User::ROLE_SELLER) : ?>
<footer class="col-xs-text-center col-sm-text-left ">

</footer>
 <?php endif;?>
<div id="responsive-point" class="hidden-lg"></div>
<!--</div>-->
<!-- FOTER END -->
