<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_searches`.
 * Has foreign keys to the tables:
 *
 * - `users`
 */
class m181020_220838_create_user_searches_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user_searches', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'search_query' => $this->string(),
            'created_at' => $this->integer()->notNull(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-user_searches-user_id',
            'user_searches',
            'user_id'
        );

        // add foreign key for table `users`
        $this->addForeignKey(
            'fk-user_searches-user_id',
            'user_searches',
            'user_id',
            'users',
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
            'fk-user_searches-user_id',
            'user_searches'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-user_searches-user_id',
            'user_searches'
        );

        $this->dropTable('user_searches');
    }
}
