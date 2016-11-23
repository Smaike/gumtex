<?php

use yii\db\Migration;

class m161123_073109_create_table_services extends Migration
{
    public function up()
    {
        $this->createTable('services', [
            'id' => $this->primaryKey(),
            'name' => $this->string(60),
            'cost' => $this->integer(20),
            'created_at' => $this->datetime(),
            'updated_at' => $this->datetime(),
        ]);
        $this->createTable('events_services', [
            'id' => $this->primaryKey(),
            'id_event' => $this->integer(11),
            'id_service' => $this->integer(11),
        ]);
        $this->createIndex('events_services-id_event', 'events_services', 'id_event');
        $this->createIndex('events_services-id_service', 'events_services', 'id_service');
        $this->addForeignKey('fk-events_services-id_event', 'events_services', 'id_event', 'events', 'id', 'CASCADE');
        $this->addForeignKey('fk-events_services-id_service', 'events_services', 'id_service', 'services', 'id', 'CASCADE');
    }

    public function down()
    {
        echo "m161123_073109_create_table_services cannot be reverted.\n";

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
