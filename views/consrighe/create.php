<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ConsRighe */

$this->title = 'Create Cons Righe';
$this->params['breadcrumbs'][] = ['label' => 'Cons Righes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cons-righe-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
