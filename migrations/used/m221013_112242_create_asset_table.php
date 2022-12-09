<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%asset}}`.
 */
class m221013_112242_create_asset_table extends Migration
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
        $this->createTable('{{%asset}}', [
            'id' => $this->primaryKey(),
            'oid' => $this->integer(),
            'rid' => $this->integer(),
            'land' => $this->string(),
            'city' => $this->string(),
            'distric' => $this->string(),
            'street' => $this->string(),
            'house' => $this->string(),
            'kv_number' => $this->string(),
            'title' => $this->string(),
            'slug' => $this->string(),
            'all_square' => $this->string(),
            'live_square' => $this->string(),
            'kitchen' => $this->string(),
            'rooms' => $this->integer(),
            'floor' => $this->integer(),
            'floors' => $this->integer(),
            'builded' => $this->string(),
            'type_wall' => $this->integer(),
            'type_repair' => $this->integer(),
            'balcon' => $this->integer(),
            'bathroom' => $this->integer(),
            'elevator' => $this->string(),
            'communication' => $this->integer(),
            'description' => $this->text(),
            'acres' => $this->string(),
            'type_plot' => $this->smallInteger(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%asset}}');
    }
}
