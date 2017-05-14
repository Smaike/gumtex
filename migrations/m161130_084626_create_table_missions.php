<?php

use yii\db\Migration;

class m161130_084626_create_table_missions extends Migration
{
    public function up()
    {
        $this->createTable('missions', [
            'id' => $this->primaryKey(),
            'theme' => $this->string(255),
            'description' => $this->text(),
            'status' => $this->integer(1),
            'id_created' => $this->integer(11),
            'is_report' => $this->integer(1),
            'created_at' => $this->datetime(),
            'updated_at' => $this->datetime(),
            'updated_by' => $this->integer(11),
        ]);
        $this->createTable('files', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255),
            'filename' => $this->string(32),
            'ext' => $this->string(32),
            'created_at' => $this->datetime(),
        ]);
        $this->createTable('missions_files', [
            'id' => $this->primaryKey(),
            'id_mission' => $this->integer(11),
            'id_file' => $this->integer(11),
        ]);
        $this->createTable('missions_users', [
            'id' => $this->primaryKey(),
            'id_mission' => $this->integer(11),
            'id_user' => $this->integer(11),
        ]);
        /* На задачи-файлы */
        $this->createIndex('missions_files-id_mission', 'missions_files', 'id_mission');
        $this->createIndex('missions_files-id_file', 'missions_files', 'id_file');
        $this->addForeignKey('fk-missions_files-id_mission', 'missions_files', 'id_mission', 'missions', 'id', 'CASCADE');
        $this->addForeignKey('fk-missions_files-id_file', 'missions_files', 'id_file', 'files', 'id', 'CASCADE');
        /* На задачи-юзеры */
        $this->createIndex('missions_users-id_mission', 'missions_users', 'id_mission');
        $this->createIndex('missions_users-id_user', 'missions_users', 'id_user');
        $this->addForeignKey('fk-missions_users-id_mission', 'missions_users', 'id_mission', 'missions', 'id', 'CASCADE');
        $this->addForeignKey('fk-missions_users-id_user', 'missions_users', 'id_user', 'users', 'id', 'CASCADE');
    }

    public function down()
    {
        echo "m161130_084626_create_table_missions cannot be reverted.\n";

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
