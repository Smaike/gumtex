<?php

use yii\db\Migration;

class m161225_165438_add_status extends Migration
{
    public function up()
    {
        $this->addColumn('events_services', 'status', $this->string(20));
    }

    public function down()
    {
        echo "m161225_165438_add_status cannot be reverted.\n";

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
