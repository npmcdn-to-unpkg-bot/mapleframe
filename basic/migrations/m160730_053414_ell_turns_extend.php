<?php

use yii\db\Migration;

class m160730_053414_ell_turns_extend extends Migration
{
    public function up()
    {
        $this->addColumn('{{%ell_turns}}', 'crew_id', $this->integer()->notNull());
    }

    public function down()
    {
        echo "m160730_053414_ell_turns_extend cannot be reverted.\n";
        $this->dropColumn('{{%ell_turns}}', 'crew_id');
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
