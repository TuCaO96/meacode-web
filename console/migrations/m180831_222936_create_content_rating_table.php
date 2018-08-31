<?php

use yii\db\Migration;

/**
 * Handles the creation of table `content_rating`.
 * Has foreign keys to the tables:
 *
 * - `users`
 * - `contents`
 */
class m180831_222936_create_content_rating_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('content_rating', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'content_id' => $this->integer()->notNull(),
            'score' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-content_rating-user_id',
            'content_rating',
            'user_id'
        );

        // add foreign key for table `users`
        $this->addForeignKey(
            'fk-content_rating-user_id',
            'content_rating',
            'user_id',
            'users',
            'id',
            'CASCADE'
        );

        // creates index for column `content_id`
        $this->createIndex(
            'idx-content_rating-content_id',
            'content_rating',
            'content_id'
        );

        // add foreign key for table `contents`
        $this->addForeignKey(
            'fk-content_rating-content_id',
            'content_rating',
            'content_id',
            'contents',
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
            'fk-content_rating-user_id',
            'content_rating'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-content_rating-user_id',
            'content_rating'
        );

        // drops foreign key for table `contents`
        $this->dropForeignKey(
            'fk-content_rating-content_id',
            'content_rating'
        );

        // drops index for column `content_id`
        $this->dropIndex(
            'idx-content_rating-content_id',
            'content_rating'
        );

        $this->dropTable('content_rating');
    }
}
