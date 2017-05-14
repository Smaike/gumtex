<?php

use yii\db\Migration;

class m161110_140641_create_table_event extends Migration
{
    public function up()
    {
        $this->createTable('events', [
            'id' => $this->primaryKey(),
            'date' => $this->datetime(),
            'name' => $this->string(255),
            'status' => $this->integer(2),
        ]);
    }

    public function down()
    {
        echo "m161110_140641_create_table_event cannot be reverted.\n";

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
