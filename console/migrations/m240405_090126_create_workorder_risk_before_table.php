<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%workorder_risk_before}}`.
 */
class m240405_090126_create_workorder_risk_before_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%workorder_risk_before}}', [
            'id' => $this->primaryKey(),
            'workorder_id' => $this->integer(),
            'risk_id' => $this->integer(),
            'risk_value' => $this->integer(),
            'status' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%workorder_risk_before}}');
    }
}
