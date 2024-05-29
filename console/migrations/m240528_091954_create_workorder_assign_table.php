<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%workorder_assign}}`.
 */
class m240528_091954_create_workorder_assign_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%workorder_assign}}', [
            'id' => $this->primaryKey(),
            'workorder_id' => $this->integer(),
            'assign_date' => $this->datetime(),
            'assign_accept_date' => $this->datetime(),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
            'status' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%workorder_assign}}');
    }
}
