<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%workassign_todo_list}}`.
 */
class m240603_022750_create_workassign_todo_list_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%workassign_todo_list}}', [
            'id' => $this->primaryKey(),
            'workorder_id' => $this->integer(),
            'workorder_assign_id' => $this->integer(),
            'asset_id' => $this->integer(),
            'todo_list_id' => $this->integer(),
            'work_title' => $this->string(),
            'target_date' => $this->datetime(),
            'emp_id' => $this->integer(),
            'status' => $this->integer(),
            'remark' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%workassign_todo_list}}');
    }
}
