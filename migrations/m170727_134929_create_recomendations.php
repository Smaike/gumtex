<?php

use yii\db\Migration;

class m170727_134929_create_recomendations extends Migration
{
    public function up()
    {
        $this->createTable('client_recomendations', [
            'id'            => $this->primaryKey(),
            'id_es'         => $this->integer(11),
            'id_service'    => $this->integer(11),
            'id_client'    => $this->integer(11),
            'id_consultant' => $this->integer(12),
            'created_at'    => $this->datetime(),
        ]);
    }

    public function down()
    {
        echo "m170727_134929_create_recomendations cannot be reverted.\n";

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
