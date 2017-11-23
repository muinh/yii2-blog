<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

use app\models\Comment;

class CommentController extends Controller
{
    public function actionCreate($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('../../login');
        }
        $comment = new Comment();
        $parent = $comment->getParent($id, $comment);
        return $this->render('create', compact(['comment', 'parent']));
    }

    public function actionStore()
    {
        $params = Yii::$app->request->post();
        $comment = new Comment();
        $comment->saveComment($comment, $params);

        return $this->redirect('article/' . $params['article_id']);
    }

    public function actionEdit($id)
    {
        $model = Comment::findOne($id);
        return $this->render('edit', compact(['id', 'model']));
    }

    public function actionUpdate()
    {
        $params = Yii::$app->request->post();
        $comment = new Comment();
        $comment->updateComment($params);

        return $this->goHome();
    }

    public function actionDelete($id)
    {
        $comment = Comment::findOne($id);
        $comment->delete();
        return $this->goHome();
    }
}