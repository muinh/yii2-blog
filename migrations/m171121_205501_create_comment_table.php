<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `comment`.
 */
class m171121_205501_create_comment_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('comment', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(),
            'text' => $this->string(),
            'user_id' => $this->integer(),
            'article_id' => $this->integer(),
            'created_at' => Schema::TYPE_TIMESTAMP . ' NOT NULL'
        ]);

        $this->addForeignKey(
            'fk-comment-user-id',
            'comment',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-comment-article-id',
            'comment',
            'article_id',
            'article',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('comment');
    }
}
