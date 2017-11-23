<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

    <h2>Edit comment <?= $id ?></h2>
<?php
$form = ActiveForm::begin(['action' => ["comment/$id"], 'class' => 'form-horizontal']);
?>

<?= $form->field($model, 'id')->textInput(['readonly' => true]) ?>
<?= $form->field($model, 'text')->textarea(['autofocus' => true, 'rows' => '6', 'cols' => '20']) ?>
<?= Html::hiddenInput('article_id', $model->attributes['article_id']); ?>
<?= Html::hiddenInput('user_id', $model->attributes['user_id']); ?>
<?= Html::hiddenInput('parent_id', $model->attributes['parent_id']); ?>

    <div>
        <?= Html::submitButton('Update', ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end() ?>