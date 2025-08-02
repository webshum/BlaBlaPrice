<?php

use yii\db\Migration;
use yii\db\Schema;

class m000000_000015_create_table_user_admin extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user_admin}}', [
            'ID' => $this->primaryKey(),
            'created_at' => Schema::TYPE_TIMESTAMP . ' NULL DEFAULT CURRENT_TIMESTAMP',
            'updated_at' => Schema::TYPE_TIMESTAMP . ' NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'username' => $this->string()->notNull()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'authKey' => $this->string(32)->notNull(),
            'passwordHash' => $this->string()->notNull(),
            'passwordResetToken' => $this->string()->unique()
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%user_admin}}');
    }
}