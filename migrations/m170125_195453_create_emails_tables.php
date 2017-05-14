<?php

use yii\db\Migration;

class m170125_195453_create_emails_tables extends Migration
{
    public function up()
    {
        $this->createTable('emails_tpls', [
            'id' => $this->primaryKey(),
            'name' => $this->char(255),
            'subject' => $this->char(255),
            'content' => $this->text(),
            'date_add' => $this->dateTime(),
            'date_send' => $this->dateTime(),
            'date_update' => $this->dateTime(),
            'user_id' => $this->integer(11)
        ]);

        $this->createTable('emails_send', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(11),
            'subject' => $this->char(255),
            'content' => $this->text(),
            'recipients' => $this->text(),
            'is_send' => $this->integer(2),
            'date_send' => $this->dateTime(),
            'user_id' => $this->integer(11),
        ]);

        $this->createTable('emails_history', [
            'id' => $this->primaryKey(),
            'emails_send_id' => $this->integer(11),
            'recipient' => $this->integer(11),
            'date_send' => $this->dateTime(),
            'user_id' => $this->integer(11),
        ]);
    }

    public function down()
    {
        echo "m170125_195453_create_emails_tables cannot be reverted.\n";

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
