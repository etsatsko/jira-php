<?php

use yii\db\Migration;

/**
 * Class m290521022109_db
 */
class m290521_000209_db extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'login' => $this->string(150)->notNull()->unique(),
            'email' => $this->string(150)->notNull(),
            'password' => $this->string(150)->notNull(),
            'create_date'=> $this->dateTime(),
        ]);

        $this->createTable('{{%type}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(150)->notNull(),
        ]);

        $this->createTable('{{%status}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(150)->notNull(),
        ]);
        $this->createTable('{{%service_class}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(150)->notNull(),
        ]);

        $this->createTable('{{%task}}', [
            'id' => $this->primaryKey(),
            'type' => $this->integer()->notNull(),
            'title' => $this->string(150)->notNull(),
            'description' => $this->string(150)->notNull(),
            'status'=> $this->string(150)->notNull(),
            'author_id'=> $this->integer()->notNull(),
            'executor_id' => $this->integer()->notNull(),
            'create_date'=> $this->dateTime()->notNull(),
            'deadline'=> $this->dateTime()->notNull(),
            'time_estimate'=> $this->integer()->notNull(),
            'service_class'=> $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-task-author_id',
            'task',
            'author_id'
        );

        $this->createIndex(
            'idx-task-executor_id',
            'task',
            'executor_id'
        );

        $this->createIndex(
            'idx-task-type',
            'task',
            'type'
        );

        $this->createIndex(
            'idx-task-service_class',
            'task',
            'service_class'
        );

        $this->addForeignKey(
            'fk-task-author_id',
            'task',
            'author_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-task-executor_id',
            'task',
            'executor_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-task-type',
            'task',
            'type',
            'type',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-task-service_class',
            'task',
            'service_class',
            'service_class',
            'id',
            'CASCADE'
        );

        $this->createTable('{{%comment}}', [
            'id' => $this->primaryKey(),
            'task_id' => $this->integer()->notNull(),
            'author_id' => $this->integer()->notNull(),
            'text' => $this->string(150)->notNull(),
            'create_date'=> $this->dateTime(),
        ]);

        $this->createIndex(
            'idx-comment-author_id',
            'comment',
            'author_id'
        );

        $this->createIndex(
            'idx-comment-task_id',
            'comment',
            'task_id'
        );

        $this->addForeignKey(
            'fk-comment-author_id',
            'comment',
            'author_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-comment-task_id',
            'comment',
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
        $this->dropTable('{{%user}}');

        $this->dropTable('{{%type}}');

        $this->dropTable('{{%status}}');

        $this->dropTable('{{%service_class}}');

        $this->dropForeignKey(
            'fk-task-author_id',
            'task'
        );

        $this->dropIndex(
            'idx-task-author_id',
            'task'
        );

        $this->dropForeignKey(
            'fk-task-executor_id',
            'task'
        );

        $this->dropIndex(
            'idx-task-executor_id',
            'task'
        );

        $this->dropForeignKey(
            'fk-task-type',
            'task'
        );

        $this->dropIndex(
            'idx-task-type',
            'task'
        );

        $this->dropForeignKey(
            'fk-task-service_class',
            'task'
        );

        $this->dropIndex(
            'idx-task-service_class',
            'task'
        );

        $this->dropTable('{{%task}}');

        $this->dropForeignKey(
            'fk-comment-author_id',
            'comment'
        );

        $this->dropIndex(
            'idx-comment-author_id',
            'comment'
        );

        $this->dropForeignKey(
            'fk-comment-task_id',
            'comment'
        );

        $this->dropIndex(
            'idx-comment-task_id',
            'comment'
        );

        $this->dropTable('{{%comment}}');
    }
}