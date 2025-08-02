<?php

use yii\db\Migration;

class m250704_142115_create_table_synonym extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{synonym}}', [
            'id' => $this->primaryKey(),
            'categoryID' => $this->bigInteger(20)->notNull()->unsigned(),
            'parentID' => $this->integer()->notNull()->unsigned(),
            'synonym' => $this->string(255),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{synonym}}');
    }
}
