<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "asset_photo".
 *
 * @property int $id
 * @property int|null $asset_id
 * @property string|null $photo
 */
class AssetPhoto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'asset_photo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['asset_id'], 'integer'],
            [['photo'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'asset_id' => 'Asset ID',
            'photo' => 'Photo',
        ];
    }
}
