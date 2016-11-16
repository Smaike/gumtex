<?php

use yii\db\Migration;

class m161116_113122_create_table_client extends Migration
{
    public function up()
    {
        $this->createTable('clients', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string(60)->notNull(),
            'last_name' => $this->string(60)->notNull(),
            'middle_name' => $this->string(60),
            'birthday' => $this->date(),
            'p_first_name' => $this->string(60),
            'p_last_name' => $this->string(60),
            'p_middle_name' => $this->string(60),
            'mobile' => $this->string(20),
            'p_mobile' => $this->string(20),
            'type' => $this->integer(2),
            'category' => $this->integer(2),
            'id_consultant' => $this->integer(11),
            'comment' => $this->text(),
            'where_know' => $this->text(),
        ]);
        $this->createTable('clients_events', [
            'id' => $this->primaryKey(),
            'id_event' => $this->integer(11),
            'id_client' => $this->integer(11),
            'created_at' => $this->datetime(),
        ]);
    }

    public function down()
    {
        echo "m161116_113122_create_table_client cannot be reverted.\n";

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
