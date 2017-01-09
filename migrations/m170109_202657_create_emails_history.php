<?php

use yii\db\Migration;

class m170109_202657_create_emails_history extends Migration
{
    public function up()
    {
        $this->createTable('emails_history', [
            'id' => $this->primaryKey(),
            'emails_tpls_id' => $this->integer(11),
            'recipient' => $this->char(255),
            'date_send' => $this->dateTime(),
            'user_id' => $this->integer(255),
        ]);
    }



    public function down()
    {
        echo "m170109_202657_create_emails_history cannot be reverted.\n";

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
