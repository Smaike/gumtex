<?php

use yii\db\Migration;

class m170327_210109_alter_activedays extends Migration
{
    public function up()
    {
        $this->addColumn('active_days', 'start', $this->string(5));
        $this->addColumn('active_days', 'end', $this->string(5));
    }

    public function down()
    {
        echo "m170327_210109_alter_activedays cannot be reverted.\n";

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
