<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ConsRighe */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cons-righe-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cchiave')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cprogressivo')->textInput() ?>

    <?= $form->field($model, 'criga')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
