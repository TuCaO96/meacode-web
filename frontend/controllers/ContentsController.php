<?php

namespace frontend\controllers;

use Yii;
use common\models\Contents;
use frontend\models\search\Contents as ContentsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ContentsController implements the CRUD actions for Contents model.
 */
class ContentsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Contents models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ContentsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Contents model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Contents model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Contents();

        if($model->load(Yii::$app->request->post())){
            $model->created_at = date('U');
            $model->updated_at = date('U');
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
            else{
                return $this->render('create', [
                    'model' => $model,
                    'errors' => $model->getErrors()
                ]);
            }
        }


        return $this->render('create', [
            'model' => $model,
            'errors' => null
        ]);
    }

    /**
     * Updates an existing Contents model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->updated_at = date('U');
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
            else{
                return $this->render('update', [
                    'model' => $model,
                    'errors' => $model->getErrors()
                ]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'errors' => null
        ]);
    }

    /**
     * Deletes an existing Contents model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $connection = Yii::$app->getDb();
        $model = $connection->createCommand('DELETE from content_rating WHERE content_id = :content_id');
        $model->bindParam(':content_id', $id);
        $model->execute();

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Contents model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Contents the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Contents::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'A página requisitada não existe.'));
    }
}
