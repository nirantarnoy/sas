<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%workorder_photo}}`.
 */
class m240405_080902_create_workorder_photo_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%workorder_photo}}', [
            'id' => $this->primaryKey(),
            'workorder_id' => $this->integer(),
            'photo' => $this->string(),
            'status' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%workorder_photo}}');
    }
}
