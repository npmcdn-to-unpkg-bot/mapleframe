<?php

use yii\db\Migration;

class m160730_041151_ell_crews extends Migration
{
    public function up()
    {
        $this->createTable('{{%ell_crews}}', [
            'id' => $this->primaryKey(),
            'created' => $this->integer()->notNull(),
            'updated' => $this->integer()->notNull(),
            'status' => $this->smallinteger(1)->notNull(),
            'author' => $this->smallinteger(4)->notNull(),
            'title' => $this->string(255)->notNull(),
            'description' => $this->string(255)->notNull(),
            'type' => $this->smallinteger(2)->notNull(),
            'shield' => $this->integer(4)->notNull(),
        ]);
    }

    public function down()
    {
        echo "m160730_041151_ell_crews cannot be reverted.\n";
        $this->dropTable('{{%ell_crews}}');
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
