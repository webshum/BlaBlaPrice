<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%product}}".
 *
 * @property integer $ID
 * @property integer $categoryID
 * @property integer $parentID
 * @property string $synonym
 *
 * @property Category $category
 */
class Synonym extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%synonym}}';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['ID' => 'categoryID', 'parentID' => 'parentID']);
    }
    
    /**
     * @return int
     */
    public function getId()
    {
        return $this->ID;
    }
    
    /**
     * @return int
     */
    public function getParentId()
    {
        return $this->parentID;
    }

    /**
     * @return int
     */
    public function getCategoryId()
    {
        return $this->categoryID;
    }
}
