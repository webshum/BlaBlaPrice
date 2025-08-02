<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ID',
            //'regionID',
            'username',
            'email:email',
            //'image:image',
             'phone',
             'address',
             //'status',
            [
                'label' => 'Status',
                'format' => 'raw',
                'attribute'=>'status',
                //'filter'=> ["1"=>"Active","0"=>"Disable"],
                //'options'=> ['width' => '150px', 'style' => 'text-align: center'],
                'value' => function($data) {

                    switch ($data->status) {
                        case \common\models\User::STATUS_ACTIVE :
                            return 'active';
                        case \common\models\User::STATUS_INACTIVE :
                            return 'inactive';
                        case \common\models\User::STATUS_DELETED :
                            return 'deleted';

                    }

                }
            ],
             //'role',
            [
                'label' => 'Role',
                'format' => 'raw',
                'attribute'=>'role',
                //'filter'=> ["1"=>"Active","0"=>"Disable"],
                //'options'=> ['width' => '150px', 'style' => 'text-align: center'],
                'value' => function($data) {

                    switch ($data->role) {
                        case \common\models\User::ROLE_SELLER :
                            return 'seller';
                        case \common\models\User::ROLE_USER :
                            return 'user';

                    }

                }
            ],
            // 'authKey',
            // 'passwordHash',
            // 'passwordResetToken',
             'created_at',
             'updated_at',
            // 'priceDown',
            // 'smsCode',
            // 'emailCode:email',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
