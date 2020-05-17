<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use app\models\ConsRighe;

/**
 * ConsrigheSearch represents the model behind the search form about `app\models\ConsRighe`.
 */
class ConsrigheSearch extends ConsRighe 
{

    

    /**
     * @inheritdoc
     */
    public function rules()
    {
        
        return [
            [['cchiave', 'cprogressivo'], 'integer'],
            [['criga'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ConsRighe::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'cchiave' => $this->cchiave,
            'cprogressivo' => $this->cprogressivo,
        ]);

        $query->andFilterWhere(['like', 'criga', $this->criga]);

        return $dataProvider;
    }
    /**
     * 
     * @param type $params
     * @param type $initcons
     * @param type $id
     * @return ActiveDataProvider
     */
      public function search2($params,$initcons,$id)
    {
           $query = ConsRighe::find()
                    ->where(['>','cprogressivo',$initcons])
                    ->andWhere(['cchiave'=>$id])
                    ->orderBy('cprogressivo');
//                    ->all();
            
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'cchiave' => $this->cchiave,
            'cprogressivo' => $this->cprogressivo,
        ]);

        $query->andFilterWhere(['like', 'criga', $this->criga]);

        return $dataProvider;
      }
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchconsole($params,$key,$id)
    {
        $search = array();
        $arraykey ='';
        if ($key != ''){            
            foreach ($key as $val) {
                    $arraykey = $val['cchiave'].','.$arraykey;
                    $search[] =$val['cchiave'];
            }
        }
         $arraykey = substr($arraykey, 0,-1);
         
         Yii::$app->db->createCommand('update cons_testata set cflag=1 where cchiave in ('.$arraykey.')')->execute();
         
           $query = ConsRighe::find()
                ->Where('cchiave in ('.$arraykey.')')
                ->orderBy("cchiave,cprogressivo");
           
           
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $this->load($params);
        $query->andFilterWhere(['=', 'cprogressivo', $this->cprogressivo]);  
        $query->andFilterWhere(['like', 'criga', $this->criga]);
 
        return $dataProvider;
    }
}
