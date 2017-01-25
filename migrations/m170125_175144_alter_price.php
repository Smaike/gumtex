<?php

use yii\db\Migration;

class m170125_175144_alter_price extends Migration
{
    public function up()
    {
        $this->addColumn('prices', 'time_start', $this->string(5));
        $this->addColumn('prices', 'time_end', $this->string(5));
        $this->addColumn('prices', 'dow', $this->string(100));
        $this->addColumn('prices', 'ranges', $this->text());
        $this->alterColumn('prices', 'date_start', $this->date());
        $this->alterColumn('prices', 'date_end', $this->date());
    }

    public function down()
    {
        $this->dropColumn('prices', 'time_start');
        $this->dropColumn('prices', 'time_end');
        $this->dropColumn('prices', 'dow');  
        $this->dropColumn('prices', 'ranges'); 

        $this->alterColumn('prices', 'date_start', $this->datetime());
        $this->alterColumn('prices', 'date_end', $this->datetime());
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
