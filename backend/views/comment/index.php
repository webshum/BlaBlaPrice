<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Comments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'ID',
            //'userFrom',
            [
                'label' => 'From User',
                'format' => 'raw',
                'attribute' => 'userFrom',
                //'filter'=> ["1"=>"Active","0"=>"Disable"],
                //'options'=> ['width' => '150px', 'style' => 'text-align: center'],
                'value' => function ($data) {
                    return $data->userFrom->username;
                }
            ],

            [
                'label' => 'To User',
                'format' => 'raw',
                'attribute' => 'userTo',
                //'filter'=> ["1"=>"Active","0"=>"Disable"],
                //'options'=> ['width' => '150px', 'style' => 'text-align: center'],
                'value' => function ($data) {
                    return $data->userTo->username;
                }
            ],

            [
                'label' => 'Rating',
                'format' => 'raw',
                'attribute' => 'rating',
                //'filter'=> ["1"=>"Active","0"=>"Disable"],
                //'options'=> ['width' => '150px', 'style' => 'text-align: center'],
                'value' => function ($data) {
                    return $data->name;
                }
            ],

            [
                'label' => 'Refuse',
                'format' => 'raw',
                'attribute' => 'refuseID',
                //'filter'=> ["1"=>"Active","0"=>"Disable"],
                //'options'=> ['width' => '150px', 'style' => 'text-align: center'],
                'value' => function ($data) {
                    if ($data->refuseID) {
                        return Yii::$app->params['refuse'][$data->refuseID];
                    }

                }
            ],
            //'userTo',

            //'rating',
            'comment:ntext',
            [
                'label' => 'Order',
                'format' => 'raw',
                //'attribute'=>'refuseID',
                //'filter'=> ["1"=>"Active","0"=>"Disable"],
                //'options'=> ['width' => '150px', 'style' => 'text-align: center'],
                'value' => function ($data) {
                    return $data->offer->order->category->name;

                }
            ],
            //'refuseID',
            // 'created',
            'updated_at',
            //'offerID',


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
