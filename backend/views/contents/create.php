<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Contents */

$this->title = Yii::t('app', 'Create Contents');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contents-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
