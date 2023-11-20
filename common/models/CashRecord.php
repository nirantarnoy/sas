<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cash_record".
 *
 * @property int $id
 * @property string|null $journal_no
 * @property string|null $trans_date
 * @property int|null $car_id
 * @property int|null $car_tail_id
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $create_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class CashRecord extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cash_record';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['trans_date'], 'safe'],
            [['car_id', 'car_tail_id', 'status', 'created_at', 'create_by', 'updated_at', 'updated_by'], 'integer'],
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
            'car_id' => 'Car ID',
            'car_tail_id' => 'Car Tail ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'create_by' => 'Create By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
