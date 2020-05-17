<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Description of SearchForm
 *
 * @author marco
 */
class SearchForm extends Model{
    //put your code here
    
    public $codicepv;
    public $articolo;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['codicepv', 'codicepv','max' => 9],  'required'],
            [['articolo', 'articolo','max' => 9],  'required'],
            // rememberMe must be a boolean value
        ];
    }
    
            
}
