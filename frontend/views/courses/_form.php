<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

if($errors !== null){
    echo '<pre>';
    var_dump($errors);
}

/* @var $this yii\web\View */
/* @var $model common\models\Courses */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="courses-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if(!is_null($model->image_url)): ?>

    <div class="form-group">
        <img width="120px" alt="Imagem do curso" height="120px" src="<?= Yii::getAlias('@web') . '/' . $model->image_url ?>">
    </div>

    <?php endif; ?>

    <?= $form->field($model, 'image_url')->fileInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])
        ->label('Nome')?>

    <?= $form->field($model, 'category_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Categories::find()->all(), 'id', 'name'),
        ['prompt' => Yii::t('app', 'Select a category')])
        ->label('Categoria')?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
