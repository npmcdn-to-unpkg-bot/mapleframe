<?php

use yii\db\Migration;

class m160422_041656_create_frame_js extends Migration
{
    public function up()
    {
        $this->createTable('{{%frame_js}}', [
            'id' => $this->primaryKey(),
            'status' => $this->smallinteger(1)->notNull(),
            'created' => $this->integer()->notNull(),
            'updated' => $this->integer()->notNull(),
            'author' => $this->smallinteger(4)->notNull(),
            'path' => $this->string(255)->notNull(),
            'frame_id' => $this->smallinteger(4)->notNull(),
            'name' => $this->string()->notNull(),
            'description' => $this->text()->notNull(),
            'version' => $this->string()->notNull(),
            'position' => $this->smallinteger(2)->notNull(),
            'type'=>$this->smallinteger(2)->notNull(),
            'depends'=>$this->string(255)->notNull()
        ]);
    }

    public function down()
    {
        $this->dropTable('frame_js');
    }
}
