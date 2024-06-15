<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%todolist}}`.
 */
class m240614_022857_add_act_date_column_to_todolist_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%todolist}}', 'act_date', $this->datetime());
        $this->addColumn('{{%todolist}}', 'end_date', $this->datetime());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%todolist}}', 'act_date');
        $this->dropColumn('{{%todolist}}', 'end_date');
    }
}
