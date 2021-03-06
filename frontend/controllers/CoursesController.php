<?php

namespace frontend\controllers;

use common\models\CourseRating;
use Yii;
use common\models\Courses;
use frontend\models\search\Courses as CoursesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CoursesController implements the CRUD actions for Courses model.
 */
class CoursesController extends Controller
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
     * Lists all Courses models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CoursesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Courses model.
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
     * Creates a new Courses model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Courses();

        if($model->load(Yii::$app->request->post())){
            $model->created_at = date('U');
            $model->updated_at = date('U');

            if ($model->save()) {

                $file = UploadedFile::getInstance($model, 'image_url');
                if(!is_null($file)){
                    $url = 'images/courses/'. $model->id . '.' . $file->extension;
                    $file->saveAs($url);

                    $model->image_url = $url;
                }

                $model->save();

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

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post(), '')) {

            $file = UploadedFile::getInstance($model, 'image_url');
            if(!is_null($file)){
                $url = 'images/courses/'. $id . '.' . $file->extension;
                $file->saveAs($url);

                $model->image_url = 'images/courses/'. $id . '.' . $file->extension;
            }

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
     * Deletes an existing Courses model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $connection = Yii::$app->getDb();
        $model = $connection->createCommand('DELETE from course_rating WHERE course_id = :course_id');
        $model->bindParam(':course_id', $id);
        $model->execute();

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Courses model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Courses the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Courses::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'A página requisitada não existe.'));
    }
}
