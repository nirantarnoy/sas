<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "quotation_title".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class QuotationTitle extends \yii\db\ActiveRecord
{
    public $created_at_display,$created_by_display;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'quotation_title';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'created_by', 'updated_at', 'updated_by','status'], 'integer'],
            [['name', 'description'], 'string', 'max' => 255],
            [['created_by_display','created_at_display'],'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}