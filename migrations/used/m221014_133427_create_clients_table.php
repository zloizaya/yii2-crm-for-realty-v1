<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%clients}}`.
 */
class m221014_133427_create_clients_table extends Migration
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
        $this->createTable('{{%clients}}', [
            'id' => $this->primaryKey(),
            'surname' => $this->string(),
            'name' => $this->string(),
            'middle_name' => $this->string(),
            'phone' => $this->string(),
            'email' => $this->string(),
            'p_serial' => $this->string(),
            'p_number' => $this->string(),
            'p_date_take' => $this->date(),
            'p_who_take' => $this->string(),
            'p_code' => $this->string(), 
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%clients}}');
    }
}
