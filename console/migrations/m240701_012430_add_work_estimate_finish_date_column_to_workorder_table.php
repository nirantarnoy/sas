<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%workorder}}`.
 */
class m240701_012430_add_work_estimate_finish_date_column_to_workorder_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%workorder}}', 'work_estimate_finish_date', $this->datetime());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%workorder}}', 'work_estimate_finish_date');
    }
}
