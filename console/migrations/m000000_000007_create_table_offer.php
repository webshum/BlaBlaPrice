<?php

use yii\db\Migration;

class m000000_000007_create_table_offer extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%offer}}', [
            'ID' => $this->primaryKey(),
            'created_at' => $this->timestamp() . ' NULL DEFAULT CURRENT_TIMESTAMP',
            'updated_at' => $this->timestamp() . ' NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'userID' => $this->integer()->notNull()->unsigned(),
            'categoryID' => $this->integer()->notNull(),
            'orderID' => $this->integer()->notNull(),
            'price' => $this->decimal(11, 2),
            'comment' => $this->text(),
            'image' => $this->string(),
            'accepted' => $this->dateTime(),
            'oldPrice' => $this->string(),
            'status' => $this->boolean(),
            'paid' => $this->boolean()
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%offer}}');
    }
}
