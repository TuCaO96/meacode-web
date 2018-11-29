<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

if($errors !== null){
    echo '<pre>';
    var_dump($errors);
}

/* @var $this yii\web\View */
/* @var $model common\models\Suggestions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="suggestions-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true])
        ->label('Título')?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6])
        ->label('Texto')?>

    <?/*= $form->field($model, 'user_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Users::find()->all(), 'id', 'username'),
        ['prompt' => Yii::t('app', 'Selecione um usuário')])
        ->label('Usuário')*/?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
