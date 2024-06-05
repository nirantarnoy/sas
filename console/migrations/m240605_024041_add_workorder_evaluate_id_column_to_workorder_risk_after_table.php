<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%workorder_risk_after}}`.
 */
class m240605_024041_add_workorder_evaluate_id_column_to_workorder_risk_after_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%workorder_risk_after}}', 'workorder_evaluate_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%workorder_risk_after}}', 'workorder_evaluate_id');
    }
}
