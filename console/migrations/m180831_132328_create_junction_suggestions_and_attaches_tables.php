<?php

use yii\db\Migration;

/**
 * Handles the creation of table `suggestions_attaches`.
 * Has foreign keys to the tables:
 *
 * - `suggestions`
 * - `attaches`
 */
class m180831_132328_create_junction_suggestions_and_attaches_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('suggestions_attaches', [
            'suggestions_id' => $this->integer(),
            'attaches_id' => $this->integer(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'PRIMARY KEY(suggestions_id, attaches_id)',
        ]);

        // creates index for column `suggestions_id`
        $this->createIndex(
            'idx-suggestions_attaches-suggestions_id',
            'suggestions_attaches',
            'suggestions_id'
        );

        // add foreign key for table `suggestions`
        $this->addForeignKey(
            'fk-suggestions_attaches-suggestions_id',
            'suggestions_attaches',
            'suggestions_id',
            'suggestions',
            'id',
            'CASCADE'
        );

        // creates index for column `attaches_id`
        $this->createIndex(
            'idx-suggestions_attaches-attaches_id',
            'suggestions_attaches',
            'attaches_id'
        );

        // add foreign key for table `attaches`
        $this->addForeignKey(
            'fk-suggestions_attaches-attaches_id',
            'suggestions_attaches',
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
        // drops foreign key for table `suggestions`
        $this->dropForeignKey(
            'fk-suggestions_attaches-suggestions_id',
            'suggestions_attaches'
        );

        // drops index for column `suggestions_id`
        $this->dropIndex(
            'idx-suggestions_attaches-suggestions_id',
            'suggestions_attaches'
        );

        // drops foreign key for table `attaches`
        $this->dropForeignKey(
            'fk-suggestions_attaches-attaches_id',
            'suggestions_attaches'
        );

        // drops index for column `attaches_id`
        $this->dropIndex(
            'idx-suggestions_attaches-attaches_id',
            'suggestions_attaches'
        );

        $this->dropTable('suggestions_attaches');
    }
}
