<?php

use yii\db\Migration;

/**
 * Handles the creation for table `table_eu_words`.
 */
class m160531_101133_create_table_eu_words extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%en_words}}', [
            'id' => $this->primaryKey(),
            'created' => $this->integer()->notNull(),
            'updated' => $this->integer()->notNull(),
            'status' => $this->smallinteger(1)->notNull(),
            'author' => $this->smallinteger(4)->notNull(),
            'theme_id' => $this->integer()->notNull(),
            'word' => $this->string(255)->notNull(),
            'translate' => $this->string(255)->notNull(),
            'trancription' => $this->string(255)->notNull(),
            'type' => $this->smallinteger(2)->notNull(),
            'infinitive' => $this->string(255)->notNull(),
            'past_simple' => $this->string(255)->notNull(),
            'past_participle' => $this->string(255)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%en_words}}');
    }
}
