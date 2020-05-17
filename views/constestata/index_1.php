<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $searchModel app\models\ConstestataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Lista console';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cons-testata-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => "{summary}\n{pager}\n{items}\n{pager}",
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
            ['attribute'=> 'cjobid',
                'label' => 'JobID',
                'contentOptions' => ['class' => 'text-right'],
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
