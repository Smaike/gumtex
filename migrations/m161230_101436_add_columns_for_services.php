<?php

use yii\db\Migration;

class m161230_101436_add_columns_for_services extends Migration
{
    public function up()
    {
        $this->addColumn('events_services', 'session', $this->string(50));
        $this->addColumn('services', 'ht_name', $this->string(50));
    }

    public function down()
    {
        echo "m161230_101436_add_columns_for_services cannot be reverted.\n";

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
