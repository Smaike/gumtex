<?php

use yii\db\Migration;

class m170206_111729_create_table_service_discount extends Migration
{
    public function up()
    {
        $this->createTable('client_discount', [
            'id' => $this->primaryKey(),
            'id_service' => $this->integer(11),
            'id_category' => $this->integer(11),
            'id_type' => $this->integer(11),
            'value' => $this->string(11)
        ]);
    }

    public function down()
    {
        echo "m170206_111729_create_table_service_discount cannot be reverted.\n";

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
