<?php
    use yii\helpers\Url;
?>

<section class="article-block">
    <section class="articles">
        <div class="wrapper">
            <h2 class="header">Feed</h2>
            <?php foreach ($articles as $article) { ?>
                    <a class="article-post" href="<?= Url::to(['/article/' . $article['id']])?>">
                    <div class="article-content">
                        <p class="author"><i><?= $article['users']['name'] ?></i></p>
                        <p class="article-title"><?= $article['title'] ?></p>
                    </div>
                </a>
            <?php } ?>
        </div>
    </section>
</section>