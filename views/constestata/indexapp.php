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

   <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'searchModel' => $searchModel,
//        'layout' => "{summary}\n{pager}\n{items}\n{pager}",
        'rowOptions' => function ($dataProvider){
            if($dataProvider['cflag'] == 1){
                return ['class'=>'success'];
            }
        },       
        'export' => false,
        'columns' => [
            ['attribute' => 'cutente',
                'label' => 'Utente',
                'contentOptions' => ['class' => 'text-left'],
            ],
            ['attribute'=> 'cdata',
                'label'=>'Data/Ora',
                'contentOptions' => ['class' => 'text-center'],
                'format' => 'raw',
                'value' => function ($data){
//                    $spl = explode('-',$data->cdata);
//                    return $spl[2].'/'.$spl[1].'/'.$spl[0].' '.$data->cora;
                    return $data->cdata;
                }
                ],
//            ['attribute'=>'cora',
//                'label'=>'Ora'],
//            'cjobid',
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
                         return Html::a('<span class="glyphicon glyphicon-share"></span>', $url,
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
                      return Url::toRoute(['consrighe/index', 
                          'id' => $model['cchiave'],
                          'nextpage' => 0,
//                          'topage' => 0,
//                          'articolo' => $model['crowcodicearticolo'],
                          ]);
                  }
              }                
                         
                ],
        ],
    ]); ?>
</div>
