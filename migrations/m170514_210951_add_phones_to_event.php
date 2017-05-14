<?php

use yii\db\Migration;

class m170514_210951_add_phones_to_event extends Migration
{
    public function up()
    {
        $this->addColumn('clients', 's_mobile', $this->string(15));
    }

    public function down()
    {
        echo "m170514_210951_add_phones_to_event cannot be reverted.\n";

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
