<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Courses */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Courses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="courses-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Remover'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Tem certeza que deseja remover esse item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'id',
                'label' => 'ID'
            ],
            [
                'attribute' => 'name',
                'label' => 'Nome'
            ],
            [
                'attribute' => 'category_id',
                'label' => 'Categoria',
                'value' => function($model) {
                    return $model->category->name;
                }
            ],
            [
                'attribute' => 'image_url',
                'label' => 'Imagem',
                'format' => 'html',
                'value' => function ($model) {
                    return Html::img(Yii::getAlias('@web'). '/' . $model->image_url,
                        ['width' => '120px', 'height' => '120px']);
                },
            ],
        ],
    ]) ?>

</div>
