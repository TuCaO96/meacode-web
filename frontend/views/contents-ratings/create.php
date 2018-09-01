<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ContentRating */

$this->title = Yii::t('app', 'Create Content Rating');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Content Ratings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-rating-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'errors' => $errors
    ]) ?>

</div>
