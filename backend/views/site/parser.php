<?php
use yii\helpers\Html;

?>
<div class="row">
    <div class="col-lg-3 category-tab">
        <h3>categories</h3>
        <div class="progress">
            <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                 style="width: 0%;">
                0%
            </div>
        </div>
        <?php
        echo Html::a('upload', ['#'], ['id' => 'category', 'class' => 'btn btn-primary']);
        ?>
        <table class="table folder">
            <thead>
            <tr>
                <th>file</th>
                <th>time</th>
            </tr>
            </thead>
            <?php
            foreach ($category as $file) {
                if (substr($file, -3) == 'csv') {
                    echo '<tr class="file-row"><td class="file">' . $file . '</td> <td class="status">-</span></tr>';
                }
            }

            ?>
        </table>

    </div>
    <div class="col-lg-3 filter-tab">
        <h3>filters</h3>
        <div class="progress">
            <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                 style="width: 0%;">
                0%
            </div>
        </div>
        <?php
        echo Html::a('upload', ['#'], ['id' => 'filter', 'class' => 'btn btn-primary']);
        ?>
        <table class="table folder">
            <thead>
            <tr>
                <th>file</th>
                <th>time</th>
            </tr>
            </thead>
            <?php
            foreach ($filter as $file) {
                if (substr($file, -3) == 'csv') {
                    echo '<tr class="file-row"><td class="file">' . $file . '</td> <td class="status">-</span></tr>';
                }
            }

            ?>
        </table>
    </div>
    <div class="col-lg-3 product-tab">
        <h3>products</h3>
        <div class="progress">
            <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                 style="width: 0%;">
                0%
            </div>
        </div>
        <?php
        echo Html::a('upload', ['#'], ['id' => 'product', 'class' => 'btn btn-primary']);
        ?>
        <table class="table folder">
            <thead>
            <tr>
                <th>file</th>
                <th>time</th>
            </tr>
            </thead>
            <?php
            foreach ($product as $file) {
                if (substr($file, -3) == 'csv') {
                    echo '<tr class="file-row"><td class="file">' . $file . '</td> <td class="status">-</span></tr>';
                }
            }

            ?>
        </table>

    </div>

    <div class="col-lg-3 price-tab">
        <h3>prices</h3>
        <div class="progress">
            <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                 style="width: 0%;">
                0%
            </div>
        </div>
        <?php
        echo Html::a('upload', ['#'], ['id' => 'price', 'class' => 'btn btn-primary']);
        ?>
        <table class="table folder">
            <thead>
            <tr>
                <th>file</th>
                <th>time</th>
            </tr>
            </thead>
            <?php
            foreach ($price as $file) {
                if (substr($file, -3) == 'csv') {
                    echo '<tr class="file-row"><td class="file">' . $file . '</td> <td class="status">-</span></tr>';
                }
            }

            ?>
        </table>
    </div>
</div>