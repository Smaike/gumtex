<?php

use yii\db\Migration;

class m170328_205302_add_category_and_type_consultant extends Migration
{
    public function up()
    {
        $this->createTable('consultants_types', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
        ]);
        $this->createTable('consultants_categories', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
        ]);
        $this->createTable('consultants_services', [
            'id' => $this->primaryKey(),
            'id_consultant_category' => $this->integer(11),
            'id_service' => $this->integer(11),
            'status' => $this->integer(1),
        ]);
        $this->createTable('consultants_cost', [
            'id' => $this->primaryKey(),
            'id_consultant_type' => $this->integer(11),
            'id_service' => $this->integer(11),
            'value' => $this->string(255),
        ]);
    }

    public function down()
    {
        echo "m170328_205302_add_category_and_type_consultant cannot be reverted.\n";

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
