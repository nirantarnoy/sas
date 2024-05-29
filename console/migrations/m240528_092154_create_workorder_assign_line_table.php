<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%workorder_assign_line}}`.
 */
class m240528_092154_create_workorder_assign_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%workorder_assign_line}}', [
            'id' => $this->primaryKey(),
            'workorder_assign_id' => $this->integer(),
            'emp_id' => $this->integer(),
            'emp_message' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%workorder_assign_line}}');
    }
}
