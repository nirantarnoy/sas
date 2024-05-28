<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%position}}`.
 */
class m240528_075941_add_is_technician_column_to_position_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%position}}', 'is_technician', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%position}}', 'is_technician');
    }
}
