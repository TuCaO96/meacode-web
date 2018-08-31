<?php

use yii\db\Migration;

/**
 * Handles the creation of table `categories_attaches`.
 * Has foreign keys to the tables:
 *
 * - `categories`
 * - `attaches`
 */
class m180831_132416_create_junction_categories_and_attaches_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('categories_attaches', [
            'categories_id' => $this->integer(),
            'attaches_id' => $this->integer(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'PRIMARY KEY(categories_id, attaches_id)',
        ]);

        // creates index for column `categories_id`
        $this->createIndex(
            'idx-categories_attaches-categories_id',
            'categories_attaches',
            'categories_id'
        );

        // add foreign key for table `categories`
        $this->addForeignKey(
            'fk-categories_attaches-categories_id',
            'categories_attaches',
            'categories_id',
            'categories',
            'id',
            'CASCADE'
        );

        // creates index for column `attaches_id`
        $this->createIndex(
            'idx-categories_attaches-attaches_id',
            'categories_attaches',
            'attaches_id'
        );

        // add foreign key for table `attaches`
        $this->addForeignKey(
            'fk-categories_attaches-attaches_id',
            'categories_attaches',
            'attaches_id',
            'attaches',
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
            'fk-categories_attaches-categories_id',
            'categories_attaches'
        );

        // drops index for column `categories_id`
        $this->dropIndex(
            'idx-categories_attaches-categories_id',
            'categories_attaches'
        );

        // drops foreign key for table `attaches`
        $this->dropForeignKey(
            'fk-categories_attaches-attaches_id',
            'categories_attaches'
        );

        // drops index for column `attaches_id`
        $this->dropIndex(
            'idx-categories_attaches-attaches_id',
            'categories_attaches'
        );

        $this->dropTable('categories_attaches');
    }
}
