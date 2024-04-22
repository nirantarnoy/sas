<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%asset_photo}}`.
 */
class m240422_021821_create_asset_photo_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%asset_photo}}', [
            'id' => $this->primaryKey(),
            'asset_id' => $this->integer(),
            'photo' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%asset_photo}}');
    }
}
