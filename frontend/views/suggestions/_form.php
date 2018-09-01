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

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'user_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Users::find()->all(), 'id', 'username'),
        ['prompt' => Yii::t('app', 'Select an user')]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
