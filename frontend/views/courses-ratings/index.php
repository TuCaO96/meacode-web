<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $courses \common\models\Courses[] */

$this->title = Yii::t('app', 'Cursos mais curtidos');
$this->params['breadcrumbs'][] = $this->title;

$ratings = \common\models\CourseRating::find()->select(['courses.name AS rating_title, avg(score) AS rating',])
    ->join('JOIN', 'courses', 'courses.id = course_id')
    ->groupBy('course_id')
    ->orderBy(['avg(score)' => SORT_DESC])
    ->all();

?>
<div class="content-rating-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-responsive table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Curso</th>
                        <th>Avaliação</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($ratings as $i => $rating): ?>
                    <tr>
                        <td>
                            <?= $rating + 1 ?>
                        </td>
                        <td>
                            <?= $rating->rating_title; ?>
                        </td>
                        <td>
                            <?= number_format(($rating->rating * 20), 2, ',', '.'); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
