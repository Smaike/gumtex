<?php

use yii\db\Migration;

class m170107_143914_create_table_offices extends Migration
{
    public function up()
    {
        $this->createTable('rooms', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'status' => $this->integer(1),
        ]);
    }

    public function down()
    {
        echo "m170107_143914_create_table_offices cannot be reverted.\n";

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
