<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%employee}}`.
 */
class m231213_044345_add_cost_living_price_column_to_employee_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%employee}}', 'cost_living_price', $this->float());
        $this->addColumn('{{%employee}}', 'social_price', $this->float());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%employee}}', 'cost_living_price');
        $this->dropColumn('{{%employee}}', 'social_price');
    }
}
