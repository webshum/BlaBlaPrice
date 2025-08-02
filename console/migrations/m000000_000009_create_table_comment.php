<?php

use yii\db\Migration;

class m000000_000009_create_table_comment extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%comment}}', [
            'ID' => $this->primaryKey(),
            'created_at' => $this->timestamp() . ' NULL DEFAULT CURRENT_TIMESTAMP',
            'updated_at' => $this->timestamp() . ' NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'userFromID' => $this->integer()->notNull()->unsigned(),
            'userToID' => $this->integer()->notNull()->unsigned(),
            'offerID' => $this->integer()->notNull(),
            'refuseID' => $this->integer()->null()->defaultValue(null),
            'rating' => $this->boolean()->null()->defaultValue(null),
            'comment' => $this->text()->null()->defaultValue(null)
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%comment}}');
    }
}
