<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%location_photo}}`.
 */
class m240628_094254_create_location_photo_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%location_photo}}', [
            'id' => $this->primaryKey(),
            'location_id' => $this->integer(),
            'loc_photo' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%location_photo}}');
    }
}
