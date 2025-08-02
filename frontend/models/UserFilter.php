<?php 

namespace frontend\models;

use yii\db\ActiveRecord;

class UserFilter extends ActiveRecord  {

    public static function tableName() {
        return '{{user_filter}}';
    }
}

?>