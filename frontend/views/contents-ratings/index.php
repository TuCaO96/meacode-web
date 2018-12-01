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
        <div class="row form-group">
            <label>Listar conteúdos por curso</label>
            <select name="courseId" class="form-control">
                <option <?= isset($_GET['courseId']) ? '' : 'selected' ?> disabled>Selecione um curso</option>
                <?php foreach ($courses as $course): ?>
                    <option <?= isset($_GET['courseId']) && $_GET['courseId'] == $course->id ? 'selected' : '' ?>
                            value="<?= $course->id ?>"><?= $course->name ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="row form-group">
            <button type="submit" class="btn btn-primary">Listar</button>
        </div>
    </form>

    <?php if(isset($_GET['courseId'])):

    $ratings = \common\models\ContentRating::find()->select(['contents.title AS rating_title, avg(score) AS rating',])
        ->join('JOIN', 'contents', 'contents.id = content_id')
        ->leftJoin('courses', 'contents.course_id = '. $_GET['courseId'])
        ->groupBy('content_id')
        ->orderBy(['avg(score)' => SORT_DESC])
        ->all();
    ?>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-responsive table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Conteúdo</th>
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
                            <?= number_format(($rating->rating * 20), 2, ',', '.'); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endif; ?>
</div>
