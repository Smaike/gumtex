<?php

use yii\db\Migration;

class m161123_071503_create_table_users extends Migration
{
    public function up()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string(60),
            'last_name' => $this->string(60),
            'middle_name' => $this->string(60),
            'email' => $this->string(60),
            'login' => $this->string(60),
            'password' => $this->string(20),
            'type' => $this->integer(2),
            'is_active' => $this->integer(1)->defaultValue(1),
            'is_notice' => $this->integer(1)->defaultValue(0),
            'authkey' => $this->string(60),
            'sessionkey' => $this->string(60),
            'created_at' => $this->datetime(),
            'updated_at' => $this->datetime(),
            'password_hash' => $this->string(255),
        ]);
        $this->createTable('user_types', [
            'id' => $this->primaryKey(),
            'name' => $this->string(60),
        ]);
        $this->createIndex('users-type', 'users', 'type');
        $this->addForeignKey('fk-users-type', 'users', 'type', 'user_types', 'id', 'CASCADE');
    }

    public function down()
    {
        echo "m161123_071503_create_table_services cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
