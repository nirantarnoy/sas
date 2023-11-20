<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%work_queue_item_line}}`.
 */
class m231115_090155_create_work_queue_item_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%work_queue_item_line}}', [
            'id' => $this->primaryKey(),
            'work_queue_id' => $this->integer(),
            'item_id' => $this->integer(),
            'description' => $this->string(),
            'status' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%work_queue_item_line}}');
    }
}
