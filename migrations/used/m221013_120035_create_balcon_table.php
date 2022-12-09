<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%balcon}}`.
 */
class m221013_120035_create_balcon_table extends Migration
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
        $this->createTable('{{%balcon}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%balcon}}');
    }
}
