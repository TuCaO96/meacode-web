<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\Contents */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Contents');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contents-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Contents'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'label' => 'ID'
            ],
            [
                'attribute' => 'title',
                'label' => 'Título'
            ],
            [
                'attribute' => 'user_id',
                'label' => 'Usuário',
                'value' => function($model) {
                    return $model->user->username;
                }
            ],
            [
                'attribute' => 'course_id',
                'label' => 'Curso',
                'value' => function($model) {
                    return $model->course->name;
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
