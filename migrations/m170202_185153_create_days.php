<?php

use yii\db\Migration;

class m170202_185153_create_days extends Migration
{
    public function up()
    {
        $this->createTable('days_services', [
            'id' => $this->primaryKey(),
            'id_service' => $this->integer(11),
            'day' => $this->integer(1),
        ]);
    }

    public function down()
    {
        echo "m170202_185153_create_days cannot be reverted.\n";

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
