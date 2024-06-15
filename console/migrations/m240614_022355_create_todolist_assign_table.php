<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%todolist_assign}}`.
 */
class m240614_022355_create_todolist_assign_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%todolist_assign}}', [
            'id' => $this->primaryKey(),
            'todolist_id' => $this->integer(),
            'emp_id' => $this->integer(),
            'status' => $this->integer(),
            'remark' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%todolist_assign}}');
    }
}
