<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "courses_attaches".
 *
 * @property int $courses_id
 * @property int $attaches_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Attaches $attaches
 * @property Courses $courses
 */
class CoursesAttaches extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'courses_attaches';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['courses_id', 'attaches_id', 'created_at', 'updated_at'], 'required'],
            [['courses_id', 'attaches_id', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['courses_id', 'attaches_id', 'created_at', 'updated_at'], 'integer'],
            [['courses_id', 'attaches_id'], 'unique', 'targetAttribute' => ['courses_id', 'attaches_id']],
            [['attaches_id'], 'exist', 'skipOnError' => true, 'targetClass' => Attaches::className(), 'targetAttribute' => ['attaches_id' => 'id']],
            [['courses_id'], 'exist', 'skipOnError' => true, 'targetClass' => Courses::className(), 'targetAttribute' => ['courses_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'courses_id' => Yii::t('app', 'Courses ID'),
            'attaches_id' => Yii::t('app', 'Attaches ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttaches()
    {
        return $this->hasOne(Attaches::className(), ['id' => 'attaches_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourses()
    {
        return $this->hasOne(Courses::className(), ['id' => 'courses_id']);
    }

    /**
     * {@inheritdoc}
     * @return CoursesAttachesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CoursesAttachesQuery(get_called_class());
    }
}
