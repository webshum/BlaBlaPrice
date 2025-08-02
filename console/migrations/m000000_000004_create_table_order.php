<?php

use yii\db\Migration;

class m000000_000004_create_table_order extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%order}}', [
            'ID' => $this->primaryKey(),
            'created_at' => $this->timestamp() . ' NULL DEFAULT CURRENT_TIMESTAMP',
            'updated_at' => $this->timestamp() . ' NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'primary_categoryID' => $this->bigInteger(20)->notNull()->unsigned(),
            'parentID' => $this->bigInteger(20)->notNull()->unsigned(),
            'categoryID' => $this->bigInteger(20)->notNull()->unsigned(),
            'userID' => $this->integer()->notNull()->unsigned(),
            'productID' => $this->integer()->null()->defaultValue(null),
            'regionID' => $this->integer()->null(),
            'filter' => $this->text()->null(),
            'refuseID' => $this->integer()->notNull()->defaultValue(0),
            'comment' => $this->text()->null(),
            'priceFrom' => $this->decimal(11, 2),
            'priceTo' => $this->decimal(11, 2)->null()->defaultValue(null),
            'deadLine' => $this->dateTime(),
            'status' => $this->boolean()->null()->defaultValue(null),
            'send' => $this->integer()->null()->defaultValue(null)
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%order}}');
    }
}