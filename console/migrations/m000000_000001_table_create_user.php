<?php

use yii\db\Migration;

class m000000_000001_table_create_user extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'ID' => $this->primaryKey()->unsigned(),
            'created_at' => $this->timestamp() . ' NULL DEFAULT CURRENT_TIMESTAMP',
            'updated_at' => $this->timestamp() . ' NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'username' => $this->string()->notNull()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'email_sent' => $this->timestamp()->null()->defaultValue(null),
            'email_approved' => $this->timestamp()->null()->defaultValue(null),
            'phone' => $this->string(45)->unique()->notNull(),
            'phone_sent' => $this->timestamp()->null()->defaultValue(null),
            'phone_approved' => $this->timestamp()->null()->defaultValue(null),
            'image' => $this->string()->null()->defaultValue(null),
            'region_id' => $this->integer()->notNull()->defaultValue(0),
            'address' => $this->string()->null()->defaultValue(null),
            'status' => $this->smallInteger(6)->notNull()->defaultValue(10),
            'role' => $this->smallInteger(6)->notNull(),
            'authKey' => $this->string(32)->notNull(),
            'passwordHash' => $this->string()->notNull(),
            'passwordResetToken' => $this->string()->unique(),
            'priceDown' => $this->integer()->null()->defaultValue(null),
            'addressBookID' => $this->integer()->null()->defaultValue(null)->unique(),
            'smsCode' => $this->string(10)->null()->defaultValue(null),
            'emailCode' => $this->string(128)->null()->defaultValue(null),
            'balance' => $this->integer()->notNull()->defaultValue(0),
            'bal' => $this->integer()->notNull()->defaultValue(0)
        ], $tableOptions);

        $this->createIndex('idx-user-region_id', 'user', 'region_id');
        $this->createIndex('idx-user-address', 'user', 'address');
        $this->createIndex('idx-user-status', 'user', 'status');
        $this->createIndex('idx-user-role', 'user', 'role');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
