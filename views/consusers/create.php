<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TabUsers */

$this->title = 'Nuovo utente';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tabpdv-create">
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">

    <h2> Inserisci nuovo utente</h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
        </div>
        <div class="col-lg-2"></div>
    </div>

</div>
