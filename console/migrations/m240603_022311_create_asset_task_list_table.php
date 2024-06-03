<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%asset_task_list}}`.
 */
class m240603_022311_create_asset_task_list_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%asset_task_list}}', [
            'id' => $this->primaryKey(),
            'asset_id' => $this->integer(),
            'seq_no' => $this->integer(),
            'todo_name' => $this->string(),
            'todo_description' => $this->string(),
            'status' => $this->integer(),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%asset_task_list}}');
    }
}
