<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "contents".
 *
 * @property int $id
 * @property string $title
 * @property string $text
 * @property int $user_id
 * @property int $course_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Courses $course
 * @property Users $user
 * @property ContentsAttaches[] $contentsAttaches
 * @property Attaches[] $attaches
 */
class Contents extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contents';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text'], 'string'],
            [['user_id', 'course_id', 'created_at', 'updated_at'], 'required'],
            [['user_id', 'course_id', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['user_id', 'course_id', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 255],
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
            'title' => Yii::t('app', 'Title'),
            'text' => Yii::t('app', 'Text'),
            'user_id' => Yii::t('app', 'User ID'),
            'course_id' => Yii::t('app', 'Course ID'),
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
     * @return \yii\db\ActiveQuery
     */
    public function getContentsAttaches()
    {
        return $this->hasMany(ContentsAttaches::className(), ['contents_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttaches()
    {
        return $this->hasMany(Attaches::className(), ['id' => 'attaches_id'])->viaTable('contents_attaches', ['contents_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ContentsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ContentsQuery(get_called_class());
    }
}
