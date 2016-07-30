<?php

use yii\db\Migration;

class m160730_052843_ell_phases_extend extends Migration
{
    public function up()
    {
        $this->addColumn('{{%ell_phases}}', 'turn_id', $this->integer()->notNull());
    }

    public function down()
    {
        echo "m160730_052843_ell_turns_extend cannot be reverted.\n";
        $this->dropColumn('{{%ell_phases}}', 'turn_id');
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
