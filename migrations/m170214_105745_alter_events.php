<?php

use yii\db\Migration;

class m170214_105745_alter_events extends Migration
{
    public function up()
    {
        $this->addColumn('events', 'price', $this->string(20));
        $this->dropColumn('events', 'name');
    }

    public function down()
    {
        echo "m170214_105745_alter_events cannot be reverted.\n";

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
