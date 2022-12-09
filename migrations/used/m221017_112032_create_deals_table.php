<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%deals}}`.
 */
class m221017_112032_create_deals_table extends Migration
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
        $this->createTable('{{%deals}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'created_at' => $this->date(),
            'updated_at' => $this->date(),
            'closed_at' => $this->date(),
            'buyer' => $this->integer(),
            'seller' => $this->integer(),
            'agent' => $this->integer(),
            'price' => $this->string(),
            'commission' => $this->string(),
            'comments' => $this->integer(),
            'status' => $this->integer(),
            'object' => $this->integer(),
            'task' => $this->integer(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%deals}}');
    }
}
