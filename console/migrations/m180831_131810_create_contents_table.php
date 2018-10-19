<?php

use yii\db\Migration;

/**
 * Handles the creation of table `contents`.
 * Has foreign keys to the tables:
 *
 * - `users`
 * - `courses`
 */
class m180831_131810_create_contents_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('contents', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'text' => $this->text(),
            'paid' => $this->boolean()->defaultValue(false),
            'user_id' => $this->integer()->notNull(),
            'course_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-contents-user_id',
            'contents',
            'user_id'
        );

        // add foreign key for table `users`
        $this->addForeignKey(
            'fk-contents-user_id',
            'contents',
            'user_id',
            'users',
            'id',
            'CASCADE'
        );

        // creates index for column `course_id`
        $this->createIndex(
            'idx-contents-course_id',
            'contents',
            'course_id'
        );

        // add foreign key for table `courses`
        $this->addForeignKey(
            'fk-contents-course_id',
            'contents',
            'course_id',
            'courses',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `users`
        $this->dropForeignKey(
            'fk-contents-user_id',
            'contents'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-contents-user_id',
            'contents'
        );

        // drops foreign key for table `courses`
        $this->dropForeignKey(
            'fk-contents-course_id',
            'contents'
        );

        // drops index for column `course_id`
        $this->dropIndex(
            'idx-contents-course_id',
            'contents'
        );

        $this->dropTable('contents');
    }
}
