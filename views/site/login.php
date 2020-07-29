


<h1>Логин</h1>
<?php
use yii\widgets\ActiveForm;
?>
<?php $form = ActiveForm::begin();?>

<?= $form->field($login_model,'username')->textInput()?>

<?= $form->field($login_model,'password')->passwordInput()?>

<div>
    <button class="btn btn-success" type="submit">Вход</button>
</div>

<?php $form = ActiveForm::end();?>
<br>
<div>
    <a class="btn btn-success" href="/site/signup">Регистрация</a>
</div>
