<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

if($errors !== null){
    echo '<pre>';
    var_dump($errors);
}

/* @var $this yii\web\View */
/* @var $model common\models\Contents */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contents-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->widget(\yii\redactor\widgets\Redactor::className(), [
        'clientOptions' => [
            'imageUpload' => \yii\helpers\Url::to(['/redactor/upload/image']),
        ],
    ]) ?>

    <?= $form->field($model, 'user_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Users::find()->all(), 'id', 'username'),
        ['prompt' => Yii::t('app', 'Select an user')]) ?>

    <?= $form->field($model, 'course_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Courses::find()->all(), 'id', 'name'),
        ['prompt' => Yii::t('app', 'Select a course')]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
