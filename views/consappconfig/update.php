<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\consappconfig */

$this->title = 'Update APP: ' . $model->cappconfigdesc;
//$this->params['breadcrumbs'][] = ['label' => 'Consappconfigs', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->cappconfigid, 'url' => ['view', 'id' => $model->cappconfigid]];
//$this->params['breadcrumbs'][] = 'Update';
?>
<div class="consappconfig-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
