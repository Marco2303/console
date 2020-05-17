<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ConsTestata;

/**
 * ConstestataSearch represents the model behind the search form about `app\models\ConsTestata`.
 */
class ConstestataSearch extends ConsTestata
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cchiave', 'cjobid', 'cexecid', 'cflag'], 'integer'],
            [['cutente', 'cdata', 'cora', 'cformato', 'cproc', 'cappl'], 'safe'],
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
        $query = ConsTestata::find()->orderBy(['cdata' => SORT_DESC]);

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
            'cdata' => $this->cdata,
            'cora' => $this->cora,
            'cjobid' => $this->cjobid,
            'cexecid' => $this->cexecid,
            'cflag' => $this->cflag,
        ]);

        $query->andFilterWhere(['like', 'cutente', $this->cutente])
            ->andFilterWhere(['like', 'cformato', $this->cformato])
            ->andFilterWhere(['like', 'cproc', $this->cproc])
            ->andFilterWhere(['like', 'cappl', $this->cappl]);

        return $dataProvider;
    }
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchproc($params)
    {
        $query = ConsTestata::find()
                ->where(['!=','cappl',Yii::getAlias('@aggregazione')])
//                ->orderBy(['cdata' => SORT_DESC]);
                ->orderBy('cdata');

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
            'cdata' => $this->cdata,
            'cora' => $this->cora,
            'cjobid' => $this->cjobid,
            'cexecid' => $this->cexecid,
            'cflag' => $this->cflag,
        ]);

        $query->andFilterWhere(['like', 'cutente', $this->cutente])
            ->andFilterWhere(['like', 'cdata', $this->cdata])
            ->andFilterWhere(['like', 'cformato', $this->cformato])
            ->andFilterWhere(['like', 'cproc', $this->cproc])
            ->andFilterWhere(['like', 'cappl', $this->cappl]);

        return $dataProvider;
    }
}
