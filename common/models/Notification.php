<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%notification}}".
 *
 * @property integer $ID
 * @property string $created_at
 * @property string $updated_at
 * @property integer $type
 * @property integer $objectID
 * @property integer $view
 * @property integer $userID
 */
class Notification extends \yii\db\ActiveRecord
{
    const TYPE_ORDER = 0;
    const TYPE_OFFER = 1;

    const TYPE_NEW = 0;
    const TYPE_VIEWED = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%notification}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => function () {
                    return date('Y-m-d H:i:s');
                },
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'objectID', 'view', 'userID'], 'integer'],
            [['objectID', 'userID'], 'required'],
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
            'type' => Yii::t('app', 'Type'),
            'objectID' => Yii::t('app', 'Object ID'),
            'view' => Yii::t('app', 'View'),
        ];
    }
}
