<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%workorder_chat}}`.
 */
class m240503_074046_create_workorder_chat_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%workorder_chat}}', [
            'id' => $this->primaryKey(),
            'workorder_id' => $this->integer(),
            'message' => $this->string(),
            'created_by' => $this->integer(),
            'message_date' => $this->datetime(),
            'read_status' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%workorder_chat}}');
    }
}
