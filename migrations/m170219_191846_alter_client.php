<?php

use yii\db\Migration;

class m170219_191846_alter_client extends Migration
{
    public function up()
    {
        $this->addColumn('clients', 'fio_mother', $this->string(100));
        $this->addColumn('clients', 'fio_father', $this->string(100));
        $this->addColumn('clients', 'fio_sup', $this->string(100));
        $this->dropColumn('clients', 'p_first_name');
        $this->dropColumn('clients', 'p_last_name');
        $this->dropColumn('clients', 'p_middle_name');
    }

    public function down()
    {
        echo "m170219_191846_alter_client cannot be reverted.\n";

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
