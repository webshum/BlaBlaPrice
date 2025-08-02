<?php

use yii\db\Migration;

class m000000_000002_table_create_category extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%category}}', [
            'ID' => $this->bigInteger(20)->notNull()->unsigned(),
            'created_at' => $this->timestamp() . ' NULL DEFAULT CURRENT_TIMESTAMP',
            'updated_at' => $this->timestamp() . ' NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'parentID' => $this->bigInteger(20)->null()->defaultValue(null),
            'primary_category_id' => $this->bigInteger(20)->null()->defaultValue(null),
            'name' => $this->string()->notNull(),
            'seolink' => $this->string()->null(),
            'price' => $this->integer()->notNull()->defaultValue(0)
        ], $tableOptions);

        $this->createIndex('idx-category-id', '{{%category}}', 'ID');
        $this->createIndex('idx-category-parentid', '{{%category}}', 'parentID');
        $this->createIndex('idx-category-primary_category_id', '{{%category}}', 'primary_category_id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%category}}');
    }
}
