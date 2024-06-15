<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%todolist}}`.
 */
class m240613_135023_create_todolist_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%todolist}}', [
            'id' => $this->primaryKey(),
            'todolist_no' => $this->string(),
            'trans_date' => $this->datetime(),
            'machine_name' => $this->string(),
            'machine_type_name' => $this->string(),
            'brand_name' => $this->string(),
            'todolist_name' => $this->string(),
            'assign_emp_id' => $this->integer(),
            'target_date' => $this->datetime(),
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
        $this->dropTable('{{%todolist}}');
    }
}
