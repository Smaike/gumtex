<?php

use yii\db\Migration;

class m170515_094644_150517_fixs extends Migration
{
    public function up()
    {
        $this->addColumn('clients', 'gender', $this->string(1));
    }

    public function down()
    {
        echo "m170515_094644_150517_fixs cannot be reverted.\n";

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
