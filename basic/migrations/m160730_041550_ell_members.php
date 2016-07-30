<?php

use yii\db\Migration;

class m160730_041550_ell_members extends Migration
{
    public function up()
    {
        $this->createTable('{{%ell_members}}', [
            'id' => $this->primaryKey(),
            'created' => $this->integer()->notNull(),
            'updated' => $this->integer()->notNull(),
            'status' => $this->smallinteger(1)->notNull(),
            'author' => $this->smallinteger(4)->notNull(),
            'nickname' => $this->string(255)->notNull(),
            'description' => $this->string(255)->notNull(),
            'title' => $this->integer(4)->notNull(),
            'type' => $this->smallinteger(2)->notNull(),
            'firstname' => $this->string(255)->notNull(),
            'lastname' => $this->string(255)->notNull(),
            'patronumic' => $this->string(255)->notNull(),
            'birthday' => $this->integer()->notNull()
        ]);
    }

    public function down()
    {
        echo "m160730_041550_ell_members cannot be reverted.\n";
        $this->dropTable('{{%ell_members}}');
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
