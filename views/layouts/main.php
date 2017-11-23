<?php

use yii\helpers\Html;
use yii\helpers\Url;

use app\assets\AppAsset;

AppAsset::register($this);
?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title>Yii2-Blog</title>
        <?php $this->head() ?>
    </head>
    <body class="b-page">
    <?php $this->beginBody() ?>
    <header class="b-header">
        <div class="b-header__menu">
            <ul id="nav" class="nav-list">
                <li class="nav-item"><a href="<?= Url::to(['/']) ?>" class="nav-link">Feed</a></li>
                <li class="nav-item"><a href="<?= Url::to(['/blog']) ?>" class="nav-link">My blog</a></li>
                <?php if (Yii::$app->user->isGuest): ?>
                    <li class="nav-item"><a href="<?= Url::to(['/login']) ?>" class="nav-link">Log In</a></li>
                    <li class="nav-item"><a href="<?= Url::to(['/signup']) ?>" class="nav-link">Sign Up</a></li>
                <?php endif ?>
                <?php if (!Yii::$app->user->isGuest): ?>
                    <li class="nav-item"><a href="<?= Url::to(['/logout']) ?>"
                                            class="nav-link"><?= Yii::$app->user->identity['email'] ?> (Logout)</a></li>
                <?php endif ?>
            </ul>
        </div>
    </header>
    <section class="content">
        <?= $content ?>
    </section>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>