<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%workorder_close}}`.
 */
class m240604_225014_create_workorder_close_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%workorder_close}}', [
            'id' => $this->primaryKey(),
            'workorder_id' => $this->integer(),
            'trans_date' => $this->datetime(),
            'cause_id' => $this->integer(),
            'solve_id' => $this->integer(),
            'labour_cost' => $this->float(),
            'spare_cost' => $this->float(),
            'time_use' => $this->string(),
            'preventive_text' => $this->string(),
            'photo' => $this->string(),
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
        $this->dropTable('{{%workorder_close}}');
    }
}
