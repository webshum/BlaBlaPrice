<?php

use yii\db\Migration;

class m250704_140939_create_table_complaint_order extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{complaint_order}}', [
            'id' => $this->primaryKey(),
            'userID' => $this->integer()->notNull()->unsigned(),
            'sellerID' => $this->integer()->notNull()->unsigned(),
            'orderID' => $this->integer()->notNull()->unsigned(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{complaint_order}}');
    }
}
