<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<h2>Sign Up</h2>
<?php $form = ActiveForm::begin(['class' => 'form-horizontal']); ?>
<?= $form->field($model, 'email')->textInput(['autofocus' => true]); ?>
<?= $form->field($model, 'name')->textInput(); ?>
<?= $form->field($model, 'password')->passwordInput(); ?>

<div>
    <?= Html::submitButton('Sign Up', ['class' => 'btn btn-success']) ?>
</div>

<?php
ActiveForm::end();
?>
