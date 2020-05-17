<?php

namespace app\models;

use Yii;


/**
 * This is the model class for table "cons_righe".
 *
 * @property string $cchiave
 * @property integer $cprogressivo
 * @property string $criga
 */
class ConsRighe extends \yii\db\ActiveRecord 
{
    public $i;
    public $conserr;
    public $totalrow;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cons_righe';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cchiave', 'cprogressivo', 'criga'], 'required'],
            [['cchiave', 'cprogressivo'], 'integer'],
            [['conserr'], 'safe'],
            [['criga'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cchiave' => 'Cchiave',
            'cprogressivo' => 'Cprogressivo',
            'criga' => 'Criga',
        ];
    }
}
