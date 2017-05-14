<?php

use yii\db\Migration;

class m161207_143449_create_some_directory extends Migration
{
    public function up()
    {
        $this->createTable('client_types', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
        ]);
        $this->createTable('client_categories', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
        ]);
        $this->createTable('comptuters', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50),
            'ip' => $this->string(15),
            'is_processed' => $this->integer(1),
            'is_processed_by' => $this->integer(11),
        ]);
        $this->createTable('active_days', [
            'id' => $this->primaryKey(),
            'date' => $this->date(),
            'split' => $this->string(2),
            'is_active' => $this->integer(1),
        ]);
        $this->createTable('lib_schools', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
        ]);

        $this->createIndex('comptuters-is_processed_by', 'comptuters', 'is_processed_by');
        $this->addForeignKey('fk-comptuters-is_processed_by', 'comptuters', 'is_processed_by', 'clients', 'id', 'CASCADE');
    }

    public function down()
    {
        echo "m161207_143449_create_some_directory cannot be reverted.\n";

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
