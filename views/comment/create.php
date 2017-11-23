<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>
<h5>You are going to comment message written by <?= $parent->attributes['user_id'] ?></h5>
<h4><?= $parent->attributes['text'] ?></h4>

<?php
$form = ActiveForm::begin(['action' => '../comment', 'class' => 'form-horizontal']);
?>

<?= $form->field($comment, 'text')->textarea(['autofocus' => true, 'rows' => '6', 'cols' => '20']) ?>
<?= Html::hiddenInput('user_id', Yii::$app->user->identity['id']); ?>
<?= Html::hiddenInput('parent_id', $parent->attributes['id']); ?>
<?= Html::hiddenInput('article_id', $parent->attributes['article_id']); ?>

<div>
    <?= Html::submitButton('Comment', ['class' => 'btn btn-primary']) ?>
</div>

<?php
ActiveForm::end();
?>
