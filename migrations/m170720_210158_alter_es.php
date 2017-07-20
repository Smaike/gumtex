<?php

use yii\db\Migration;

class m170720_210158_alter_es extends Migration
{
    public function up()
    {
        $this->addColumn('events_services', 'tranings', $this->string(500));
    }

    public function down()
    {
        echo "m170720_210158_alter_es cannot be reverted.\n";

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
