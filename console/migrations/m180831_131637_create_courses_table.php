<?php

use yii\db\Migration;

/**
 * Handles the creation of table `courses`.
 * Has foreign keys to the tables:
 *
 * - `categories`
 */
class m180831_131637_create_courses_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('courses', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'image_url' => $this->string(),
            'category_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        // creates index for column `category_id`
        $this->createIndex(
            'idx-courses-category_id',
            'courses',
            'category_id'
        );

        // add foreign key for table `categories`
        $this->addForeignKey(
            'fk-courses-category_id',
            'courses',
            'category_id',
            'categories',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `categories`
        $this->dropForeignKey(
            'fk-courses-category_id',
            'courses'
        );

        // drops index for column `category_id`
        $this->dropIndex(
            'idx-courses-category_id',
            'courses'
        );

        $this->dropTable('courses');
    }
}
