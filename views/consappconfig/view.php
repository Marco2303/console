<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\consappconfig */

$this->title = $model->cappconfigdesc;
//$this->params['breadcrumbs'][] = ['label' => 'Consappconfigs', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="consappconfig-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
            <?= Html::a('Configura APP',['index'],['class' => 'btn btn-primary']) ?>
        <?= Html::a('Aggiorna', ['update', 'id' => $model->cappconfigid], ['class' => 'btn btn-primary']) ?>
       <!---  
//        Html::a('Delete', ['delete', 'id' => $model->cappconfigid], [
//            'class' => 'btn btn-danger',
//            'data' => [
//                'confirm' => 'Are you sure you want to delete this item?',
//                'method' => 'post',
//            ],
//        ]) 
         --->
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            ['attribute'=> 'cappconfigid',
                'label' => 'Prog.',
                ],
            ['attribute'=> 'cappconfigpar',
                'label' => 'Parametro'
                ],
            ['attribute'=> 'cappconfigdesc',
                'label' => 'Descrizione'
                ],
        ],
    ]) ?>
</div>
