<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "stock_trans".
 *
 * @property int $id
 * @property string|null $journal_no
 * @property string|null $trans_date
 * @property int|null $activity_type_id
 * @property int|null $item_id
 * @property float|null $qty
 * @property int|null $created_by
 * @property int|null $created_at
 * @property int|null $stock_type_id
 */
class StockTrans extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stock_trans';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['trans_date'], 'safe'],
            [['activity_type_id', 'item_id', 'created_by', 'created_at', 'stock_type_id'], 'integer'],
            [['qty'], 'number'],
            [['journal_no'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'journal_no' => 'Journal No',
            'trans_date' => 'Trans Date',
            'activity_type_id' => 'Activity Type ID',
            'item_id' => 'Item ID',
            'qty' => 'Qty',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'stock_type_id' => 'Stock Type ID',
        ];
    }
}
