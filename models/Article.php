<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\Exception;
use yii\web\UploadedFile;

class Article extends ActiveRecord
{
    public function getUsers()
    {
        return $this->hasOne(User::className(), ['id' => 'author']);
    }

    public static function getAll()
    {
        $articles = self::find()->joinWith('users')
            ->orderBy('created_at ASC')->asArray()->all();

        return $articles;
    }

    public static function getAllMy()
    {
        $articles = self::find()
            ->where(['author' => \Yii::$app->user->identity['id']])
            ->orderBy('created_at ASC')->asArray()->all();

        return $articles;
    }

    public function getOne($id)
    {
        $article = self::findOne($id);
        if ($article === null) {
            throw new Exception('There is no article with id ' . $id);
        }

        return $article;
    }

    public function uploadFile($file, $newFilename)
    {
        $file->saveAs('uploads/' . $newFilename);
        return $file->name;
    }

    public function saveArticle()
    {
        if (\Yii::$app->request->isPost) {
            $file = UploadedFile::getInstanceByName('Article[preview]');
            $newFilename = strtolower(md5(uniqid($file->baseName))) . '.' . $file->extension;
            $article = new Article();
            $article->uploadFile($file, $newFilename);

            $params = \Yii::$app->request->post('Article');
            $article->title = $params['title'];
            $article->text = $params['text'];
            $article->author = $params['author'];
            $article->preview = $newFilename;
            $article->allow_comments = ($params['allow_comments']) ?? 0;
            $article->save();
        }
    }

    public function updateArticle()
    {
        $params = \Yii::$app->request->post('Article');
        $article = Article::findOne($params['id']);
        $article->title = $params['title'];
        $article->text = $params['text'];
        $article->author = $params['author'];
        $article->preview = $params['preview'];
        $article->allow_comments = ($params['allow_comments']) ?? 0;
        $article->save();
    }
}