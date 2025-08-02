<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%offer_image}}".
 *
 * @property integer $ID
 * @property string $created_at
 * @property string $updated_at
 * @property integer $offerID
 * @property string $image
 */
class OfferImage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%offer_image}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['offerID'], 'integer'],
            [['image'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => Yii::t('app', 'ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'offerID' => Yii::t('app', 'Offer ID'),
            'image' => Yii::t('app', 'Image')
        ];
    }
}
