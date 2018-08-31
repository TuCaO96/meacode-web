<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[ContentsAttaches]].
 *
 * @see ContentsAttaches
 */
class ContentsAttachesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ContentsAttaches[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ContentsAttaches|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
