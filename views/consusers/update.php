<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TabUsers */

$this->title = 'Modifica utente: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['Visualizza', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Aggiorna';
?>
<div class="tabpdv-update">
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">

    <h2>Modifica utente</h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
        </div>
        <div class="col-lg-2"></div>
    </div>

</div>
