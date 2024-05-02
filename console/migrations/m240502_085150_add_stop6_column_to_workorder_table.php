<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%workorder}}`.
 */
class m240502_085150_add_stop6_column_to_workorder_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%workorder}}', 'stop6', $this->string());
        $this->addColumn('{{%workorder}}', 'abnormal', $this->integer());
        $this->addColumn('{{%workorder}}', 'view_point', $this->integer());
        $this->addColumn('{{%workorder}}', 'work_cause_id', $this->integer());
        $this->addColumn('{{%workorder}}', 'weak_point_analysis', $this->integer());
        $this->addColumn('{{%workorder}}', 'cause_risk_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%workorder}}', 'stop6');
        $this->dropColumn('{{%workorder}}', 'abnormal');
        $this->dropColumn('{{%workorder}}', 'view_point');
        $this->dropColumn('{{%workorder}}', 'work_cause_id');
        $this->dropColumn('{{%workorder}}', 'weak_point_analysis');
        $this->dropColumn('{{%workorder}}', 'cause_risk_id');
    }
}
