<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\search\UserSearches */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Termos Mais Buscados');
$this->params['breadcrumbs'][] = $this->title;

$userSearches = \common\models\UserSearches::find()
    ->select(['search_query', 'count(search_query) AS count_query'])
    ->groupBy('search_query')
    ->orderBy(['count_query' => SORT_DESC])
    ->all();

?>
<div class="user-searches-index">
    <table class="table table-bordered table-responsive">
        <thead>
            <tr>
                <th><?= Yii::t('app', 'Termo') ?></th>
                <th><?= Yii::t('app', 'Quantidade') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($userSearches as $search): ?>
                <tr>
                    <td><?= $search->search_query ?></td>
                    <td><?= $search->count_query ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
