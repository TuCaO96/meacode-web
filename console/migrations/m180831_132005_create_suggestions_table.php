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
            'title' => $this->string(),
            'text' => $this->text(),
            'created_at' => $this->integer()->NotNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('suggestions');
    }
}
