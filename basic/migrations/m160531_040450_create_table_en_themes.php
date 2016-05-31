<?php

use yii\db\Migration;

/**
 * Handles the creation for table `table_en_themes`.
 */
class m160531_040450_create_table_en_themes extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%en_themes}}', [
            'id' => $this->primaryKey(),
            'created' => $this->integer()->notNull(),
            'updated' => $this->integer()->notNull(),
            'status' => $this->smallinteger(1)->notNull(),
            'author' => $this->smallinteger(4)->notNull(),
            'description' => $this->text()->notNull(),
            'name' => $this->string(255)->notNull()
        ]);
    }
    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%en_themes}}');
        return true;
    }
}
