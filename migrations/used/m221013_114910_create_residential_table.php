<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%residential}}`.
 */
class m221013_114910_create_residential_table extends Migration
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
        $this->createTable('{{%residential}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'developer' => $this->integer(),
            'land' => $this->string(),
            'city' => $this->string(),
            'distric' => $this->string(),
            'street' => $this->string(),
            'law' => $this->string(),
            'floors' => $this->string(),
            'squares' => $this->string(),
            'type_buildings' => $this->string(),
            'stage' => $this->string(),
            'deadline' => $this->date(),
            'comfort' => $this->string(),
            'description' => $this->text(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%residential}}');
    }
}
