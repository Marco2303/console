<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TabusersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Anagrafico Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tab-users-index">
<div class="tabpdv-index">
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
    <h2>Anagrafico Users</h2>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [            
            'id',
            'username',
            'password',
            'cusersnome',
            'cuserscognome',
            'cuserslevel',
            // 'authKey',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <p>
        <?= Html::a('Nuovo Users', ['create'], ['class' => 'btn btn-primary']) ?>
        </p>
        </div>
        <div class="col-lg-2"></div>
    </div>
</div>
