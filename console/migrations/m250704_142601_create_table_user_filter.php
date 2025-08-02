<?php

use yii\db\Migration;

class m250704_142601_create_table_user_filter extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{user_filter}}', [
            'id' => $this->primaryKey(),
            'userID' => $this->integer()->notNull()->unsigned(),
            'filter' => $this->text(),
            'count' => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{user_filter}}');
    }
}
