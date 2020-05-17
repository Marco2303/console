<?php

namespace app\controllers;

use Yii;
use app\models\ConsRighe;
use app\models\ConsrigheSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\db\Query;
use yii\web\Session;
use app\models\ConsAppconfig;
use app\models\TopageForm;
use app\models\ConsProc;
use app\models\ConsTestata;
use app\models\ConsTestata_table;


/**
 * ConsrigheController implements the CRUD actions for ConsRighe model.
 */
class ConsrigheController extends Controller
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
     * Lists all ConsRighe models.
     * @return mixed
     */
    public function actionIndex($id, $nextpage = null, $posizione = null, $word = null)
    {   
        $s = new Session();
        if (strlen($s->get('username'))==0){            
            return $this->redirect('index.php?r=site/login');
        }
        
        if (! is_null($id)){
            //controllo se è un console
            Yii::$app->db->createCommand('update cons_testata set cflag=1 where cchiave='.$id)->execute();
            $this->set_color_testata($id);

            $topageform = new TopageForm();
            $searchModel = new ConsrigheSearch();
            $searchModel->cchiave=$id;
            $dataProvider = $searchModel->search('');
//            questo tipo ri ricerca da problemi con i campi data
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams+['searchModel' => ['cchiave'=>$id]]);
            $dataProvider->pagination->pageSize = ConsAppconfig::findOne(['cappconfigid'=>1])['cappconfigpar'];

            //Crea il file da stampare
            $prtfile = $this->SalvaConsoleTXT($this->StampaFileConsole(null, $id),$id);

            if ($topageform->load(Yii::$app->request->post())){
                $dataProvider->pagination->page = $topageform->topage -1;     
           }elseif($posizione !== null){
                $pag = ConsAppconfig::findOne(['cappconfigid'=>1])['cappconfigpar'];
                $position =  intdiv($posizione, $pag);
                $dataProvider->pagination->page = $position;
            }        }

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'SearchModel' => $searchModel,
            'topageform' => $topageform,
            'id' => $id,
            'word' => $word,
        ]);
    }

    
    /**
     * Lists all ConsRighe models.
     * @return mixed
     */
    public function actionIndexall($id, $nextpage = null, $posizione = null, $word = null)
    {   
        $s = new Session();
        if (strlen($s->get('username'))==0){            
            return $this->redirect('index.php?r=site/login');
        }
                
        if (! is_null($id)){
            //controllo se è un console
            $s->set('indexallid', $id);

            $topageform = new TopageForm();
            $searchModel = new ConsrigheSearch();
            
            $cexecid = ConsTestata::find()->where(['cchiave'=>$id])->one()['cexecid'];
            $proc = ConsTestata::find()->where(['cchiave'=>$id])->one()['cproc'];
            $key = ConsTestata::find()->select(['cchiave'])->where(['cexecid'=>$cexecid])->andWhere(['cproc'=>$proc])->asArray()->all();            
//            questo tipo di ricerca da problemi con i campi data
            $dataProvider = $searchModel->searchconsole(Yii::$app->request->queryParams+['searchModel' => ['cchiave'=>$id]],$key,$id);
            $dataProvider->pagination->pageSize = ConsAppconfig::findOne(['cappconfigid'=>1])['cappconfigpar'];

            //Crea il file da stampare
            $prtfile = $this->SalvaConsoleTXT($this->StampaFileConsole($key, $id),$id);
            
            if ($topageform->load(Yii::$app->request->post())){
                $dataProvider->pagination->page = $topageform->topage -1;     
            }elseif($posizione !== null){
                $pag = ConsAppconfig::findOne(['cappconfigid'=>1])['cappconfigpar'];
                $position =  intdiv($posizione, $pag);
                $dataProvider->pagination->page = $position;
            }
        }
        
//        $totalrow = $dataProvider->getTotalCount();
        
        return $this->render('indexall', [
            'dataProvider' => $dataProvider,
            'SearchModel' => $searchModel,
            'topageform' => $topageform,            
            'id' => $id,
            'posizione' => $posizione,
            'word' => $word,
        ]);
    }
    
    /**
     *
     * Scarica in locale il file del console
     *  
     * @param type $prtfile
     * @param type $id
     */
    public function actionDownloadall($id){
        
        $prtfile = Yii::getAlias('@webroot').'/upload/'.$id.'.txt';
        if (file_exists($prtfile)) {
           return Yii::$app->response->sendFile($prtfile);
        }
        
        $this->redirect(['consrighe/indexall','id'=>$id]);
    }
    
    /**
     *
     * Scarica in locale il file del console
     *  
     * @param type $prtfile
     * @param type $id
     */
    public function actionDownload($id){
        
        $prtfile = Yii::getAlias('@webroot').'/upload/'.$id.'.txt';
        if (file_exists($prtfile)) {
           return Yii::$app->response->sendFile($prtfile);
        }
        
        $this->redirect(['consrighe/index','id'=>$id]);
    }
    
    /**
     * Lists all ConsRighe models error.
     * @return mixed
     */
    public function actionConsolerr($id,$prog,$globalriga=null){
       $s = new Session();
        if (strlen($s->get('username'))==0){            
            return $this->redirect('index.php?r=site/login');
        }
        $topageform = new TopageForm();
        $prog = $prog - 1;
        $initcons = $prog - ConsAppconfig::findOne(['cappconfigid'=>9])['cappconfigpar'] ;
        if ($initcons < 1) $initcons=1;

        if (! is_null($id)){
             
            $searchModel = new ConsrigheSearch();
            $dataProvider = $searchModel->search2(Yii::$app->request->queryParams,$initcons,$id);
            $dataProvider->pagination->pageSize = ConsAppconfig::findOne(['cappconfigid'=>1])['cappconfigpar'];
            
            if ($topageform->load(Yii::$app->request->post())){     //salta lla pagina
                $dataProvider->pagination->page = $topageform->topage -1;     
            } 
        }

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'SearchModel' => $searchModel,
            'topageform' => $topageform,
            'id' => $id,
            'word' => null,
        ]);
    }    

    /**
     * Lists all ConsRighe models error.
     * @return mixed
     */
    public function actionConsolerrall($id,$prog,$globalriga=null){
       $s = new Session();
        if (strlen($s->get('username'))==0){            
            return $this->redirect('index.php?r=site/login');
        }
        $topageform = new TopageForm();
        $prog = $prog - 1;
        $initcons = $prog - ConsAppconfig::findOne(['cappconfigid'=>9])['cappconfigpar'] ;
        if ($initcons < 1) $initcons=1;

        if (! is_null($id)){
             
            $searchModel = new ConsrigheSearch();
            $dataProvider = $searchModel->search2(Yii::$app->request->queryParams,$initcons,$id);
            $dataProvider->pagination->pageSize = ConsAppconfig::findOne(['cappconfigid'=>1])['cappconfigpar'];
            
            if ($topageform->load(Yii::$app->request->post())){     //salta lla pagina
                $dataProvider->pagination->page = $topageform->topage -1;     
            } 
        }

        return $this->render('indexall', [
            'dataProvider' => $dataProvider,
            'SearchModel' => $searchModel,
            'topageform' => $topageform,
            'id' => $id,   
            'word' => null,
        ]);
    }    

    /**
     * Lists all ConsRighe models.
     * @return mixed
     */
    public function actionLike($id)
    {   
        $s = new Session();
        if (strlen($s->get('username'))==0){            
            return $this->redirect('index.php?r=site/login');
        }
        
        $posizione = null;
        if (! is_null($id)){
            
            $lista_errori = explode(',', ConsAppconfig::findOne(['cappconfigid'=>8])['cappconfigpar']);
            $falsi_positivi = explode(',', ConsAppconfig::findOne(['cappconfigid'=>14])['cappconfigpar']);

            
            $arraykey = $id;
             
             //estrae tutte le righe da controllare in un array
            $totrow = ConsRighe::find('criga')->where('cchiave in ('.$arraykey.')')->asArray()->all();
            
            $righeconsole = array();                                            //da dare in pasto al data provider
            $trovatofalso = true;
            $count = 1;
            
            //scorre le righe ed estrae quelle in errore 
            foreach ($totrow as $keyr => $valuerow) {                            //scorre totale righe
                $count = $count + 1;
                if ($valuerow['criga'] != ''){                                  //salta la riga se è vuota
                    $trovatofalso = true;
                    foreach ($lista_errori as $deterr) {                        //scorre gli errori
                        if (strpos( $valuerow['criga'],$deterr)){               //estrae la riga che contine l'errore
                            foreach ($falsi_positivi as $valuefpositivi) {      //scorre i falsi positivi
                                if(strpos( $valuerow['criga'],$valuefpositivi) !== false){//se il falso positivo è presente non memorizza
                                    $trovatofalso = false;
                                }
                            }
                            if($trovatofalso){                                  //memorizzo se il false non esiste
                                $righeconsole[] = [
                                    'cchiave' => $valuerow['cchiave'],
                                    'cprogressivo' => $valuerow['cprogressivo'],
                                    'criga' => $valuerow['criga'],
                                    'posizione' => $count
                                ];
                            }
                        }
                    }
                }
            }                

//            $prearray = array();
//            $array = array();
//            foreach ($param as $value) {
//                 $tmp = ConsRighe::find()->where(['cchiave'=>$id])
//                         ->andFilterWhere(['like', 'criga', $value])
//                         ->all();
//                 foreach ($tmp as $estrai) {
//                        array_push($prearray, $estrai);
//                    }
//                }
//                foreach ($prearray as $val) {   //controllo falsi positivi
//                    $write=false;
//                    foreach ($falsipositivi as $falsi) {
//                        $ext = strstr($val->criga,$falsi);
//                        if ($ext != false) $write=true;
//                    }
//                    if($write == false) array_push($array, $val);
//                }
//                sort($array);
            
                $dataProvider = new ArrayDataProvider([
                    'allModels' => $righeconsole,
                    'pagination' => [
                        'pageSize' => 20,
                        ],
                    ]);
                $dataProvider->pagination->pageSize = ConsAppconfig::findOne(['cappconfigid'=>1])['cappconfigpar'];
        }
        return $this->render('like', [
            'dataProvider' => $dataProvider,
            'id' => $id,
        ]);
    }
    /**
     * 
     * @param type $id
     * @return type
     */
    public function actionLikeall($id)
    {   
        $s = new Session();
        if (strlen($s->get('username'))==0){            
            return $this->redirect('index.php?r=site/login');
        }
        
        if (! is_null($id)){
            
            $lista_errori = $this->Read_Errori(); 
            $falsi_positivi = $this->Read_Falsi_Positivi();
            
            $cexecid = ConsTestata::find()->where(['cchiave'=>$id])->one()['cexecid'];
            $proc = ConsTestata::find()->where(['cchiave'=>$id])->one()['cproc'];
            $key = ConsTestata::find()->select(['cchiave'])->where(['cexecid'=>$cexecid])->andWhere(['cproc'=>$proc])->asArray()->all();            
            $arraykey ='';
            if ($key != ''){            
                foreach ($key as $val) {
                        $arraykey = $val['cchiave'].','.$arraykey;
                        $search[] =$val['cchiave'];
                }
            }
             $arraykey = substr($arraykey, 0,-1);
             
             //estrae tutte le righe da controllare in un array
            $totrow = ConsRighe::find('criga')->where('cchiave in ('.$arraykey.')')->orderBy("cchiave,cprogressivo")->asArray()->all();
            
            $righeconsole = array();                                            //da dare in pasto al data provider
            $trovatofalso = true;
            $count = 1;
            
            //scorre le righe ed estrae quelle in errore 
            foreach ($totrow as $keyr => $valuerow) {                            //scorre totale righe
                $count = $count + 1;
                if ($valuerow['criga'] != ''){                                  //salta la riga se è vuota
                    $trovatofalso = true;
                    foreach ($lista_errori as $deterr) {                        //scorre gli errori
                        if (strpos( $valuerow['criga'],$deterr)){               //estrae la riga che contine l'errore
                            foreach ($falsi_positivi as $valuefpositivi) {      //scorre i falsi positivi
                                if(strpos( $valuerow['criga'],$valuefpositivi) !== false){//se il falso positivo è presente non memorizza
                                    $trovatofalso = false;
                                }
                            }
                            if($trovatofalso){                                  //memorizzo se il false non esiste
                                $righeconsole[] = [
                                    'cchiave' => $valuerow['cchiave'],
                                    'cprogressivo' => $valuerow['cprogressivo'],
                                    'criga' => $valuerow['criga'],
                                    'posizione' => $count
                                ];
                            }
                        }
                    }
                }
            }                
            

                $dataProvider = new ArrayDataProvider([
                    'allModels' => $righeconsole,
                    'key' => 'cprogressivo',
                    'pagination' => [
                        'pageSize' => 20,
                        ],
                    ]);
                $dataProvider->pagination->pageSize = ConsAppconfig::findOne(['cappconfigid'=>1])['cappconfigpar'];
        }
        return $this->render('likeall', [
            'dataProvider' => $dataProvider,
            'id' => $id,
        ]);
    }

    
    /**
     * Displays a single ConsRighe model.
     * @param string $cchiave
     * @param integer $cprogressivo
     * @return mixed
     */
    public function actionView($cchiave, $cprogressivo)
    {
        $s = new Session();
        if (strlen($s->get('username'))==0){            
            return $this->redirect('index.php?r=site/login');
        }
        return $this->render('view', [
            'model' => $this->findModel($cchiave, $cprogressivo),
        ]);
    }


    /**
     * Creates a new ConsRighe model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $s = new Session();
        if (strlen($s->get('username'))==0){            
            return $this->redirect('index.php?r=site/login');
        }
        $model = new ConsRighe();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'cchiave' => $model->cchiave, 'cprogressivo' => $model->cprogressivo]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ConsRighe model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $cchiave
     * @param integer $cprogressivo
     * @return mixed
     */
    public function actionUpdate($cchiave, $cprogressivo)
    {
        $s = new Session();
        if (strlen($s->get('username'))==0){            
            return $this->redirect('index.php?r=site/login');
        }
        $model = $this->findModel($cchiave, $cprogressivo);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'cchiave' => $model->cchiave, 'cprogressivo' => $model->cprogressivo]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ConsRighe model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $cchiave
     * @param integer $cprogressivo
     * @return mixed
     */
    public function actionDelete($cchiave, $cprogressivo)
    {
        $s = new Session();
        if (strlen($s->get('username'))==0){            
            return $this->redirect('index.php?r=site/login');
        }
        $this->findModel($cchiave, $cprogressivo)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ConsRighe model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $cchiave
     * @param integer $cprogressivo
     * @return ConsRighe the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($cchiave, $cprogressivo)
    {
        if (($model = ConsRighe::findOne(['cchiave' => $cchiave, 'cprogressivo' => $cprogressivo])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /*
     * 
     */
    private function sum_arrays($array, $tmp) {                    
        foreach($array as $index => $value) {
            $array[$index] = isset($tmp[$index]) ? $tmp[$index] + $value : $value;
        }
        return $array;
   }
   
   private function set_color_testata($id){
       
        $cexecid = ConsTestata::find()->where(['cchiave'=>$id])->one()['cexecid'];
        $proc = ConsTestata::find()->where(['cchiave'=>$id])->one()['cproc'];
        $key = ConsTestata::find()->select(['cflag'])->where(['cexecid'=>$cexecid])->andWhere(['cproc'=>$proc])->asArray()->all();    
            foreach ($key as $value) {
                if ($value['cflag']==0){
                    try {
                        $cons = ConsTestata::find()
                                ->select(['cchiave'])
                                ->where(['cexecid'=>$cexecid])
                                ->andWhere(['cproc'=>$proc])
                                ->andWhere(['cappl'=>'CONSOLE'])
                                ->one()['cchiave'];
                        Yii::$app->db->createCommand('update cons_testata set cflag=2 where cchiave='.$cons)->execute();
                    } catch (\Exception $exc) {
                        $ins = new ConsTestata_table();
                        $ins->cutente = 'WORKPRO';
                        $ins->cdata = date('Y-m-d H:i:s');
                        $ins->cora = null;
                        $ins->cjobid = 0;
                        $ins->cformato = null;
                        $ins->cproc = $proc;
                        $ins->cappl = 'CONSOLE';
                        $ins->cexecid = $cexecid;
                        $ins->cflag = 0;
                        $ins->save();
                    }

                return;
            }
        }
        
        try {
            $cons = ConsTestata::find()->select(['cchiave'])->where(['cexecid'=>$cexecid])->andWhere(['cappl'=>'CONSOLE'])->one();
            Yii::$app->db->createCommand('update cons_testata set cflag=1 where cchiave='.$cons->cchiave)->execute();
        } catch (\Exception $exc) {
//            echo 'Questa routin serve per colorare la riga di console, ---> Manca un parametro di configurazione oppure la selezione precendete non trova qualcosa, select cchiave from cons_testata where cchiave=??? and '
//            .'cappl="CONSOLE"  ---->>>> ' .$exc->getTraceAsString();
        }
   }
   
   /**
    * Restituisce la lista degli errori
    *  
    * @return array
    */
   private function Read_Errori(){
       
       $read = explode(',', ConsAppconfig::findOne(['cappconfigid'=>8])['cappconfigpar']);
       if ($read[0] == ''){
           return $read[] = ['0' => '§'];
       }
       return $read;
   }
   /**
    * Restituisce la lista dei falsi positivi
    *  
    * @return array
    */
   private function Read_Falsi_Positivi(){
       
       $read = explode(',', ConsAppconfig::findOne(['cappconfigid'=>14])['cappconfigpar']);
       if ($read[0] == ''){           
           return  $read[] = ['0' => '§'];
       }
       return $read;
   }
    /**
     * 
     * Estrae le righe del console in un array
     * 
     * @param type $key
     * @param type $id
     * @return type
     */
   private function StampaFileConsole($key = null,$id){
       
       if ($key != null){
            $search = array();
             $arraykey ='';
             if ($key != ''){            
                 foreach ($key as $val) {
                         $arraykey = $val['cchiave'].','.$arraykey;
                         $search[] =$val['cchiave'];
                 }
             }
              $arraykey = substr($arraykey, 0,-1);
        }else{
            $arraykey = $id;
        }
         
           $query = ConsRighe::find()
                ->Where('cchiave in ('.$arraykey.')')
                ->orderBy("cchiave,cprogressivo")
                ->asArray()   
                ->all();

       return $query;
   }
   /*
    * 
    * Salva il file in formato .txt
    * 
    */
   private function SalvaConsoleTXT($righe,$id){
       
       
       $t = Yii::getAlias('@webroot');
       
       $myfile = fopen(Yii::getAlias('@webroot').'/upload/'.$id.'.txt', "w") or die("Unable to open file!");
       foreach ($righe as $value) {
           $prog = substr($value['cprogressivo'].'      ', 0,6) ;
           fwrite($myfile, $prog.'    '.$value['criga'].PHP_EOL);
       }
       fclose($myfile);

       return $id.'.txt';
   }
   
}
