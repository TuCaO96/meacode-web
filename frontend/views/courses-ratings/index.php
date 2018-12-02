<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $courses \common\models\Courses[] */

$this->title = Yii::t('app', 'Cursos mais curtidos');
$this->params['breadcrumbs'][] = $this->title;

$ratingsLeft = \common\models\Courses::find()->select(['courses.name AS rating_title, avg(course_rating.score)',])
    ->join('LEFT JOIN', 'course_rating', 'course_rating.course_id = courses.id');
$ratingsRight = \common\models\Courses::find()->select(['courses.name AS rating_title, avg(course_rating.score)',])
    ->join('LEFT JOIN', 'course_rating', 'course_rating.course_id = courses.id');
$ratings = $ratingsLeft->union($ratingsRight)
    ->groupBy('courses.id')
    ->orderBy(['avg(course_rating.score)' => SORT_DESC])
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
                            <?= $i + 1 ?>
                        </td>
                        <td>
                            <?= $rating->rating_title; ?>
                        </td>
                        <td>
                            <?= $rating->rating ? number_format(($rating->rating * 20), 2, ',', '.') . '%' : 'N/A'; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
