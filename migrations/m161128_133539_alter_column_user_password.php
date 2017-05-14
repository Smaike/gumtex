<?php

use yii\db\Migration;

class m161128_133539_alter_column_user_password extends Migration
{
    public function up()
    {
        $this->alterColumn('users', 'password', $this->string(100));
    }

    public function down()
    {
        echo "m161128_133539_alter_column_user_password cannot be reverted.\n";

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
