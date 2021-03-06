<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $courses \common\models\Courses[] */

$this->title = Yii::t('app', 'Cursos mais curtidos');
$this->params['breadcrumbs'][] = $this->title;

/*echo '<pre>';
var_dump(\common\models\CourseRating::find()->all());
die();*/

$ratingsLeft = \common\models\Courses::find()
    ->select(['courses.id, courses.name AS rating_title, avg(course_rating.score) AS rating, count(course_rating.score) AS qtd'])
    ->join('LEFT JOIN', 'course_rating', 'course_rating.course_id = courses.id');
$ratingsRight = \common\models\Courses::find()
    ->select(['courses.id, courses.name AS rating_title, avg(course_rating.score) AS rating, count(course_rating.score) AS qtd'])
    ->join('RIGHT JOIN', 'course_rating', 'course_rating.course_id = courses.id');
$ratings = $ratingsLeft->union($ratingsRight, true)
    ->groupBy('courses.id')
    ->all();

\yii\helpers\ArrayHelper::multisort($ratings, ['rating', 'qtd'], SORT_DESC);

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
                        <th>Qtd. Usuários</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($ratings as $i => $rating): ?>
                    <?php if (!is_null($rating->rating_title)): ?>
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
                            <td>
                                <?= $rating->qtd ? $rating->qtd : 'N/A'; ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
