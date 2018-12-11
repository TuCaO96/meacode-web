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
            'user_id' => Yii::t('app', 'Usuário'),
            'title' => Yii::t('app', 'Título'),
            'email' => Yii::t('app', 'Email'),
            'text' => Yii::t('app', 'Texto'),
            'created_at' => Yii::t('app', 'Criado Em'),
            'updated_at' => Yii::t('app', 'Atualizado Em'),
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
