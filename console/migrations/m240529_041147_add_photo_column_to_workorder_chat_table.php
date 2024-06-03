<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%workorder_chat}}`.
 */
class m240529_041147_add_photo_column_to_workorder_chat_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%workorder_chat}}', 'photo', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%workorder_chat}}', 'photo');
    }
}
