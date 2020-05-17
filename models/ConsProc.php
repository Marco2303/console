<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cons_proc".
 *
 * @property string $cname
 * @property integer $caggr
 * @property string $cexecid
 */
class ConsProc extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cons_proc';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cname'], 'required'],
            [['caggr', 'cexecid'], 'integer'],
            [['cname'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cname' => 'Cname',
            'caggr' => 'Caggr',
            'cexecid' => 'Cexecid',
        ];
    }

    /**
     * @inheritdoc
     * @return ConsProcQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ConsProcQuery(get_called_class());
    }
}
