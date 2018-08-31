<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Contents]].
 *
 * @see Contents
 */
class ContentsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Contents[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Contents|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
