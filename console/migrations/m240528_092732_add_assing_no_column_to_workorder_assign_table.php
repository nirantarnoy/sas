<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%workorder_assign}}`.
 */
class m240528_092732_add_assing_no_column_to_workorder_assign_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%workorder_assign}}', 'assign_no', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%workorder_assign}}', 'assign_no');
    }
}
