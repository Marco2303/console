<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use app\models\ConsTestata;
use yii\web\Session;
use app\models\ConsAppconfig;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use kartik\export\ExportMenu;
use kartik\dialog\Dialog;
use app\models\ConsTestata_table;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ConsrigheSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$s = new Session();
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

$backgroundcolor = ConsAppconfig::findOne(['cappconfigid'=>6])['cappconfigpar'];
$this->registerCss(
        ".table-striped > tbody > tr:nth-of-type(odd) {"
        ."background-color: #".$backgroundcolor.";"
        ."}"
        );


$testata = ConsTestata_table::findOne($id);
$this->title = Yii::$app->formatter->asDate($testata->cdata, 'dd/MM/yyyy HH:mm:ss');
 
$pagesize = $dataProvider->pagination->pageSize;// it will give Per Page data. 
$total = $dataProvider->totalCount; //total records // 15 

 $ur = Yii::$app->getRequest()->getQueryParam('nextpage');


?>
<div class="cons-righe-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <h5>
        <?= 'Procedura:'.$testata->cproc.' - Appl:'.$testata->cappl.' - JobID:'.$testata->cjobid 
            .' - ID stampa:'.$testata->cchiave;
        ?>
    </h5>
    
    
    <div class="form-group clearfix inline form-config" >

        <div class="col-lg-1">
            <?php 
//                Html::a( 'Home page' ,Url::toRoute(['consrighe/indexall', 'id'=>trim($s->get('indexallid')),'nextpage'=>0]), ['class'=>'btn btn-primary']);
                echo Html::a( 'Home page' ,Url::toRoute(['consrighe/index', 'id'=>$id,'nextpage'=>0]), ['class'=>'btn btn-primary']);
            ?>        
        </div>

        <div class="col-lg-1 flex-centered">
            <?php $form = ActiveForm::begin(); ?>
            <?=
            $form->field($topageform, 'topage')->textInput([
                'class' => 'form-control text-border',
                'maxlenght' => 10,
            ])->label('')
            ?>
        </div>
        <div class="col-lg-1">
            <?= Html::submitButton('To Page', ['class' => 'btn btn-success']) ?>                
        </div>

        <div class="col-lg-2">
            <h5 class="totalpage">Total Page: <?= (int) (($total + $pagesize - 1) / $pagesize); ?></h5>
        </div>
        <div class="col-lg-1 inline">
            <?= Html::a('Cerca errori', ['like', 'id' => $id], ['class' => 'btn btn-primary']) ?>        
        </div>
            <div class=""col-lg-1"></div>
            <div class="col-lg-1" style="padding-left: 50px;">
                <?= Html::a('Download TXT', ['download', 'id'=>$id], ['class' => 'btn btn-primary']) ?>        
            </div>        
            <div class="col-lg-1" style="padding-left: 100px;">
                <?= Html::a('Down TXT no Num', ['downloadall', 'id'=>$id+1], ['class' => 'btn btn-primary']) ?>        
            </div>
        <!--<div class="col-lg-5"></div>-->
        <?php $form = ActiveForm::end(); ?>
    </div>    
    
    <?php 
    
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $SearchModel,
        'layout' => "{summary}\n{pager}\n{items}\n{pager}",
        'pager' => [
            'firstPageLabel' => 'Inizio',
            'lastPageLabel'  => 'Fine',
            'maxButtonCount' => 25,
            'nextPageLabel' => '>>',
            'prevPageLabel' => '<<',
         ],        
        'rowOptions' => function ($model, $key, $index, $grid) use ($word){
            //segnala in rosso la posizione della riga in errore
            if($word != null){
                if($model['criga'] == $word)
                return ['class'=>'danger'];
            }
            $celeste = explode(',', ConsAppconfig::findOne(['cappconfigid' => 10])['cappconfigpar']);
            if ($celeste[0] != ''){
                foreach ($celeste as $value) {
                    if( strpos(strtoupper($dmodel['criga']), strtoupper($value) ) != false) {                        
                        return ['class'=>'info'];
                    }
               }
            }
            $verde = explode(',', ConsAppconfig::findOne(['cappconfigid' => 11])['cappconfigpar']);
            if ($verde[0] != ''){
                foreach ($verde as $value) {
                    if( strpos(strtoupper($model['criga']), strtoupper($value) ) != false) {                        
                        return ['class'=>'success'];
                    }
               }
            }
            $giallo = explode(',', ConsAppconfig::findOne(['cappconfigid' => 12])['cappconfigpar']);
            if ($giallo[0] != ''){
                foreach ($giallo as $value) {
                    if( strpos(strtoupper($model['criga']), strtoupper($value) ) != false) {                        
                        return ['class'=>'warning'];
                    }
               }
            }
        },                   
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',
                 'header' => 'Indice',],
            ['attribute'=> 'cprogressivo',
                'label'=>'Riga',
                'format'=>'html',
                'contentOptions' => [
                 'style' => 'font-family:'.ConsAppconfig::findOne(['cappconfigid'=>4])['cappconfigpar'].'; '
                    . '     font-size: '.ConsAppconfig::findOne(['cappconfigid'=>5])['cappconfigpar'].'px;'
                    . '     height: 20px; padding=0px; border=0px;'
                    ],
                'value' => function ($data, $key, $index, $column) {
                $globalIndex = $index + 1;
                $pagination = $column->grid->dataProvider->getPagination();
                $globalIndex = $pagination->getOffset() + $index + 1;
                return Html::a(trim($data->cprogressivo), Url::to(['consrighe/consolerr', 'id' => $data->cchiave, 'prog'=>$data->cprogressivo,'nriga' => $globalIndex]) ); // $data['name'] for array data, e.g. using SqlDataProvider.
                }
                ],
            ['attribute'=> 'criga',                
                'label'=>'Documento',
                'format'=>'raw',
                'contentOptions' => [
                 'style' => 'font-family:'.ConsAppconfig::findOne(['cappconfigid'=>4])['cappconfigpar'].'; '
                    . '     font-size: '.ConsAppconfig::findOne(['cappconfigid'=>5])['cappconfigpar'].'px;'
//                    . '     height: 20px; padding=0px; border=0px; white-space: pre;'
                    . ConsAppconfig::findOne(['cappconfigid'=>13])['cappconfigpar']
//                    . '     height: 20px; padding=0px; border=0px; overflow: hidden; text-overflow: ellipsis; word-wrap: break-word;'                    
                    ],
                'value' => function ($data) {                 
                 return htmlspecialchars($data->criga); // $data['name'] for array data, e.g. using SqlDataProvider.
                }
            ],
                    
         ],
    ]); ?>

</div>
