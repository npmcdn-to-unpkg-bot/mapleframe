<?php

use yii\db\Migration;

class m160421_051311_create_table_frames extends Migration
{
    public function up()
    {
        $this->createTable('{{%frames}}', [
            'id' => $this->primaryKey(),
            'created' => $this->integer()->notNull(),
            'updated' => $this->integer()->notNull(),
            'status' => $this->smallinteger(1)->notNull(),
            'author' => $this->integer()->notNull(),
            'name' => $this->string(255)->notNull(),
            'description' => $this->text()->notNull(),
            'template' => $this->text()->notNull()
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%frames}}');
    }
}
