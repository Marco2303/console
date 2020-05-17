<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ConstestataSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cons-testata-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'cchiave') ?>

    <?= $form->field($model, 'cutente') ?>

    <?= $form->field($model, 'cdata') ?>

    <?= $form->field($model, 'cora') ?>

    <?= $form->field($model, 'cjobid') ?>

    <?php // echo $form->field($model, 'cformato') ?>

    <?php // echo $form->field($model, 'cproc') ?>

    <?php // echo $form->field($model, 'cappl') ?>

    <?php // echo $form->field($model, 'cexecid') ?>

    <?php // echo $form->field($model, 'cflag') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
