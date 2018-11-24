<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Entrar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Por favor, preencha os seguintes campos para entrar:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true])
                    ->label(Yii::t('app', 'Username'))?>

                <?= $form->field($model, 'password')->passwordInput()
                    ->label(Yii::t('app', 'Password'))?>

                <?= $form->field($model, 'rememberMe')->checkbox()
                    ->label(Yii::t('app', 'Remember Me'))?>

                <div style="color:#999;margin:1em 0">
                    Se esqueceu sua senha, você pode <?= Html::a('atualizá-la', ['site/request-password-reset']) ?>.
                </div>

                <div class="form-group">
                    <?= Html::submitButton('Entrar', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
