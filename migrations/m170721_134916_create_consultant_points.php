<?php

use yii\db\Migration;

class m170721_134916_create_consultant_points extends Migration
{
    public function up()
    {
        $this->createTable('consultant_points', [
            'id'            => $this->primaryKey(),
            'id_es'         => $this->integer(11),
            'id_service'         => $this->integer(11),
            'id_consultant' => $this->integer(12),
            'created_at'    => $this->datetime(),
        ]);
    }

    public function down()
    {
        echo "m170721_134916_create_consultant_points cannot be reverted.\n";

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
