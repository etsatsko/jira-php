<?php

use yii\db\Migration;

/**
 * Class m300617_035631_add_work_cost
 */
class m300617_035631_add_work_cost extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%work_cost}}', [
            'id' => $this->primaryKey(),
            'task_id' => $this->integer()->notNull(),
            'author_id' => $this->integer()->notNull(),
            'time' => $this->integet()->notNull(),
            'comment' => $this->string(150)->notNull(),
            'create_date'=> $this->dateTime(),
        ]);

        $this->createIndex(
            'idx-work_cost-author_id',
            'work_cost',
            'author_id'
        );

        $this->createIndex(
            'idx-work_cost-task_id',
            'work_cost',
            'task_id'
        );

        $this->addForeignKey(
            'fk-work_cost-author_id',
            'work_cost',
            'author_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-work_cost-task_id',
            'work_cost',
            'task_id',
            'task',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-work_cost-author_id',
            'work_cost'
        );

        $this->dropIndex(
            'idx-work_cost-author_id',
            'work_cost'
        );

        $this->dropForeignKey(
            'fk-work_cost-task_id',
            'work_cost'
        );

        $this->dropIndex(
            'idx-work_cost-task_id',
            'work_cost'
        );

        $this->dropTable('{{%work_cost}}');
    }
}
