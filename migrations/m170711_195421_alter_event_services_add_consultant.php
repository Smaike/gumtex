<?php

use yii\db\Migration;

class m170711_195421_alter_event_services_add_consultant extends Migration
{
    public function up()
    {
        $this->dropColumn('clients', 'id_consultant');
        $this->addColumn('events_services', 'id_consultant', $this->integer(11));
        $this->addColumn('events_services', 'created_at', $this->datetime());
    }

    public function down()
    {
        echo "m170711_195421_alter_event_services_add_consultant cannot be reverted.\n";

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
