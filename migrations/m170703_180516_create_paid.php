<?php

use yii\db\Migration;

class m170703_180516_create_paid extends Migration
{
    public function up()
    {
        $this->createTable('paids', [
            'id'       => $this->primaryKey(),
            'id_event' => $this->integer(11),
            'sum'      => $this->integer(12),
            'type'     => $this->integer(1),
            'date'     => $this->datetime(),
        ]);

    }
    
    public function down()
    {
        echo "m170703_180516_create_paid cannot be reverted.\n";

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
