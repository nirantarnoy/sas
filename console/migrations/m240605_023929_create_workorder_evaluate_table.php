<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%workorder_evaluate}}`.
 */
class m240605_023929_create_workorder_evaluate_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%workorder_evaluate}}', [
            'id' => $this->primaryKey(),
            'workorder_id' => $this->integer(),
            'trans_date' => $this->datetime(),
            'result' => $this->string(),
            'risk_code' => $this->string(),
            'evaluate_result' => $this->integer(),
            'photo' => $this->string(),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%workorder_evaluate}}');
    }
}
