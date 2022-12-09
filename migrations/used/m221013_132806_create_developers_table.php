<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%developers}}`.
 */
class m221013_132806_create_developers_table extends Migration
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
        $this->createTable('{{%developers}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'slug' => $this->string(),
            'site' => $this->string(),
            'email' => $this->string(),
            'phone' => $this->string(),
            'description' => $this->text(),
            'director' => $this->string(),
            'inn' => $this->string(),
            'kpp' => $this->string(),
            'ogrn' => $this->string(),
            'address' => $this->string(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%developers}}');
    }
}
