<h1>Регистрация</h1>
<?php
use \yii\widgets\ActiveForm;
?>

<?php if ($model->hasErrors()) {
    foreach ($model->getErrors() as $error): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $error[0] ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endforeach;
} ?>

<?php
$form = ActiveForm::begin([
    'class'=>'form-horizontal',
    'enableClientValidation'=>false
]);
?>

<?= $form->field($model,'username', ['template' => "{label}\n{input}"])->textInput()?>

<?= $form->field($model,'password', ['template' => "{label}\n{input}"])->passwordInput()?>

<?= $form->field($model,'birthdate', ['template' => "{label}\n{input}"])->input('date')?>

<div>
    <button type="submit" class="btn btn-primary">Регистрация</button>
</div>
<br>

<?php
ActiveForm::end();
?>



