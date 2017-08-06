<?php

use yii\db\Migration;

class m170806_190704_create_table_payments_crm extends Migration
{
    public function up()
    {
        $this->createTable('payments_crm', [
            'id'            => $this->primaryKey(),
            'sum'    => $this->integer(11),
            'type' => $this->integer(2),
            'descriptions' => $this->text(),
            'created_at'    => $this->datetime(),
        ]);

        $this->createTable('payments_dinner', [
            'id'            => $this->primaryKey(),
            'sum'    => $this->integer(11),
            'id_user' => $this->integer(11),
            'created_at'    => $this->datetime(),
        ]);
    }

    public function down()
    {
        echo "m170806_190704_create_table_payments_crm cannot be reverted.\n";

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
