<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Comment;

?>

    <section class="article-block">
        <h2><?= $article->title ?></h2>
        <p><?= $article->author ?></p>
        <p><?= Html::img("@web/uploads/$article->preview", ['alt' => 'My logo', 'width' => '400px']) ?></p>
        <p><?= $article->text ?></p>
    </section>
<?php
if ($article->allow_comments) {
    if (!Yii::$app->user->isGuest) { ?>
        <section class="comments-block">
            <?php
            $form = ActiveForm::begin(['class' => 'form-horizontal', 'action' => '../comment']);
            ?>
            <?= $form->field($comment, 'text')->textarea(['autofocus' => true, 'rows' => '6', 'cols' => '20']) ?>
            <?= Html::hiddenInput('article_id', $id); ?>
            <?= Html::hiddenInput('user_id', Yii::$app->user->identity['id']); ?>
            <?= Html::hiddenInput('parent_id', 0); ?>
            <div>
                <?= Html::submitButton('Comment', ['class' => 'btn btn-success']) ?>
            </div>
            <?php
            ActiveForm::end();
            ?>
            <h4>Comments</h4>
            <?php

            ?>
            <?php Comment::getForArticle($id); ?>
        </section>
    <?php }
}
?>