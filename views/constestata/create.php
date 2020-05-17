<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ConsTestata */

$this->title = 'Create Cons Testata';
$this->params['breadcrumbs'][] = ['label' => 'Cons Testatas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cons-testata-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
