<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ConsRighe */

$this->title = 'Update Cons Righe: ' . $model->cchiave;
$this->params['breadcrumbs'][] = ['label' => 'Cons Righes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->cchiave, 'url' => ['view', 'cchiave' => $model->cchiave, 'cprogressivo' => $model->cprogressivo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cons-righe-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
