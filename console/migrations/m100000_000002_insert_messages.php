<?php

use yii\db\Migration;

class m100000_000002_insert_messages extends Migration
{
    public function up()
    {
        $this->insert('{{%messages}}', [
            'slug' => 'only_users_make_order',
            'name' => 'Тільки покупці можуть робити замовлення.',
        ]);

        $this->insert('{{%messages}}', [
            'slug' => 'password_send',
            'name' => 'Пароль відправлений на пошту.',
        ]);
    }

    public function down()
    {
        echo "m170111_145807_insert_messages cannot be reverted.\n";

        return false;
    }
}
