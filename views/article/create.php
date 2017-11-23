<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<h2>Create new article</h2>
<?php
$form = ActiveForm::begin(['class' => 'form-horizontal']);
?>

<?= $form->field($model, 'title')->textInput(['autofocus' => true]) ?>
<?= $form->field($model, 'text')->textInput() ?>
<?= $form->field($model, 'preview')->fileInput(['maxlength' => true]) ?>
<?= Html::hiddenInput('Article[author]', Yii::$app->user->identity['id']) ?>
<?= $form->field($model, 'allow_comments')->checkbox() ?>

<div>
    <?= Html::submitButton('Create', ['class' => 'btn btn-success']) ?>
</div>

<?php
ActiveForm::end();
?>
