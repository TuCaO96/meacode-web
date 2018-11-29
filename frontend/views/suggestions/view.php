<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Suggestions */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Suggestions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="suggestions-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Responder', '#', [
                'class' => 'btn btn-primary',
                'data-toggle' => 'modal',
                'data-target' => '#replyModal'
            ]
        ) ?>
        <?= Html::a(Yii::t('app', 'Remover'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Tem certeza que deseja remover esse item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'id',
                'label' => 'ID'
            ],
            [
                'attribute' => 'email',
                'label' => 'Email'
            ],
            [
                'attribute' => 'title',
                'label' => 'Título'
            ],
            [
                'attribute' => 'text',
                'label' => 'Texto'
            ],
        ],
    ]) ?>
</div>
<div class="modal fade" tabindex="-1" id="replyModal" role="dialog" aria-labelledby="replyModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Responder sugestão</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="replyMessage" class="control-label">Mensagem</label>
                            <textarea class="form-control" id="replyMessage"></textarea>
                        </div>
                    </div>
                </div>
                <div hidden id="loadingBarRow" class="row">
                    <div class="col-md-12">
                        <span class="alert alert-info">
                            <i class="fa fa-2x fa-spinner fa-spin"></i>Carregando...
                        </span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" onclick="sendReply()">Enviar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
    function sendReply() {
        var message = $('#replyMessage').val();
        var email = '<?= $model->email ?>';
        var suggestion_text = '<?= $model->text ?>';

        $('#loadingBarRow').show();

        $.post('https://meacodeapp.com.br/api/web/suggestions/send_reply',
            {
                email: email,
                message: message,
                suggestion_text: suggestion_text
            }).then(function onSuccess(data) {
            $('#loadingBar').hide();
                alert('Resposta enviada com sucesso!');
                $('#replyModal').modal('hide');
            }, function onError(error) {
            $('#loadingBar').hide();
                alert('Erro ao enviar resposta ao usuário :(');
                console.error(JSON.stringify(error, null, 4));
            })
    }
</script>
