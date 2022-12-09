<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%export}}`.
 */
class m221110_112218_create_export_table extends Migration
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

        $this->createTable('{{%export}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'link' => $this->string(),
            'created_at' => $this->date(),
            'updated_at' => $this->date(),
            'status' => $this->integer(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%export}}');
    }
}
