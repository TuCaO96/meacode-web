<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $courses \common\models\Courses[] */

$this->title = Yii::t('app', 'Conteúdos mais curtidos');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="content-rating-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <form action="index.php" method="get">
        <div class="row">
            <div class="col-md-12">
                <input type="hidden" name="r" value="contents-ratings">
                <label>Listar conteúdos por curso</label>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <select name="courseId" class="form-control">
                    <option <?= isset($_GET['courseId']) ? '' : 'selected' ?> disabled>Selecione um curso</option>
                    <?php foreach ($courses as $course): ?>
                        <option <?= isset($_GET['courseId']) && $_GET['courseId'] == $course->id ? 'selected' : '' ?>
                                value="<?= $course->id ?>"><?= $course->name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="row" style="margin-top: 15px">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Listar</button>
            </div>
        </div>
    </form>

    <?php if(isset($_GET['courseId'])):

        $ratingsLeft = \common\models\Contents::find()
            ->select(["contents.id, title AS rating_title, avg(content_rating.score) AS rating, count(content_rating.score) AS qtd"])
            ->join('LEFT JOIN', 'content_rating', 'content_rating.content_id = contents.id')
            ->leftJoin('courses', 'course_id = courses.id')
            ->where('courses.id = ' . $_GET['courseId']);
        $ratingsRight = \common\models\Contents::find()
            ->select(["contents.id, title AS rating_title, avg(content_rating.score) AS rating, count(content_rating.score) AS qtd"])
            ->join('RIGHT JOIN', 'content_rating', 'content_rating.content_id = contents.id')
            ->leftJoin('courses', 'course_id = courses.id')
            ->where('courses.id = ' . $_GET['courseId']);
        $ratings = $ratingsLeft->union($ratingsRight, true)
            ->groupBy('contents.id')
        ->all();

        \yii\helpers\ArrayHelper::multisort($ratings, ['rating', 'qtd'], SORT_DESC);

        ?>
        <div class="row" style="margin-top: 15px">
        <div class="col-md-12">
            <table class="table table-responsive table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Conteúdo</th>
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
    <?php endif; ?>
</div>
