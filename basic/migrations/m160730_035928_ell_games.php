<?php

use yii\db\Migration;

class m160730_035928_ell_games extends Migration
{
    public function up()
    {
        $this->createTable('{{%ell_games}}', [
            'id' => $this->primaryKey(),
            'created' => $this->integer()->notNull(),
            'updated' => $this->integer()->notNull(),
            'status' => $this->smallinteger(1)->notNull(),
            'author' => $this->smallinteger(4)->notNull(),
            'theme' => $this->string(255)->notNull(),
            'description' => $this->string(255)->notNull(),
            'type' => $this->smallinteger(2)->notNull(),
        ]);
    }

    public function down()
    {
        echo "m160730_035928_ell_games cannot be reverted.\n";
        $this->dropTable('{{%ell_games}}');
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
