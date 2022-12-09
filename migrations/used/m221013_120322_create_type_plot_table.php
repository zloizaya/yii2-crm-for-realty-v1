<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%type_plot}}`.
 */
class m221013_120322_create_type_plot_table extends Migration
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
        $this->createTable('{{%type_plot}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%type_plot}}');
    }
}
