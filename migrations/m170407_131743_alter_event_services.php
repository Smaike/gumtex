<?php

use yii\db\Migration;

class m170407_131743_alter_event_services extends Migration
{
    public function up()
    {
        $this->addColumn('events_services', 'code', $this->string(8));
        $this->addColumn('events', 'is_paid', $this->integer(1));
        $this->addColumn('events', 'sum_paid', $this->integer(12));
    }

    public function down()
    {
        echo "m170407_131743_alter_event_services cannot be reverted.\n";

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
