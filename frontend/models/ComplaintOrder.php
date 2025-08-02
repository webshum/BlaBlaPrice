<?php

namespace frontend\models;

use yii\db\ActiveRecord;

class ComplaintOrder extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%complaint_order}}';
    }
}
