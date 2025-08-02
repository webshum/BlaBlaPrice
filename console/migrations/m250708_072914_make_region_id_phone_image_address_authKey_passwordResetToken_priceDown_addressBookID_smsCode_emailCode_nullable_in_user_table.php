<?php

use yii\db\Migration;

class m250708_072914_make_region_id_phone_image_address_authKey_passwordResetToken_priceDown_addressBookID_smsCode_emailCode_nullable_in_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('user', 'region_id', $this->integer()->null());
        $this->alterColumn('user', 'phone', $this->string()->null());
        $this->alterColumn('user', 'image', $this->string()->null());
        $this->alterColumn('user', 'address', $this->string()->null());
        $this->alterColumn('user', 'authKey', $this->string()->null());
        $this->alterColumn('user', 'passwordResetToken', $this->string()->null());
        $this->alterColumn('user', 'priceDown', $this->integer()->defaultValue(0));
        $this->alterColumn('user', 'addressBookID', $this->integer()->defaultValue(0));
        $this->alterColumn('user', 'smsCode', $this->string()->null());
        $this->alterColumn('user', 'emailCode', $this->string()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('user', 'region_id', $this->integer()->notNull());
        $this->alterColumn('user', 'phone', $this->string()->notNull());
        $this->alterColumn('user', 'image', $this->string()->notNull());
        $this->alterColumn('user', 'address', $this->string()->notNull());
        $this->alterColumn('user', 'authKey', $this->string()->notNull());
        $this->alterColumn('user', 'passwordResetToken', $this->string()->notNull());
        $this->alterColumn('user', 'priceDown', $this->integer()->defaultValue(0));
        $this->alterColumn('user', 'addressBookID', $this->integer()->defaultValue(0));
        $this->alterColumn('user', 'smsCode', $this->string()->notNull());
        $this->alterColumn('user', 'emailCode', $this->string()->notNull());
    }
}
