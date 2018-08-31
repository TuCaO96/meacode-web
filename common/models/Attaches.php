<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "attaches".
 *
 * @property int $id
 * @property string $name
 * @property string $path
 * @property string $url
 * @property string $mime_type
 * @property int $created_at
 * @property int $updated_at
 *
 * @property CategoriesAttaches[] $categoriesAttaches
 * @property Categories[] $categories
 * @property ContentsAttaches[] $contentsAttaches
 * @property Contents[] $contents
 * @property CoursesAttaches[] $coursesAttaches
 * @property Courses[] $courses
 * @property SuggestionsAttaches[] $suggestionsAttaches
 * @property Suggestions[] $suggestions
 */
class Attaches extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'attaches';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at'], 'default', 'value' => null],
            [['created_at', 'updated_at'], 'integer'],
            [['name', 'path', 'url', 'mime_type'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'path' => Yii::t('app', 'Path'),
            'url' => Yii::t('app', 'Url'),
            'mime_type' => Yii::t('app', 'Mime Type'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoriesAttaches()
    {
        return $this->hasMany(CategoriesAttaches::className(), ['attaches_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Categories::className(), ['id' => 'categories_id'])->viaTable('categories_attaches', ['attaches_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContentsAttaches()
    {
        return $this->hasMany(ContentsAttaches::className(), ['attaches_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContents()
    {
        return $this->hasMany(Contents::className(), ['id' => 'contents_id'])->viaTable('contents_attaches', ['attaches_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCoursesAttaches()
    {
        return $this->hasMany(CoursesAttaches::className(), ['attaches_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourses()
    {
        return $this->hasMany(Courses::className(), ['id' => 'courses_id'])->viaTable('courses_attaches', ['attaches_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuggestionsAttaches()
    {
        return $this->hasMany(SuggestionsAttaches::className(), ['attaches_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuggestions()
    {
        return $this->hasMany(Suggestions::className(), ['id' => 'suggestions_id'])->viaTable('suggestions_attaches', ['attaches_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return AttachesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AttachesQuery(get_called_class());
    }
}
