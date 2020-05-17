<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ConsTestata */

$this->title = $model->cchiave;
$this->params['breadcrumbs'][] = ['label' => 'Cons Testatas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cons-testata-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->cchiave], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->cchiave], [
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
            'cutente',
            'cdata',
            'cora',
            'cjobid',
            'cformato',
            'cproc',
            'cappl',
            'cexecid',
            'cflag',
        ],
    ]) ?>

</div>
