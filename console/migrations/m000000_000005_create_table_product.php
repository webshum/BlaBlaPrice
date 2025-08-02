<?php

use yii\db\Migration;

class m000000_000005_create_table_product extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%product}}', [
            'ID' => $this->primaryKey(),
            'created_at' => $this->timestamp() . ' NULL DEFAULT CURRENT_TIMESTAMP',
            'updated_at' => $this->timestamp() . ' NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'categoryID' => $this->bigInteger(20)->notNull()->unsigned(),
            'name' => $this->string()->notNull(),
            'link' => $this->string()->null(),
            'image' => $this->text()->null(),
            'description' => $this->text()->null(),
            'price' => $this->decimal(11, 2)->null()->defaultValue(null),
            'USD' => $this->decimal(11, 2)->null()->defaultValue(null),
        ], $tableOptions);

        $this->createIndex('product_name_index', '{{%product}}', 'name');
    }

    public function down()
    {
        $this->dropTable('{{%product}}');
    }
}
