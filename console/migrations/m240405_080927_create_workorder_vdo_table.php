<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%workorder_vdo}}`.
 */
class m240405_080927_create_workorder_vdo_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%workorder_vdo}}', [
            'id' => $this->primaryKey(),
            'workorder_id' => $this->integer(),
            'file_name' => $this->string(),
            'status' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%workorder_vdo}}');
    }
}
