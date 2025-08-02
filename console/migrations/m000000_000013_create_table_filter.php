<?php

use yii\db\Migration;

class m000000_000013_create_table_filter extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%filter}}', [
            'ID' => $this->primaryKey(),
            'created_at' => $this->timestamp() . ' NULL DEFAULT CURRENT_TIMESTAMP',
            'updated_at' => $this->timestamp() . ' NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'categoryID' => $this->bigInteger(20)->notNull()->unsigned(),
            'name' => $this->string()->notNull(),
            'type' => $this->boolean(),
            'item' => $this->text(),
            'unt' => $this->text(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%filter}}');
    }
}