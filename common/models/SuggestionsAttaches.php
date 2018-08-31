<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "suggestions_attaches".
 *
 * @property int $suggestions_id
 * @property int $attaches_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Attaches $attaches
 * @property Suggestions $suggestions
 */
class SuggestionsAttaches extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'suggestions_attaches';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['suggestions_id', 'attaches_id', 'created_at', 'updated_at'], 'required'],
            [['suggestions_id', 'attaches_id', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['suggestions_id', 'attaches_id', 'created_at', 'updated_at'], 'integer'],
            [['suggestions_id', 'attaches_id'], 'unique', 'targetAttribute' => ['suggestions_id', 'attaches_id']],
            [['attaches_id'], 'exist', 'skipOnError' => true, 'targetClass' => Attaches::className(), 'targetAttribute' => ['attaches_id' => 'id']],
            [['suggestions_id'], 'exist', 'skipOnError' => true, 'targetClass' => Suggestions::className(), 'targetAttribute' => ['suggestions_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'suggestions_id' => Yii::t('app', 'Suggestions ID'),
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
    public function getSuggestions()
    {
        return $this->hasOne(Suggestions::className(), ['id' => 'suggestions_id']);
    }

    /**
     * {@inheritdoc}
     * @return SuggestionsAttachesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SuggestionsAttachesQuery(get_called_class());
    }
}
