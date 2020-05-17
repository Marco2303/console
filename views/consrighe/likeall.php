<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use app\models\ConsTestata;
use yii\web\Session;
use app\models\ConsAppconfig;
use app\models\ConsTestata_table;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ConsrigheSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$par = ConsAppconfig::findOne(['cappconfigid'=>3])['cappconfigpar'];
$this->registerCss(
            ".table-bordered > thead > tr > th,"
            .".table-bordered > tbody > tr > th,"
            .".table-bordered > tfoot > tr > th,"
            .".table-bordered > thead > tr > td,"
            .".table-bordered > tbody > tr > td,"
            .".table-bordered > tfoot > tr > td {"
            ."    border: 1px solid #".$par."; padding= 0px;"
            ."}"        
        );

$par = ConsAppconfig::findOne(['cappconfigid'=>7])['cappconfigpar'];
$this->registerCss(
        ".table > thead > tr > th," 
        .".table > tbody > tr > th," 
        .".table > tfoot > tr > th," 
        .".table > thead > tr > td," 
        .".table > tbody > tr > td," 
        .".table > tfoot > tr > td {"
        ."    padding: ".$par."px;"
        ."    }"
        );

$backgroundcolor = ConsAppconfig::findOne(['cappconfigid'=>3])['cappconfigpar'];
$this->registerCss(
        ".table-striped > tbody > tr:nth-of-type(odd) {"
        ."background-color: #".$backgroundcolor.";"
        ."}"
        );

$testata = ConsTestata_table::findOne($id);
$this->title = Yii::$app->formatter->asDate($testata->cdata, 'dd/MM/yyyy HH:mm:ss');

?>
<div class="cons-righe-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <h5>
        <?= 'Procedura:'.$testata->cproc.' - Appl:'.$testata->cappl.' - JobID:'.$testata->cjobid 
            .' - ID stampa:'.$testata->cchiave;
        ?>
    </h5>
    <p></p>
    <?php
        echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn',
//                'header' => 'Indice',
//                ],
            ['attribute'=> 'posizione',
                'label'=>'Indice',
                'format'=>'html',
                'value' => function ($data, $id, $posizione) {                 
                    return Html::a(trim($data['posizione']), ['consrighe/indexall', 'id' => $data['cchiave'], 'nextpage' => null, 'posizione' => $data['posizione'],'word'=>$data['criga']] ); // $data['name'] for array data, e.g. using SqlDataProvider.
                    }
                ],
            ['attribute'=> 'cprogressivo',
                'label'=>'Riga',
                'format'=>'html',
                'contentOptions' => [
                 'style' => 'font-family:'.ConsAppconfig::findOne(['cappconfigid'=>4])['cappconfigpar'].'; '
                    . '     font-size: '.ConsAppconfig::findOne(['cappconfigid'=>5])['cappconfigpar'].'px;'
                    . '     height: 20px; padding=0px; border=0px;'
                    ],
                'value' => function ($data, $id) {                 
                    return Html::a(trim($data['cprogressivo']), ['consrighe/consolerr', 'id' => $data['cchiave'], 'prog'=>$data['cprogressivo'], $data['cprogressivo']] ); // $data['name'] for array data, e.g. using SqlDataProvider.
                    }
                ],
            ['attribute'=> 'criga',                
                'label'=>'Documento',
                'format'=>'html',
                'contentOptions' => [
                 'style' => 'font-family:'.ConsAppconfig::findOne(['cappconfigid'=>4])['cappconfigpar'].'; '
                    . '     font-size: '.ConsAppconfig::findOne(['cappconfigid'=>5])['cappconfigpar'].'px;'
                    . '     height: 20px; padding=0px; border=0px;'
                    ],

            ], 
         ],
    ]); ?>
</div>
