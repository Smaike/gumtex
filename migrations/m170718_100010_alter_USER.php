<?php

use yii\db\Migration;

class m170718_100010_alter_USER extends Migration
{
    public function up()
    {
        $this->addColumn('users', 'phone', $this->string(255));
    }

    public function down()
    {
        echo "m170718_100010_alter_USER cannot be reverted.\n";

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
