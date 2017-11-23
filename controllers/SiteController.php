<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

use app\models\Article;
use app\models\Signup;
use app\models\Login;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'blog'],
                'rules' => [
                    [
                        'actions' => [
                            'logout',
                            'blog',
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post', 'get'],
                ],
            ],
        ];
    }

    public function actionFeed()
    {
        $articles = Article::getAll();
        return $this->render('feed', compact('articles'));
    }

    public function actionBlog()
    {
        $articles = Article::getAllMy();
        return $this->render('blog', compact('articles'));
    }

    public function actionSignup()
    {
        $model = new Signup();

        if (isset($_POST['Signup'])) {
            $model->attributes = Yii::$app->request->post('Signup');

            if ($model->validate() && $model->signup()) {
                return $this->goHome();
            }
        }

        return $this->render('signup', ['model' => $model]);
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $login = new Login();

        if (Yii::$app->request->post('Login')) {
            $login->attributes = Yii::$app->request->post('Login');

            if ($login->validate()) {
                Yii::$app->user->login($login->getUser());
                return $this->goHome();
            }
        }

        return $this->render('login', ['login' => $login]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(['login']);
    }
}
