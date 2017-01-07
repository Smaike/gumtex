<?php

use yii\db\Migration;

class m170105_153554_add_report_column extends Migration
{
    public function up()
    {
        $this->addColumn('events_services', 'url_report', $this->string(255));
    }

    public function down()
    {
        echo "m170105_153554_add_report_column cannot be reverted.\n";

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
