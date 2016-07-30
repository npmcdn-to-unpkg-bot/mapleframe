<?php

use yii\db\Migration;

class m160730_054125_ell_games_conditions extends Migration
{
    public function up()
    {
        $this->createTable('{{%ell_games_conditions}}', [
            'id' => $this->primaryKey(),
            'created' => $this->integer()->notNull(),
            'updated' => $this->integer()->notNull(),
            'status' => $this->smallinteger(1)->notNull(),
            'author' => $this->smallinteger(4)->notNull(),
            'description' => $this->string(255)->notNull(),
            'type' => $this->smallinteger(2)->notNull(),
            'game_id' => $this->integer()->notNull(),
            'map' => $this->text()->notNull(),
            'crew' => $this->text()->notNull(),
            'events' => $this->text()->notNull(),
            'initiative' => $this->text()->notNull(),
            'ecology' => $this->text()->notNull(),
            'bank' => $this->text()->notNull(),
        ]);
    }

    public function down()
    {
        echo "m160730_054125_ell_games_conditions cannot be reverted.\n";
        $this->dropTable('{{%ell_games_conditions}}');
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
