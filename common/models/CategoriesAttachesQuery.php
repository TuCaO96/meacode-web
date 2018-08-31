<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[CategoriesAttaches]].
 *
 * @see CategoriesAttaches
 */
class CategoriesAttachesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CategoriesAttaches[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CategoriesAttaches|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
