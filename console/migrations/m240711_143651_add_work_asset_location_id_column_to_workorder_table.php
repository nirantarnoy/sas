<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%workorder}}`.
 */
class m240711_143651_add_work_asset_location_id_column_to_workorder_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%workorder}}', 'work_asset_location_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%workorder}}', 'work_asset_location_id');
    }
}
