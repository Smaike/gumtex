<?php

use yii\db\Migration;

class m170327_200538_reindent_daysservices extends Migration
{
    public function up()
    {
        $this->dropColumn('days_services', 'day');
        $this->addColumn('days_services', 'service_type', $this->integer(11));
        $this->addColumn('days_services', 'monday', $this->integer(1));
        $this->addColumn('days_services', 'tuesday', $this->integer(1));
        $this->addColumn('days_services', 'wednesday', $this->integer(1));
        $this->addColumn('days_services', 'thursday', $this->integer(1));
        $this->addColumn('days_services', 'friday', $this->integer(1));
        $this->addColumn('days_services', 'saturday', $this->integer(1));
        $this->addColumn('days_services', 'sunday', $this->integer(1));
        $this->addColumn('days_services', 'start', $this->string(5));
        $this->addColumn('days_services', 'end', $this->string(5));
    }

    public function down()
    {
        echo "m170327_200538_reindent_daysservices cannot be reverted.\n";

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
