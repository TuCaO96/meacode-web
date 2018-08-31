<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "contents_attaches".
 *
 * @property int $contents_id
 * @property int $attaches_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Attaches $attaches
 * @property Contents $contents
 */
class ContentsAttaches extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contents_attaches';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['contents_id', 'attaches_id', 'created_at', 'updated_at'], 'required'],
            [['contents_id', 'attaches_id', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['contents_id', 'attaches_id', 'created_at', 'updated_at'], 'integer'],
            [['contents_id', 'attaches_id'], 'unique', 'targetAttribute' => ['contents_id', 'attaches_id']],
            [['attaches_id'], 'exist', 'skipOnError' => true, 'targetClass' => Attaches::className(), 'targetAttribute' => ['attaches_id' => 'id']],
            [['contents_id'], 'exist', 'skipOnError' => true, 'targetClass' => Contents::className(), 'targetAttribute' => ['contents_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'contents_id' => Yii::t('app', 'Contents ID'),
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
    public function getContents()
    {
        return $this->hasOne(Contents::className(), ['id' => 'contents_id']);
    }

    /**
     * {@inheritdoc}
     * @return ContentsAttachesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ContentsAttachesQuery(get_called_class());
    }
}
