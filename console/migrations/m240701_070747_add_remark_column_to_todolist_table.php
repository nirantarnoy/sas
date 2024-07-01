<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%todolist}}`.
 */
class m240701_070747_add_remark_column_to_todolist_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%todolist}}', 'remark', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%todolist}}', 'remark');
    }
}
