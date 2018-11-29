<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\Suggestions */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Suggestions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="suggestions-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


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

            ['class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'width: 8.7%'],
                'buttons'=>[
                    'view' => function ($url, $model) {
                        $t = 'index.php?r=suggestions/view&id='.$model->id;
                        return Html::a('<i class="glyphicon glyphicon-eye-open"></i>', $t);
                    },
                    'update' => function ($url, $model) {
                        return '';
                    }
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
