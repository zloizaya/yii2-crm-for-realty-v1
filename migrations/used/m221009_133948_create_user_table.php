<?php

use app\models\User;
use yii\db\Schema;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m221009_133948_create_user_table extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'username' => $this->string()->notNull(),
            'full_name' => $this->string(),
            'phone' => $this->string(),
            'position' => $this->string(),
            'auth_key' => $this->string(32),
            'email_confirm_token' => $this->string(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string(),
            'email' => $this->string()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
        ], $tableOptions);

        $this->createIndex('idx-user-username', '{{%user}}', 'username', true);
        $this->createIndex('idx-user-email', '{{%user}}', 'email', true);

        $model = new User();
        $model->username = "admin";
        $model->email = "admin@diontech.loc";
        $model->setPassword('asd123');
        $model->generateAuthKey();
        $model->save();
    }

    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
