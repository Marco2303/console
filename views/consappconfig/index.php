<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ConsappconfigSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Configurazione APP';

?>
<div class="consappconfig-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['attribute'=> 'cappconfigid',
                'label' => 'Prog.',
                ],
            ['attribute'=> 'cappconfigpar',
                'label' => 'Parametro'
                ],
            ['attribute'=> 'cappconfigdesc',
                'label' => 'Descrizione'
                ],

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
                ],
        ],
    ]); ?>
    <p>
        <!---  Html::a('Nuovo parametro', ['create'], ['class' => 'btn btn-success']) --> 
    </p>
</div>
