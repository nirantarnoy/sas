<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%workorder}}`.
 */
class m240405_080335_create_workorder_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%workorder}}', [
            'id' => $this->primaryKey(),
            'workorder_no' => $this->string(),
            'workorder_date' => $this->datetime(),
            'asset_id' => $this->integer(),
            'assign_emp_id' => $this->integer(),
            'work_recieve_date' => $this->datetime(),
            'work_assign_date' => $this->datetime(),
            'status' => $this->integer(),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%workorder}}');
    }
}
