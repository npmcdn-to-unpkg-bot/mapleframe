<?php

use yii\db\Migration;

class m160512_074534_create_table_pages extends Migration
{
    public function up()
    {
        $this->createTable('{{%pages}}', [
            'id' => $this->primaryKey(),
            'created' => $this->integer()->notNull(),
            'updated' => $this->integer()->notNull(),
            'status' => $this->smallinteger(1)->notNull(),
            'author' => $this->integer()->notNull(),
            'name' => $this->string(255)->notNull(),
            'alias' => $this->string(255)->notNull(),
            'type' => $this->smallinteger(2)->notNull(),
            'meta_title' => $this->string(255)->notNull(),
            'meta_keywords' => $this->text()->notNull(),
            'meta_description' => $this->text()->notNull(),
            'description' => $this->text()->notNull(),
            'path' => $this->text()->notNull()
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%pages}}');
    }
}
