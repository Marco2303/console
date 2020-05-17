<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ConsProc]].
 *
 * @see ConsProc
 */
class ConsProcQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ConsProc[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ConsProc|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
