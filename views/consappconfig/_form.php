<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\consappconfig */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="consappconfig-form">

    <?php $form = ActiveForm::begin(); ?>
<!--    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">-->
            <?= $form->field($model, 'cappconfigpar')->textInput(['maxlength' => true])->label('Parametro') ?>

            <?= $form->field($model, 'cappconfigdesc')->textInput(['maxlength' => true])->label('Descrizione') ?>

            <div class="form-group">
                <?= Html::a('Configura APP', ['index'], ['class' => 'btn btn-primary']) ?>
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Aggiorna', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
<!--        </div>
        <div class="col-lg-2"></div>
    </div>    -->
    <?php ActiveForm::end(); ?>

</div>
