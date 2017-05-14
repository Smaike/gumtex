<?php

use yii\db\Migration;

class m170321_142108_add_discount_why extends Migration
{
    public function up()
    {
        $this->addColumn('events', 'discount', $this->integer(10));
        $this->addColumn('events', 'why', $this->string(500));
    }

    public function down()
    {
        echo "m170321_142108_add_discount_why cannot be reverted.\n";

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
