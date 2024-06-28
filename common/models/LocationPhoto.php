<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "location_photo".
 *
 * @property int $id
 * @property int|null $location_id
 * @property string|null $loc_photo
 */
class LocationPhoto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'location_photo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['location_id'], 'integer'],
            [['loc_photo'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'location_id' => 'Location ID',
            'loc_photo' => 'Loc Photo',
        ];
    }
}
