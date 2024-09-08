<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%task}}`.
 */
class m240908_062945_create_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%task}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'description' => $this->text(),
            'due_date' => $this->integer()->notNull(),
            'status' => $this->tinyInteger()->notNull()->defaultValue(0),
            'priority' => $this->tinyInteger()->notNull()->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%task}}');
    }
}
