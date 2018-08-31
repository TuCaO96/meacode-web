<?php

use yii\db\Migration;

/**
 * Handles the creation of table `contents_attaches`.
 * Has foreign keys to the tables:
 *
 * - `contents`
 * - `attaches`
 */
class m180831_132257_create_junction_contents_and_attaches_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('contents_attaches', [
            'contents_id' => $this->integer(),
            'attaches_id' => $this->integer(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'PRIMARY KEY(contents_id, attaches_id)',
        ]);

        // creates index for column `contents_id`
        $this->createIndex(
            'idx-contents_attaches-contents_id',
            'contents_attaches',
            'contents_id'
        );

        // add foreign key for table `contents`
        $this->addForeignKey(
            'fk-contents_attaches-contents_id',
            'contents_attaches',
            'contents_id',
            'contents',
            'id',
            'CASCADE'
        );

        // creates index for column `attaches_id`
        $this->createIndex(
            'idx-contents_attaches-attaches_id',
            'contents_attaches',
            'attaches_id'
        );

        // add foreign key for table `attaches`
        $this->addForeignKey(
            'fk-contents_attaches-attaches_id',
            'contents_attaches',
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
        // drops foreign key for table `contents`
        $this->dropForeignKey(
            'fk-contents_attaches-contents_id',
            'contents_attaches'
        );

        // drops index for column `contents_id`
        $this->dropIndex(
            'idx-contents_attaches-contents_id',
            'contents_attaches'
        );

        // drops foreign key for table `attaches`
        $this->dropForeignKey(
            'fk-contents_attaches-attaches_id',
            'contents_attaches'
        );

        // drops index for column `attaches_id`
        $this->dropIndex(
            'idx-contents_attaches-attaches_id',
            'contents_attaches'
        );

        $this->dropTable('contents_attaches');
    }
}
