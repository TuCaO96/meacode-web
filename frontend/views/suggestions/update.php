<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Suggestions */

$this->title = Yii::t('app', 'Atualizar Sugestão: ' . $model->title, [
    'nameAttribute' => '' . $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Suggestions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="suggestions-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'errors' => $errors
    ]) ?>

</div>
