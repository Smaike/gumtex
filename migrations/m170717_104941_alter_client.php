<?php

use yii\db\Migration;

class m170717_104941_alter_client extends Migration
{
    public function up()
    {
        $this->addColumn('clients', 'grade', $this->integer(2));
        $this->addColumn('clients', 'hobby', $this->string(255));
    }

    public function down()
    {
        echo "m170717_104941_alter_client cannot be reverted.\n";

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
