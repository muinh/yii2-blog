<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `article`.
 */
class m171121_203347_create_article_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('article', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'text' => $this->text()->notNull(),
            'preview' => $this->string(),
            'author' => $this->integer()->notNull(),
            'created_at' => Schema::TYPE_TIMESTAMP . ' NOT NULL',
            'allow_comments' => $this->boolean()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('article');
    }
}
