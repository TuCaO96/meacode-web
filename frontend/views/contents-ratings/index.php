<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $ratings \common\models\ContentRating[] */

$this->title = Yii::t('app', 'Conteúdos mais curtidos');
$this->params['breadcrumbs'][] = $this->title;
$currentRatingContentId = $ratings[0]->content_id;

?>
<div class="content-rating-index">

    <h1><?= Html::encode($this->title) ?></h1>

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
                            <?= $rating + 1 ?>
                        </td>
                        <td>
                            <?= $rating->rating_title; ?>
                        </td>
                        <td>
                            <?= $rating->rating; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
