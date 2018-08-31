<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[CoursesAttaches]].
 *
 * @see CoursesAttaches
 */
class CoursesAttachesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CoursesAttaches[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CoursesAttaches|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
