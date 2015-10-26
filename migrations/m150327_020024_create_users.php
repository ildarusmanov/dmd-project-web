<?php

use yii\db\Schema;
use yii\db\Migration;

class m150327_020024_create_users extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%user}}', [
            'id' => Schema::TYPE_PK,
            'partner_id' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT \'0\'',
            'role' => Schema::TYPE_STRING . ' NOT NULL DEFAULT \'user\'',
            'email' => Schema::TYPE_STRING . ' NOT NULL  DEFAULT \'\'',
            'confirmed_email' => Schema::TYPE_STRING . ' NOT NULL  DEFAULT \'\'',
            'confirmed_at' => Schema::TYPE_INTEGER . ' NOT NULL  DEFAULT \'0\'',
            'confirmation_token' => Schema::TYPE_STRING . ' NOT NULL  DEFAULT \'\'',
            'auth_key' => Schema::TYPE_STRING . ' NOT NULL',
            'password_reset_token' => Schema::TYPE_STRING . ' NOT NULL',
            'password_hash' => Schema::TYPE_STRING . ' NOT NULL  DEFAULT \'\'',
            'network_id' => Schema::TYPE_STRING . ' NOT NULL',
            'network_identity' => Schema::TYPE_STRING . ' NOT NULL',
            'network_profile' => Schema::TYPE_STRING . ' NOT NULL',
            'network_avatar' => Schema::TYPE_STRING . ' NOT NULL',
            'avatar' => Schema::TYPE_STRING . ' NOT NULL',
            'name' => Schema::TYPE_STRING . ' NOT NULL DEFAULT \'Noname\'',
            'gender' => Schema::TYPE_STRING . ' NOT NULL',
            'phone' => Schema::TYPE_STRING . ' NOT NULL',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'birthdate' => Schema::TYPE_DATE . ' NOT NULL DEFAULT \'1990-01-01\'',
            'friends_count' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT \'0\'',
            'clicks_count' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT \'0\'',
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%user}}');

        return true;
    }
}
