<?php

use yii\db\Migration;

class m170106_164715_add_booking extends Migration
{
    public function up()
    {
        $this->createTable('booking', [
            'id' => $this->primaryKey(),
            'date_start' => $this->datetime(),
            'date_end' => $this->datetime(),
            'room_id' => $this->integer(11),
            'status' => $this->integer(1),
        ]);
    }

    public function down()
    {
        echo "m170106_164715_add_booking cannot be reverted.\n";

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
