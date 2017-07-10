<?php

use yii\db\Migration;

class m170710_112320_created_receipts extends Migration
{
    public function up()
    {
        $this->createTable('receipts', [
            'id'       => $this->primaryKey(),
            'id_client' => $this->integer(11),
            'sum'      => $this->integer(12),
            'type'     => $this->integer(1),
            'date'     => $this->datetime(),
        ]);

        
        $this->addColumn('clients', 'balance', $this->string(15));
    }

    public function down()
    {
        echo "m170710_112320_created_receipts cannot be reverted.\n";

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
