<?php

use yii\db\Migration;

class m170126_182601_alter_price_time extends Migration
{
    public function up()
    {

        $this->dropColumn('prices', 'time_start');
        $this->dropColumn('prices', 'time_end');
        $this->dropColumn('prices', 'dow');  
        $this->dropColumn('prices', 'ranges'); 

        $this->addColumn('service_times', 'time_start', $this->string(5));
        $this->addColumn('service_times', 'time_end', $this->string(5));
        $this->addColumn('service_times', 'dow', $this->string(100));
        $this->addColumn('service_times', 'ranges', $this->text());
        $this->alterColumn('service_times', 'date_start', $this->date());
        $this->alterColumn('service_times', 'date_end', $this->date());
    }

    public function down()
    {
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
