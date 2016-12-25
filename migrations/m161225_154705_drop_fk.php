<?php

use yii\db\Migration;

class m161225_154705_drop_fk extends Migration
{
    public function up()
    {
        $this->dropForeignKey('fk-comptuters-is_processed_by', 'comptuters');
    }

    public function down()
    {
        echo "m161225_154705_drop_fk cannot be reverted.\n";

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
