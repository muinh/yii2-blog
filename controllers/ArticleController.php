<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

use app\models\Article;
use app\models\Comment;

class ArticleController extends Controller
{
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('../../login');
        }

        $comment = new Comment();
        $new = new Article();
        $article = $new->getOne($id);

        return $this->render('view', compact(['id', 'comment', 'article']));
    }

    public function actionCreate()
    {
        $model = new Article();
        return $this->render('create', compact('model'));
    }

    public function actionStore()
    {
        $article = new Article();
        $article->saveArticle();
        return $this->goHome();
    }

    public function actionEdit($id)
    {
        $model = Article::findOne($id);
        return $this->render('edit', compact(['id', 'model']));
    }

    public function actionUpdate()
    {
        $article = new Article();
        $article->updateArticle();
        return $this->goHome();
    }

    public function actionDelete($id)
    {
        $article = Article::findOne($id);
        $article->delete();
        return $this->goHome();
    }
}