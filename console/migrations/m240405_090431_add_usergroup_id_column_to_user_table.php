<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%user}}`.
 */
class m240405_090431_add_usergroup_id_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'usergroup_id', $this->integer());
        $this->addColumn('{{%user}}', 'emp_ref_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'usergroup_id');
        $this->dropColumn('{{%user}}', 'emp_ref_id');
    }
}
