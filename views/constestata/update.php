<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ConsTestata */

$this->title = 'Update Cons Testata: ' . $model->cchiave;
$this->params['breadcrumbs'][] = ['label' => 'Cons Testatas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->cchiave, 'url' => ['view', 'id' => $model->cchiave]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cons-testata-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
