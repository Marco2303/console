<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ConsRighe]].
 *
 * @see ConsRighe
 */
class ConsRigheQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ConsRighe[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ConsRighe|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
