<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "categories_attaches".
 *
 * @property int $categories_id
 * @property int $attaches_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Attaches $attaches
 * @property Categories $categories
 */
class CategoriesAttaches extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categories_attaches';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['categories_id', 'attaches_id', 'created_at', 'updated_at'], 'required'],
            [['categories_id', 'attaches_id', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['categories_id', 'attaches_id', 'created_at', 'updated_at'], 'integer'],
            [['categories_id', 'attaches_id'], 'unique', 'targetAttribute' => ['categories_id', 'attaches_id']],
            [['attaches_id'], 'exist', 'skipOnError' => true, 'targetClass' => Attaches::className(), 'targetAttribute' => ['attaches_id' => 'id']],
            [['categories_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['categories_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'categories_id' => Yii::t('app', 'Categories ID'),
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
    public function getCategories()
    {
        return $this->hasOne(Categories::className(), ['id' => 'categories_id']);
    }

    /**
     * {@inheritdoc}
     * @return CategoriesAttachesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CategoriesAttachesQuery(get_called_class());
    }
}
