<?php

use yii\db\Migration;

class m170116_194513_create_tables_part_3 extends Migration
{
    public function up()
    {
        $this->createTable('service_types', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
        ]);
        $this->addColumn('services', 'type_id', $this->integer(11));

        $this->createTable('service_times', [
            'id' => $this->primaryKey(),
            'id_service' => $this->integer(11),
            'date_start' => $this->datetime(),
            'date_end' => $this->dateTime(),
        ]);

        $this->createTable('prices', [
            'id' => $this->primaryKey(),
            'id_service' => $this->integer(11),
            'date_start' => $this->datetime(),
            'date_end' => $this->dateTime(),
            'price' => $this->string(50),
            'discount' => $this->integer(3),
            'client_type_id' => $this->integer(11),
            'client_category_id' => $this->integer(11),
        ]);
    }

    public function down()
    {
        echo "m170116_194513_create_tables_part_3 cannot be reverted.\n";

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
