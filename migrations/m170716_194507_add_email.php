<?php

use yii\db\Migration;

class m170716_194507_add_email extends Migration
{
    public function up()
    {
        $this->addColumn('clients', 'email', $this->string(100));
    }

    public function down()
    {
        echo "m170716_194507_add_email cannot be reverted.\n";

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
