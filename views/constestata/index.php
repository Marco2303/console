<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\Url;
use app\models\ConstestataSearch;



/* @var $this yii\web\View */
/* @var $searchModel app\models\ConstestataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Lista console';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cons-testata-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
//        'export' => false,
        'layout' => "{summary}\n{pager}\n{items}\n{pager}",
        'pager' => [
            'firstPageLabel' => 'Inizio',
            'lastPageLabel'  => 'Fine',
            'maxButtonCount' => 25,
            'nextPageLabel' => '>>',
            'prevPageLabel' => '<<',
         ],        
        'containerOptions'=>['style'=>'overflow: auto'],
        'headerRowOptions'=>['class'=>'kartik-sheet-style'],
        'filterRowOptions'=>['class'=>'kartik-sheet-style'],
         'pjax'=>true,       
        'rowOptions' => function ($dataProvider){
            if($dataProvider['cflag'] == 1){
                return ['class'=>'success'];
            }elseif ($dataProvider['cflag'] == 2) {
                return ['class'=>'danger'];
            }
        },           
        'columns' => [
            [
                'class' => 'kartik\grid\ExpandRowColumn',
                'value' => function ($model, $key, $index, $column){
                        if ($model['cappl'] == Yii::getAlias('@aggregazione')){
                            return GridView::ROW_COLLAPSED;
                        }else{
                            return GridView::ICON_UNCHECKED;
                        }
                },
                'detail' => function ($model, $key, $index, $column){
                    $searchModel = new ConstestataSearch();
                    $searchModel->cproc = $model['cproc'];
                    $searchModel->cexecid = $model['cexecid'];
                    $dataProvider = $searchModel->searchproc(Yii::$app->request->queryParams);
                    $dataProvider->pagination->pageSize = 200;
                    return Yii::$app->controller->renderPartial('indexapp',[
                            'dataProvider' => $dataProvider,
                        ]);
                },                
            ],
            ['attribute' => 'cutente',
                'label' => 'Utente',
                'contentOptions' => ['class' => 'text-left'],
            ],
            ['attribute'=> 'cdata',
                'label'=>'Data/Ora',                
                'contentOptions' => ['class' => 'text-center'],
                ],
            ['attribute'=> 'cproc',
                'label' => 'Procedura',
                'contentOptions' => ['class' => 'text-left'],
                ],
            ['attribute'=> 'cappl',
                'label'=> 'App',
                 'contentOptions' => ['class' => 'text-left'],
                ],

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view}', 
                 'buttons' => [
                     'view' => 
                     function ($url , $model) {
                         return Html::a('<span class="glyphicon glyphicon-list"></span>', $url,
                                 [
                                  'title' => Yii::t('app', 'Visualizza console'),
                                  'target' => '_blank', 
                                  'data-pjax'=>"0",   
                                     ]
                        );
                     } 
                 ], 
                  'urlCreator' => function ($action, $model, $key, $index) {
                  if ($action === 'view') {
                      return Url::toRoute(['consrighe/indexall', 
                          'id' => $model['cchiave'],
                          'nextpage' => 0,
                          ]);
                  }
              }                
                         
                ],
        ],
    ]); ?>
</div>
