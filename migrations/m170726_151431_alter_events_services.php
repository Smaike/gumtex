<?php

use yii\db\Migration;

class m170726_151431_alter_events_services extends Migration
{
    public function up()
    {
        $this->addColumn('events_services', 'test_start', $this->datetime());
        $this->addColumn('events_services', 'test_end', $this->datetime());
        $this->addColumn('events_services', 'consultant_start', $this->datetime());
        $this->addColumn('events_services', 'consultant_end', $this->datetime());
    }

    public function down()
    {
        echo "m170726_151431_alter_events_services cannot be reverted.\n";

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
