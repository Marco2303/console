<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TabUsers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tab-users-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cusersnome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cuserscognome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cuserslevel')->dropDownList([ 'ADMIN' => 'ADMIN', 'UTENTE' => 'UTENTE', 'GUEST' => 'GUEST', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'authKey')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Inserisci' : 'Modifica', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
