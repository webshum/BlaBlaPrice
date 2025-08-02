<?php

use yii\db\Migration;
use common\models\UserAdmin;

class m100000_000001_add_admin_user extends Migration
{
    public function up()
    {
        $user = new UserAdmin();

        $user->username = 'admin';
        $user->email = 'admin@blablaprice.dev';
        $user->setPassword('admin_access');
        $user->generateAuthKey();
        $user->save();
    }

    public function down()
    {
        UserAdmin::deleteAll(['email' => 'admin@blablaprice.dev']);

        //echo "m160726_073352_add_admin_user cannot be reverted.\n";
        return false;
    }
}
