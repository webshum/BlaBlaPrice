<?php

use yii\db\Migration;

class m000000_000008_create_table_offer_image extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%offer_image}}', [
            'ID' => $this->primaryKey(),
            'created_at' => $this->timestamp() . ' NULL DEFAULT CURRENT_TIMESTAMP',
            'updated_at' => $this->timestamp() . ' NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'offerID' => $this->integer()->notNull(),
            'image' => $this->string()->notNull()
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%offer}}');
    }
}
