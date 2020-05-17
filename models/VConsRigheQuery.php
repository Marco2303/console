<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[VConsRighe]].
 *
 * @see VConsRighe
 */
class VConsRigheQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return VConsRighe[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return VConsRighe|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
