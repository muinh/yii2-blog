<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>
<h2>Log In</h2>

<?php $form = ActiveForm::begin(); ?>
<?= $form->field($login, 'email')->textInput() ?>
<?= $form->field($login, 'password')->passwordInput() ?>

    <div>
        <?= Html::submitButton('Login', ['class' => 'btn btn-success']) ?>
    </div>
<?php $form = ActiveForm::end(); ?>