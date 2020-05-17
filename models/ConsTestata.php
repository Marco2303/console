<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cons_testata".
 *
 * @property string $cchiave
 * @property string $cutente
 * @property string $cdata
 * @property string $cora
 * @property integer $cjobid
 * @property string $cformato
 * @property string $cproc
 * @property string $cappl
 * @property string $cexecid
 * @property integer $cflag
 */
class ConsTestata extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
//        return 'cons_testata';

        return 'v_cons_righe';
        }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cdata', 'cjobid'], 'required'],
            [['cdata', 'cora'], 'safe'],
            [['cjobid', 'cexecid', 'cflag'], 'integer'],
            [['cutente', 'cformato'], 'string', 'max' => 8],
            [['cproc', 'cappl'], 'string', 'max' => 32],
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
     * @inheritdoc
     * @return ConsTestataQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ConsTestataQuery(get_called_class());
    }
}
