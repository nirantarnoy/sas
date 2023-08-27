<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "car_loan_trans".
 *
 * @property int $id
 * @property int|null $car_loan_id
 * @property string|null $trans_date
 * @property int|null $period_no
 * @property float|null $loan_pay_amt
 * @property int|null $status
 */
class CarLoanTrans extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'car_loan_trans';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['car_loan_id', 'period_no', 'status'], 'integer'],
            [['trans_date','doc'], 'safe'],
            [['loan_pay_amt'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'car_loan_id' => 'Car Loan ID',
            'trans_date' => 'Trans Date',
            'period_no' => 'Period No',
            'loan_pay_amt' => 'Loan Pay Amt',
            'doc' => 'Doc',
            'status' => 'Status',
        ];
    }
}
