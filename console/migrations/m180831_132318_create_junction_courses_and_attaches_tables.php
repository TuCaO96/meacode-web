<?php

use yii\db\Migration;

/**
 * Handles the creation of table `courses_attaches`.
 * Has foreign keys to the tables:
 *
 * - `courses`
 * - `attaches`
 */
class m180831_132318_create_junction_courses_and_attaches_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('courses_attaches', [
            'courses_id' => $this->integer(),
            'attaches_id' => $this->integer(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'PRIMARY KEY(courses_id, attaches_id)',
        ]);

        // creates index for column `courses_id`
        $this->createIndex(
            'idx-courses_attaches-courses_id',
            'courses_attaches',
            'courses_id'
        );

        // add foreign key for table `courses`
        $this->addForeignKey(
            'fk-courses_attaches-courses_id',
            'courses_attaches',
            'courses_id',
            'courses',
            'id',
            'CASCADE'
        );

        // creates index for column `attaches_id`
        $this->createIndex(
            'idx-courses_attaches-attaches_id',
            'courses_attaches',
            'attaches_id'
        );

        // add foreign key for table `attaches`
        $this->addForeignKey(
            'fk-courses_attaches-attaches_id',
            'courses_attaches',
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
        // drops foreign key for table `courses`
        $this->dropForeignKey(
            'fk-courses_attaches-courses_id',
            'courses_attaches'
        );

        // drops index for column `courses_id`
        $this->dropIndex(
            'idx-courses_attaches-courses_id',
            'courses_attaches'
        );

        // drops foreign key for table `attaches`
        $this->dropForeignKey(
            'fk-courses_attaches-attaches_id',
            'courses_attaches'
        );

        // drops index for column `attaches_id`
        $this->dropIndex(
            'idx-courses_attaches-attaches_id',
            'courses_attaches'
        );

        $this->dropTable('courses_attaches');
    }
}
