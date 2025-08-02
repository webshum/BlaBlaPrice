<?php

use yii\db\Migration;

class m000000_000006_create_table_notification extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        // table `notification`
        $this->createTable('{{%notification}}', [
            'ID' => $this->primaryKey(),
            'created_at' => $this->timestamp() . ' NULL DEFAULT CURRENT_TIMESTAMP',
            'updated_at' => $this->timestamp() . ' NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'type' => $this->boolean(),
            'objectID' => $this->integer(),
            'view' => $this->boolean(),
            'userID' => $this->integer()->notNull()->unsigned()
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%notification}}');
    }
}
