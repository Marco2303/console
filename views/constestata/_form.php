<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ConsTestata */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cons-testata-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cutente')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cdata')->textInput() ?>

    <?= $form->field($model, 'cora')->textInput() ?>

    <?= $form->field($model, 'cjobid')->textInput() ?>

    <?= $form->field($model, 'cformato')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cproc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cappl')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cexecid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cflag')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
