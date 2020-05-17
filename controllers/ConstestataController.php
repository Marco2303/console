<?php

namespace app\controllers;

use Yii;
use app\models\ConsTestata;
use app\models\VConsRighe;
use app\models\ConstestataSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Session;
use app\models\ConsAppconfig;
use app\models\ConsProc;
use \yii\data\ArrayDataProvider;
use app\models\ConsTestataSearcharray;
/**
 * ConstestataController implements the CRUD actions for ConsTestata model.
 */
class ConstestataController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

   
    /**
     * 
     * 
     */
    public function actionIndex()
    {
        $s = new Session();
        if (strlen($s->get('username'))==0){            
            return $this->redirect('index.php?r=site/login');
        }
        
        $this->Pulizia_uploadfolder();
        
        $testatenew = array();
        $testatenew = ConsTestata::find()
		->where(['cappl'=>Yii::getAlias('@aggregazione')])
		->asarray()
		->orderby(['cdata' => SORT_DESC])
		->limit(ConsAppconfig::findOne(15)
		->cappconfigpar)
		->all();
        
		
//        foreach ($testateall as $item) {
//                if($item['cappl'] == Yii::getAlias('@aggregazione')){
//                    $testatenew[] = $item;
//                }
//        }
        
        // Sort the multidimensional array
//         usort($testatenew,
         // Define the custom sort function
//         function ($a,$b) {
//              return $a['cdata']<$b['cdata'];
//         });
        
        $dataProvider = new ArrayDataProvider([
            'allModels' => $testatenew,
            'sort' => [ 
                'attributes' => [ 
                    'cutente',
                    'cdata',
                    'cproc',
                    'cappl',
                    ],
                ],
        ]);
        
//        $searchModel = new ConstestataSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//        $dataProvider->pagination->pageSize = ConsAppconfig::findOne(['cappconfigid'=>2])['cappconfigpar'];
        $searchModel = new ConsTestataSearcharray();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$testatenew);
        $dataProvider->pagination->pageSize = ConsAppconfig::findOne(2)->cappconfigpar;
          
        return $this->render('index', [
//            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
      }
    
    /**
     * Displays a single ConsTestata model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $s = new Session();
        if (strlen($s->get('username'))==0){            
            return $this->redirect('index.php?r=site/login');
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ConsTestata model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $s = new Session();
        if (strlen($s->get('username'))==0){            
            return $this->redirect('index.php?r=site/login');
        }
        $model = new ConsTestata();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->cchiave]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ConsTestata model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $s = new Session();
        if (strlen($s->get('username'))==0){            
            return $this->redirect('index.php?r=site/login');
        }
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->cchiave]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ConsTestata model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $s = new Session();
        if (strlen($s->get('username'))==0){            
            return $this->redirect('index.php?r=site/login');
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ConsTestata model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ConsTestata the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ConsTestata::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function Pulizia_uploadfolder() {
        $path = Yii::getAlias('@webroot'.'/upload');
         if (is_dir("$path") )
        {
           $handle=opendir($path);
           while (false!==($file = readdir($handle))) {
               if ($file != "." && $file != "..") { 
                   $Diff = (time() - filectime("$path/$file"))/60/60/24;
                   if ($Diff > 1) unlink("$path/$file");

               }
           }
           closedir($handle);
        }
    }

}
