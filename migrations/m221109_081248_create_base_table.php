<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%base}}`.
 */
class m221109_081248_create_base_table extends Migration
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
            'created_at' => $this->date()->notNull(),
            'updated_at' => $this->date()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'agent' => $this->integer(),
            'client' => $this->integer(),
            'price_sale' => $this->string(),
            'price_owner' => $this->string(),
            'kadastr' => $this->string(),
            'export' => $this->integer()->notNull()->defaultValue(1),
            'typeAds' => $this->integer()->notNull(),
            'typeObj' => $this->integer()->notNull(),
            'rid' => $this->integer(),
            'land' => $this->string(),
            'city' => $this->string(),
            'street' => $this->string(),
            'house' => $this->string(),
            'kv' => $this->integer(),
            'title' => $this->string(),
            'totalSquare' => $this->string(),
            'liveSquare' => $this->string(),
            'kitchenSquare' => $this->string(),
            'rommCount' => $this->integer()->notNull(),
            'floor' => $this->integer(),
            'floors' => $this->integer(),
            'builded' => $this->string(),
            'wall' => $this->integer(),
            'repair' => $this->integer(),
            'balcon' => $this->integer(),
            'bathroom' => $this->integer(),
            'elevator' => $this->integer(),
            'communication' => $this->integer(),
            'description' => $this->text(),
            'acres' => $this->string(),
            'plot' => $this->smallInteger(),
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
