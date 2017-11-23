<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\helpers\Url;

class Comment extends ActiveRecord
{
    public function getUsers()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public static function getForArticle($article_id)
    {
        $arr = Comment::find()->joinWith('users')->where(['article_id' => $article_id])
            ->orderBy('parent_id ASC', 'id ASC', 'created_at ASC')->asArray()->all();

        $new_arr = null;
        for ($i = 0, $c = count($arr); $i < $c; $i++) {
            $new_arr[$arr[$i]['parent_id']][] = $arr[$i];
        }

        if ($new_arr) {
            self::buildTree($new_arr, 0);
        }
    }

    public static function buildTree($data, $parent = 0, $level = 0)
    {
        $arr = $data[$parent];

        for ($i = 0; $i < count($arr); $i++) {
            ?>
            <article style="padding-left: <?= $level ?>px">
                <p class="comment-post">
                    <i style="display: block"><?= $arr[$i]['users']['name'] ?>:</i>
                    <?= $arr[$i]['text'] ?>
                <div>
                    <a href="<?= Url::to(['comment/' . $arr[$i]['id'] . '/edit'])?>">edit</a>
                    <a href="<?= Url::to(['comment/' . $arr[$i]['id'] . '/delete'])?>">delete</a>
                    <a href="<?= Url::to(['comment/' . $arr[$i]['id']])?>">comment</a>
                </div>
                </p>

                <?php
                if (isset($data[$arr[$i]['id']])) self::buildTree($data, $arr[$i]['id'], 20);
                ?>
            </article>
            <?php
        }
    }

    public function getParent($id, $comment)
    {
        $parent = $comment->getOne($id);
        return $parent;
    }

    public function getOne($id)
    {
        $comment = self::findOne($id);
        return $comment;
    }

    public function saveComment($comment, $params)
    {
        $comment->text = $params['Comment']['text'];
        $comment->article_id = $params['article_id'];
        $comment->user_id = $params['user_id'];
        $comment->parent_id = $params['parent_id'];
        $comment->save();
    }

    public function updateComment($params)
    {
        $comment = Comment::findOne($params['Comment']['id']);
        $comment->text = $params['Comment']['text'];
        $comment->user_id = $params['user_id'];
        $comment->article_id = $params['article_id'];
        $comment->parent_id = $params['parent_id'];
        $comment->save();
    }
}