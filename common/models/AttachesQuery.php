<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Attaches]].
 *
 * @see Attaches
 */
class AttachesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Attaches[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Attaches|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
