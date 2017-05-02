<?php

use yii\db\Migration;

class m170502_105010_create_table_consultant extends Migration
{
    public function up()
    {
        $this->createTable('consultants', [
            'id' => $this->primaryKey(),
            'id_user' => $this->integer(11),
            'id_category' => $this->integer(11),
            'id_type' => $this->integer(11),
        ]);
    }

    public function down()
    {
        echo "m170502_105010_create_table_consultant cannot be reverted.\n";

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
