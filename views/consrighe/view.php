<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ConsRighe */

$this->title = $model->cchiave;
$this->params['breadcrumbs'][] = ['label' => 'Cons Righes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cons-righe-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'cchiave' => $model->cchiave, 'cprogressivo' => $model->cprogressivo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'cchiave' => $model->cchiave, 'cprogressivo' => $model->cprogressivo], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'cchiave',
            'cprogressivo',
            'criga',
        ],
    ]) ?>

</div>
