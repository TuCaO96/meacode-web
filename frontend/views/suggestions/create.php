<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Suggestions */

$this->title = Yii::t('app', 'Create Suggestions');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Suggestions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="suggestions-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'errors' => $errors
    ]) ?>

</div>
