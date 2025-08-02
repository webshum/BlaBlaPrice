<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%filter}}".
 *
 * @property integer $ID
 * @property string $created_at
 * @property string $updated_at
 * @property integer $categoryID
 * @property string $name
 * @property integer $type
 * @property string $item
 */
class Filter extends \yii\db\ActiveRecord
{
    const TYPE_COMBO = 0;
    const TYPE_CHECK = 1;
    const TYPE_RANGE = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%filter}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['categoryID', 'type'], 'integer'],
            [['item'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['created_at', 'updated_at'], 'safe']
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
            'categoryID' => Yii::t('app', 'Category ID'),
            'name' => Yii::t('app', 'Name'),
            'type' => Yii::t('app', 'Type'),
            'item' => Yii::t('app', 'Item')
        ];
    }
}
