<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

if($errors !== null){
    echo '<pre>';
    var_dump($errors);
}

/* @var $this yii\web\View */
/* @var $model common\models\ContentRating */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="content-rating-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Users::find()->all(), 'id', 'username'),
        ['prompt' => Yii::t('app', 'Selecione um usuário')]) ?>

    <?= $form->field($model, 'content_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Contents::find()->all(), 'id', 'title'),
        ['prompt' => Yii::t('app', 'Selecione um conteúdo')]) ?>

    <?= $form->field($model, 'score')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
