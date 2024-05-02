<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%workorder}}`.
 */
class m240502_141550_add_factor_risk_1_column_to_workorder_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%workorder}}', 'factor_risk_1', $this->float());
        $this->addColumn('{{%workorder}}', 'factor_risk_2', $this->float());
        $this->addColumn('{{%workorder}}', 'factor_risk_3', $this->float());
        $this->addColumn('{{%workorder}}', 'factor_total', $this->float());
        $this->addColumn('{{%workorder}}', 'factor_risk_final', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%workorder}}', 'factor_risk_1');
        $this->dropColumn('{{%workorder}}', 'factor_risk_2');
        $this->dropColumn('{{%workorder}}', 'factor_risk_3');
        $this->dropColumn('{{%workorder}}', 'factor_total');
        $this->dropColumn('{{%workorder}}', 'factor_risk_final');
    }
}
