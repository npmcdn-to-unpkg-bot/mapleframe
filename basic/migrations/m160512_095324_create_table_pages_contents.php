<?php

use yii\db\Migration;

class m160512_095324_create_table_pages_contents extends Migration
{
    public function up()
    {
        $this->createTable('{{%pages_contents}}', [
            'id' => $this->primaryKey(),
            'created' => $this->integer()->notNull(),
            'updated' => $this->integer()->notNull(),
            'status' => $this->smallinteger(1)->notNull(),
            'author' => $this->smallinteger(4)->notNull(),
            'page_id' => $this->smallinteger(4)->notNull(),
            'description' => $this->text()->notNull(),
            'title' => $this->string(255)->notNull(),
            'content' => $this->text()->notNull(),
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%pages_contents}}');
    }
}
