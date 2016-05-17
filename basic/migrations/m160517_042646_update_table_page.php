<?php

use yii\db\Migration;

class m160517_042646_update_table_page extends Migration
{
    public function up()
    {
        $this->addColumn('{{%pages}}', 'template', $this->string(255)->notNull());
        $this->addColumn('{{%pages}}', 'layout', $this->string(255)->notNull());
    }

    public function down()
    {
        echo "m160517_042646_update_table_page cannot be reverted.\n";
        $this->dropColumn('{{%pages}}', 'template');
        $this->dropColumn('{{%pages}}', 'layout');
        return true;
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
