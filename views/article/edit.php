<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<h2>Edit article <?= $id ?></h2>
<?php
$form = ActiveForm::begin(['action' => ["article/$id"], 'class' => 'form-horizontal']);
?>

<?= $form->field($model, 'id')->textInput(['readonly' => true]) ?>
<?= $form->field($model, 'title')->textInput(['autofocus' => true]) ?>
<?= $form->field($model, 'text')->textInput() ?>
<?= $form->field($model, 'preview')->textInput(['readonly' => true]) ?>
<?= Html::hiddenInput('Article[author]', Yii::$app->user->identity['id']) ?>
<?= $form->field($model, 'allow_comments')->checkbox() ?>

<div>
    <?= Html::submitButton('Update', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end() ?>
