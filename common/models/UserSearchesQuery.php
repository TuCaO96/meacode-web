<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[UserSearches]].
 *
 * @see UserSearches
 */
class UserSearchesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return UserSearches[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return UserSearches|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
