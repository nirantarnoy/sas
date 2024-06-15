<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%todolist}}`.
 */
class m240613_141737_add_status_column_to_todolist_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%todolist}}', 'status', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%todolist}}', 'status');
    }
}
