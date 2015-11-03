<?php
use yii\db\Schema;
use yii\db\Migration;

class m151031_114914_create_publications_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%publication}}', [
            'id' => Schema::TYPE_PK,
            'url' => Schema::TYPE_STRING . ' NOT NULL DEFAULT \'\'',
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'kind' => Schema::TYPE_STRING . ' NOT NULL DEFAULT \'article\'',
            'isbn' => Schema::TYPE_STRING . ' NOT NULL DEFAULT \'\'',
            'volume' => Schema::TYPE_STRING . ' NOT NULL DEFAULT \'\'',
            'year' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT \'0\'',
            'tags' => Schema::TYPE_STRING . ' NOT NULL DEFAULT \'\'',
            'description' => Schema::TYPE_STRING . ' NOT NULL',
            'content' => Schema::TYPE_TEXT . ' NOT NULL',
            'publication_date' => Schema::TYPE_DATE . ' NOT NULL'
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%publication}}');

        return true;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
