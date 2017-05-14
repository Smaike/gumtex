<?php

use yii\db\Migration;

class m170322_183916_some_fixs extends Migration
{
    public function up()
    {
        $this->addColumn('events', 'created_by', $this->integer(11));
        $this->addColumn('services', 'status', $this->integer(1) . " default 1");
    }

    public function down()
    {
        echo "m170322_183916_some_fixs cannot be reverted.\n";

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
