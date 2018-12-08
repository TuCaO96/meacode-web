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

$data = "";

foreach ($userSearches as $search):
    $data .= "['" . $search->search_query . "', " . $search->count_query . "],";
endforeach;

$script = " google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Termo', 'Quantidade de vezes buscado'],";
$script .= $data;

$script .= "]);

        var options = {
            title: 'Termos mais buscados'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }";

$this->registerJs($script);

?>
<div class="user-searches-index">
    <div class="row">
        <div class="col-md-12 col-md-offset-1">
            <div id="piechart" style="width: 1200px; height: 800px;"></div>
        </div>
    </div>
</div>
