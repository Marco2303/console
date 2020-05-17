<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cons_appconfig".
 *
 * @property integer $cappconfigid
 * @property string $cappconfigpar
 * @property string $cappconfigdesc
 */
class ConsAppconfig extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cons_appconfig';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cappconfigpar', 'cappconfigdesc'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cappconfigid' => 'Cappconfigid',
            'cappconfigpar' => 'Cappconfigpar',
            'cappconfigdesc' => 'Cappconfigdesc',
        ];
    }

    /**
     * @inheritdoc
     * @return ConsAppconfigQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ConsAppconfigQuery(get_called_class());
    }
}
