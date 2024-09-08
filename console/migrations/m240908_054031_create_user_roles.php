<?php

use yii\db\Migration;

final class m240908_054031_create_user_roles extends Migration
{
    public function safeUp(): void
    {
        $this->batchInsert('{{%auth_item}}', ['type', 'name', 'description'], [
            [1, 'user', 'User'],
            [1, 'admin', 'Admin'],
        ]);

        $this->batchInsert('{{%auth_item_child}}', ['parent', 'child'], [
            ['admin', 'user'],
        ]);

        $this->execute('INSERT INTO {{%auth_assignment}} (item_name, user_id) SELECT \'user\', u.id FROM {{%user}} u ORDER BY u.id');
    }

    public function down(): void
    {
        $this->delete('{{%auth_item}}', ['name' => ['user', 'admin']]);
    }
}
