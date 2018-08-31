<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[SuggestionsAttaches]].
 *
 * @see SuggestionsAttaches
 */
class SuggestionsAttachesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return SuggestionsAttaches[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return SuggestionsAttaches|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
