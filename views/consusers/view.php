<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TabUsers */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tab Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tab-users-view">

  <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">

    <h2>Modifica utente</h2>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'password',
            'cusersnome',
            'cuserscognome',
            'cuserslevel',
            'authKey',
        ],
    ]) ?>
    <p>
        <?= Html::a('Aggiorna', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Elimina', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
            </p>
        </div>
        <div class="col-lg-2"></div>
    </div>
</div>