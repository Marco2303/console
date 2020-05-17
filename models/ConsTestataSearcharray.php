<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

use Yii;
use yii\base\Model;
use \yii\data\ArrayDataProvider;

/**
 * Description of ConsTestataSearcharray
 *
 * @author mtosti
 */
class ConsTestataSearcharray extends Model {
   
    public $cchiave;
    public $cutente;
    public $cdata;
    public $cora;
    public $cjobid;
    public $cformato;
    public $cproc;
    public $cappl;
    public $cexecid;
    public $cflag;
    

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
    public function attributeLabels()
    {
        return [
            'cchiave' => 'Cchiave',
            'cutente' => 'Cutente',
            'cdata' => 'Cdata',
            'cora' => 'Cora',
            'cjobid' => 'Cjobid',
            'cformato' => 'Cformato',
            'cproc' => 'Cproc',
            'cappl' => 'Cappl',
            'cexecid' => 'Cexecid',
            'cflag' => 'Cflag',
            ];
    }

     /**
     * @param $params
     * @return ArrayDataProvider
     */
    public function search($params,$items)
    {
//        $items = [
//            ["id"=>1,"name"=>"Cyrus","email"=>"risus@consequatdolorvitae.org"],
//            ["id"=>2,"name"=>"Justin","email"=>"ac.facilisis.facilisis@at.ca"],
//            ["id"=>3,"name"=>"Mason","email"=>"in.cursus.et@arcuacorci.ca"],
//            ["id"=>4,"name"=>"Fulton","email"=>"a@faucibusorciluctus.edu"]
//        ];
        
//        $this->load($params);
        $src = array();
        $R;
        $key;
        if ($this->load($params)) {
            foreach ($params['ConsTestataSearcharray'] as $key => $P) {
                if(trim($P)!=''){
                 $src[$key] = $P;   
                }
            }
            foreach ($src as $key => $val) {
                $name = strtolower(trim($this->$key));
                $items = array_filter($items, 
                        function ($role) use ($name,$key){
                            return  (empty($name) || strpos((strtolower(is_object($role) ? 
                                    $role->$key : 
                                    $role[$key])), $name) !== false);
                        }
                );
            }
        }

        return $dataProvider = new ArrayDataProvider([
//            'key'=>'id',
            'allModels' => $items,
            'pagination' => [
                'pageSize' => 50,
            ],
            'sort' => [ 
                'attributes' => [ 
                    'cutente',
                    'cdata',
                    'cproc',
                    'cappl',
                    ],
                ],
        ]);
    }
}


