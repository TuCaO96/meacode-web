<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "course_rating".
 *
 * @property int $id
 * @property int $user_id
 * @property int $course_id
 * @property int $score
 * @property string $comments
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Courses $course
 * @property Users $user
 */
class CourseRating extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'course_rating';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'course_id', 'score', 'created_at', 'updated_at'], 'required'],
            [['user_id', 'course_id', 'score', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['user_id', 'course_id', 'score', 'created_at', 'updated_at'], 'integer'],
            [['comments'], 'string'],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Courses::className(), 'targetAttribute' => ['course_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'Usuário'),
            'course_id' => Yii::t('app', 'Curso'),
            'score' => Yii::t('app', 'Avaliação'),
            'comments' => Yii::t('app', 'Comentários'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Courses::className(), ['id' => 'course_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return CourseRatingQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CourseRatingQuery(get_called_class());
    }
}
