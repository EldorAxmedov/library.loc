<?php

namespace backend\controllers;

use common\models\CustomerEmployee;
use common\models\BookInventory;
use common\models\search\CustomerEmployeeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use Yii\web\Response;
use Yii;

/**
 * CustomerEmployeeController implements the CRUD actions for CustomerEmployee model.
 */
class CustomerEmployeeController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all CustomerEmployee models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new CustomerEmployeeSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CustomerEmployee model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CustomerEmployee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new CustomerEmployee();        

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                $book_inventory = BookInventory::find()->where(['inventory_number' => $model->inventory_number])->one();
                $book_inventory->status = 1;
                $book_inventory->save();

                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionReturnBook($id, $inventory_number)
    { 
        // print_r($inventory_number);
        // die();     
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $model = CustomerEmployee::findOne($id);
        $model->submission = 1;
        $book_inventory = BookInventory::find()->where(['inventory_number' => $inventory_number])->one();
        $book_inventory->status = 0;
        if ($model->save(false) && $book_inventory->save(false)){            
            return ['status' => true];
        }else{
            return ['status' => false, 'errors' => $model->errors];
        }    
        
    }


    public function actionDebt(){
        $searchModel = new CustomerEmployeeSearch();
        // where status = 0
        $dataProvider = $searchModel->debt($this->request->queryParams);      

        return $this->render('debt', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Updates an existing CustomerEmployee model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }



    /**
     * Deletes an existing CustomerEmployee model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CustomerEmployee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return CustomerEmployee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CustomerEmployee::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
