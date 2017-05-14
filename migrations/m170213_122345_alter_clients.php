<?php

use yii\db\Migration;

class m170213_122345_alter_clients extends Migration
{
    public function up()
    {
        $this->addColumn('clients', 'age', $this->integer(3));
    }

    public function down()
    {
        echo "m170213_122345_alter_clients cannot be reverted.\n";

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
