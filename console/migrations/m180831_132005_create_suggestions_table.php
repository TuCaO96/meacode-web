<?php

use yii\db\Migration;

/**
 * Handles the creation of table `suggestions`.
 */
class m180831_132005_create_suggestions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('suggestions', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'title' => $this->string(),
            'email' => $this->string(),
            'text' => $this->text(),
            'created_at' => $this->integer()->NotNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-suggestions-user_id',
            'suggestions',
            'user_id'
        );

        // add foreign key for table `users`
        $this->addForeignKey(
            'fk-suggestions-user_id',
            'suggestions',
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
            'fk-suggestions-user_id',
            'suggestions'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-suggestions-user_id',
            'suggestions'
        );

        $this->dropTable('suggestions');
    }
}
