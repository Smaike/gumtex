<?php

use yii\db\Migration;

class m170109_202709_create_emails_tpls extends Migration
{
    public function up()
    {
        $this->createTable('emails_history', [
            'id' => $this->primaryKey(),
            'content' => $this->text(),
            'date_add' => $this->dateTime(),
            'date_send' => $this->dateTime(),
            'date_update' => $this->dateTime(),
            'user_id' => $this->integer(11),

        ]);
    }

    public function down()
    {
        echo "m170109_202709_create_emails_tpls cannot be reverted.\n";

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
