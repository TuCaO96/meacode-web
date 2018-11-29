<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "suggestions".
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $text
 * @property string $email
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Users $user
 */
class Suggestions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'suggestions';
    }

    public function fields()
    {
        return [
            'id', 'title', 'text', 'user', 'email'
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text', 'email'], 'string'],
            [['title', 'text'], 'required'],
            [['user_id'], 'default', 'value' => null],
            [['title'], 'string', 'max' => 255],
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
            'title' => Yii::t('app', 'Title'),
            'email' => Yii::t('app', 'Email'),
            'text' => Yii::t('app', 'Text'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return SuggestionsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SuggestionsQuery(get_called_class());
    }
}
