<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%type_repair}}`.
 */
class m221013_115935_create_type_repair_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%type_repair}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%type_repair}}');
    }
}
