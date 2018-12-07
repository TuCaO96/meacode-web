<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "content_rating".
 *
 * @property int $id
 * @property int $user_id
 * @property int $content_id
 * @property int $score
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Contents $content
 * @property Users $user
 */
class ContentRating extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'content_rating';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'content_id', 'score', 'created_at', 'updated_at'], 'required'],
            [['user_id', 'content_id', 'score', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['user_id', 'content_id', 'score', 'created_at', 'updated_at'], 'integer'],
            [['content_id'], 'exist', 'skipOnError' => true, 'targetClass' => Contents::className(), 'targetAttribute' => ['content_id' => 'id']],
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
            'user_id' => Yii::t('app', 'User ID'),
            'content_id' => Yii::t('app', 'Content ID'),
            'score' => Yii::t('app', 'Score'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public function fields()
    {
        return [
            'content',
            'score',
            'user'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContent()
    {
        return $this->hasOne(Contents::className(), ['id' => 'content_id']);
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
     * @return ContentRatingQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ContentRatingQuery(get_called_class());
    }
}
