<?php use yii\helpers\Url; ?>

<section class="article-block">
    <section class="articles">
        <div class="wrapper">
            <div class="top-panel">
                <h2 class="header">My blog</h2>
                <div class="create-btn">
                    <a class="create-btn-link" href="<?= Url::to(['/article/create']) ?>">New article</a>
                </div>
            </div>
            <?php foreach ($articles as $article) { ?>
                <a class="article-post" href="<?= Url::to(['/article/' . $article['id']])?>">
                    <div class="article-content">
                        <p class="author"><?= \Yii::$app->user->identity['name'] ?></p>
                        <p class="article-title"><?= $article['title'] ?></p>
                    </div>
                    <a href="<?= Url::to(['/article/' . $article['id'] . '/edit'])?>">edit</a>
                    <a href="<?= Url::to(['/article/' . $article['id'] . '/delete'])?>">delete</a>
                </a>
            <?php } ?>
        </div>
    </section>
</section>