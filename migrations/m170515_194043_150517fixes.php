<?php

use yii\db\Migration;

class m170515_194043_150517fixes extends Migration
{
    public function up()
    {
        $this->addColumn('events_services', 'code_generated', $this->datetime());
    }

    public function down()
    {
        echo "m170515_194043_150517fixes cannot be reverted.\n";

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
