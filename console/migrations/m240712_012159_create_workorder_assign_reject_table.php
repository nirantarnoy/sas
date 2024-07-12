<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%workorder_assign_reject}}`.
 */
class m240712_012159_create_workorder_assign_reject_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%workorder_assign_reject}}', [
            'id' => $this->primaryKey(),
            'workorder_id' => $this->integer(),
            'trans_date' => $this->datetime(),
            'emp_id' => $this->integer(),
            'reason' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%workorder_assign_reject}}');
    }
}
