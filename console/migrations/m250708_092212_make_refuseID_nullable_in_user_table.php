<?php

use yii\db\Migration;

class m250708_092212_make_refuseID_nullable_in_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('order', 'refuseID', $this->integer()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('order', 'refuseID', $this->integer()->notNull());
    }
}
