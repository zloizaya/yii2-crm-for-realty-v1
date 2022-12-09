<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%base}}`.
 */
class m221013_120847_create_base_table extends Migration
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
        $this->createTable('{{%base}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
            'agent' => $this->integer()->notNull(),
            'client' => $this->integer()->notNull(),
            'price_sale' => $this->string(),
            'price_owner' => $this->string(),
            'price_metr' => $this->string(),
            'type_ads' => $this->integer(),
            'type_obj' => $this->integer(),
            'kad_number' => $this->string(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%base}}');
    }
}
