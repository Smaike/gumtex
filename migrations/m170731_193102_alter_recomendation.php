<?php

use yii\db\Migration;

class m170731_193102_alter_recomendation extends Migration
{
    public function up()
    {
        $this->addColumn('client_recomendations', 'is_visited', $this->integer(1));
        $this->addColumn('client_recomendations', 'date_visited', $this->datetime());
    }

    public function down()
    {
        echo "m170731_193102_alter_recomendation cannot be reverted.\n";

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
