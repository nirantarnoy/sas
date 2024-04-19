<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%asset}}`.
 */
class m240405_074302_create_asset_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%asset}}', [
            'id' => $this->primaryKey(),
            'asset_no' => $this->string(),
            'name' => $this->string(),
            'description' => $this->string(),
            'asset_cat_id' => $this->integer(),
            'asset_brand_name' => $this->string(),
            'model_no' => $this->string(),
            'serail_no' => $this->string(),
            'department_id' => $this->integer(),
            'location_id' => $this->integer(),
            'supplier_name' => $this->string(),
            'supplier_contact' => $this->string(),
            'cost' => $this->float(),
            'recieve_date' => $this->datetime(),
            'waranty_exp_date' => $this->datetime(),
            'watt' => $this->float(),
            'electric_type' => $this->string(),
            'breaker_no' => $this->string(),
            'photo' => $this->string(),
            'status' => $this->integer(),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%asset}}');
    }
}
