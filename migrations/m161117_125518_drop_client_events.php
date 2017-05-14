<?php

use yii\db\Migration;

class m161117_125518_drop_client_events extends Migration
{
    public function up()
    {
        $this->dropTable('clients_events');
        $this->addColumn('events', 'id_client', $this->integer(11));
        
    }

    public function down()
    {
        echo "m161117_125518_drop_client_events cannot be reverted.\n";

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
