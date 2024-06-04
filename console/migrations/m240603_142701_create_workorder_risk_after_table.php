<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%workorder_risk_after}}`.
 */
class m240603_142701_create_workorder_risk_after_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%workorder_risk_after}}', [
            'id' => $this->primaryKey(),
            'workorder_id' => $this->integer(),
            'risk_id' => $this->integer(),
            'risk_value' => $this->float(),
            'status' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%workorder_risk_after}}');
    }
}
