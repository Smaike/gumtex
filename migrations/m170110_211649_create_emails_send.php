<?php

use yii\db\Migration;

class m170110_211649_create_emails_send extends Migration
{
    public function up()
    {
        $this->createTable('emails_send', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(11),
            'content' => $this->text(),
            'date_send' => $this->dateTime(),
            'user_id' => $this->integer(11),
        ]);
    }

    public function down()
    {
        echo "m170110_211649_create_emails_send cannot be reverted.\n";

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
