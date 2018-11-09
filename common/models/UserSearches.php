<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_searches".
 *
 * @property int $id
 * @property int $user_id
 * @property string $search_query
 * @property int $created_at
 *
 * @property Users $user
 */
class UserSearches extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_searches';
    }

    public function attributes()
    {
        $attributes = parent::attributes();
        $attributes[] = 'count_query';

        return $attributes;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'created_at'], 'required'],
            [['user_id', 'created_at'], 'default', 'value' => null],
            [['user_id', 'created_at'], 'integer'],
            [['search_query'], 'string', 'max' => 255],
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
            'search_query' => Yii::t('app', 'Termo'),
            'created_at' => Yii::t('app', 'Criado Em'),
        ];
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
     * @return UserSearchesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserSearchesQuery(get_called_class());
    }
}
