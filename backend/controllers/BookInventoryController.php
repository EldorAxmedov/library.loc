<?php

namespace backend\controllers;

use common\models\BookInventory;
use common\models\Books;
use common\models\search\BookInventorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii\web\Response;
use Yii;

/**
 * BookInventoryController implements the CRUD actions for BookInventory model.
 */
class BookInventoryController extends Controller
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
     * Lists all BookInventory models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new BookInventorySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionInventory($id)
    {
       
        $bookCount = Books::findOne($id)->count;
        // echo "<pre>";
        // print_r($bookCount);
        // die();
        $book = Books::findOne($id);
        $oldBookInventory = BookInventory::find()->where(['book_id' => $id])->all();
        if($oldBookInventory== null){
            for ($i=0; $i < $bookCount; $i++) {
                $bookInventory = new BookInventory();
                $bookInventory->book_id = $id;
                $bookInventory->inventory_number = intval($book->inventory_number)+$i+time();
                $bookInventory->save();
            }
        }
        else{
            $oldBookInventoryCount = count($oldBookInventory);
            if($oldBookInventoryCount < $bookCount){
                for ($i=$oldBookInventoryCount; $i < $bookCount; $i++) {
                    $bookInventory = new BookInventory(); 
                    $bookInventory->book_id = $id;
                    $bookInventory->inventory_number = $oldBookInventory[$i - $oldBookInventoryCount]->inventory_number + $i + time();
                    $bookInventory->save();
                }
            }
            else{
                for ($i=$bookCount; $i < $oldBookInventoryCount; $i++) {
                    $oldBookInventory[$i]->delete();
                }
            }
        }
        
        //$model = BookInventory::find()->where(['book_id' => $id])->all();
        return $this->redirect(['index']);
    }

    /**
     * Displays a single BookInventory model.
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

    public function actionList($query)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $items = [];
        $query = urldecode(mb_convert_encoding($query, 'UTF-8'));
        $item = BookInventory::find()->where(['inventory_number' => $query])->one();
        
        if ($item) {
            if ($item->status == 1) {
                // Return a custom error response for status 1
                Yii::$app->response->setStatusCode(400); // You can use any HTTP status code you prefer.
                return ['error' => 'Custom error message for status 1'];
            } else {
                // Return the item as JSON
                $itemData = [
                    'inventory_number' => $item->inventory_number,
                    'book_id' => $item->book->id,
                    'name' => $item->book->name,
                    'authors' => $item->book->authors,
                    'category' => $item->book->type->name,
                    'language' => $item->book->language->name,
                    'publish_year' => $item->book->year_id,
                    'pages' => $item->book->page,
                    'img' => $item->book->img,
                ];
                return $itemData;
            }
        } else {
            // Return a 404 Not Found response for items not found
            Yii::$app->response->setStatusCode(404);
            return ['error' => 'Item not found'];
        }
    }
    /**
     * Creates a new BookInventory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    // public function actionCreate()
    // {
    //     $model = new BookInventory();

    //     if ($this->request->isPost) {
    //         if ($model->load($this->request->post()) && $model->save()) {
    //             return $this->redirect(['view', 'id' => $model->id]);
    //         }
    //     } else {
    //         $model->loadDefaultValues();
    //     }

    //     return $this->render('create', [
    //         'model' => $model,
    //     ]);
    // }

    /**
     * Updates an existing BookInventory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    // public function actionUpdate($id)
    // {
    //     $model = $this->findModel($id);

    //     if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
    //         return $this->redirect(['view', 'id' => $model->id]);
    //     }

    //     return $this->render('update', [
    //         'model' => $model,
    //     ]);
    // }

    /**
     * Deletes an existing BookInventory model.
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
     * Finds the BookInventory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return BookInventory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BookInventory::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
