<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use common\models\Product;

/**
 * This is the model class for table "{{%category}}".
 *
 * @property integer $ID
 * @property string $created_at
 * @property string $updated_at
 * @property integer $parentID
 * @property integer $primary_category_id
 * @property string $name
 * @property string $seolink
 *
 * @property Filter[] $filters
 * @property Order[] $orders
 * @property User2category[] $user2categories
 * @property Category[] subCategory
 * @property array $breadcrumb
 * @property string $icon
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%category}}';
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
            [['parentID', 'primary_category_id'], 'integer'],
            [['name', 'seolink'], 'string', 'max' => 255],
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
            'parentID' => Yii::t('app', 'Parent ID'),
            'primary_category_id' => Yii::t('app', 'Primary category id'),
            'name' => Yii::t('app', 'Name'),
            'seolink' => Yii::t('app', 'Seolink')
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFilters()
    {
        return $this->hasMany(Filter::className(), ['categoryID' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['categoryID' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser2categories()
    {
        return $this->hasMany(User2category::className(), ['categoryID' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubCategory()
    {
        return $this->hasMany(self::className(), ['parentID' => 'ID']);
    }

    /**
     * @param $id integer
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBreadcrumb($id)
    {
        return $this->categoryBreadcrumb($id);
    }

    /**
     * @param $id integer
     * @param $breadcrumb array
     *
     * @return \yii\db\ActiveQuery
     */
    public function categoryBreadcrumb($id, $breadcrumb = [])
    {
        if ($id && $id != 0) {
            $category = Category::findOne(['ID' => $id]);
            $breadcrumb[$category->ID] = $category->name;
            return $this->categoryBreadcrumb($category->parentID, $breadcrumb);
        } else {
            return $breadcrumb;
        }
    }

    public function getIcon()
    {
        return Yii::$app->params['icons'][self::findOne(['ID' => $this->primary_category_id])->name];
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->ID;
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param $createdAt
     * @return Category
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
        return $this;
    }

    /**
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @param $updatedAt
     * @return Comment
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;
        return $this;
    }

    /**
     * @return int
     */
    public function getParentId()
    {
        return $this->parentID;
    }

    /**
     * @param int|null $parentId
     * @return Category
     */
    public function setParentId($parentId)
    {
        $this->parentID = $parentId;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    public static function getCategories() {
        $popularCategories = Category::find()
            ->select(['*'])
            ->asArray()
            ->limit(4)
            ->all();

        return $popularCategories;
    }
}
