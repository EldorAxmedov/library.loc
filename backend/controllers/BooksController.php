<?php

namespace backend\controllers;

use common\models\Books;
use common\models\search\BooksSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Tag;
use common\models\Knowledge;
use common\models\Subject;
use common\models\BookSubject;
use common\models\BookKnowledge;
use common\models\BookTag;
use common\models\Author;
use common\models\BookAuthor;
use common\models\BookInventory;
use yii\filters\AccessControl;
use Yii\web\Response;
use Yii;

/**
 * BooksController implements the CRUD actions for Books model.
 */
class BooksController extends Controller
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
                'access' => [
                    'class' => AccessControl::class,
                    'only' => ['index', 'view', 'create', 'update', 'delete', 'list'],
                    'rules' => [
                        [
                            'actions' => ['index', 'view', 'create', 'update', 'delete', 'list'],
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],

                ],       

            ]
        );
    }

    /**
     * Lists all Books models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new BooksSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Books model.
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
     * Creates a new Books model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Books();        
       
        if ($this->request->isPost) {           
            if ($model->load($this->request->post()) && $model->save()) {
                $model->img = \yii\web\UploadedFile::getInstance($model, 'img');
                if ($model->img && $model->upload()) {
                    $model->img = time() . '.' . $model->img->extension;
                    $model->save();
                }
                if(isset($model->book_author_join)&& !empty($model->book_author_join)){
                    $model->book_author_join = explode(',', $model->book_author_join);
                    
                    foreach ($model->book_author_join as $author_name) {
                        $author = Author::findOne(['full_name' => $author_name]);
                        if ($author!==null) {
                            $bookAuthor = new BookAuthor();
                            $bookAuthor->book_id = $model->id;
                            $bookAuthor->author_id = $author->id;
                            $bookAuthor->save(false);
                        }
                        else {
                            $author = new Author();
                            $author->full_name = $author_name;
                            $author->save();
                            $bookAuthor = new BookAuthor();
                            $bookAuthor->book_id = $model->id;
                            $bookAuthor->author_id = $author->id;
                            $bookAuthor->save(false);
                        }                        
                    }
                }               
                if(isset($model->book_tag_join ) && !empty($model->book_tag_join)){
                    $model->book_tag_join = explode(',', $model->book_tag_join);
                    foreach ($model->book_tag_join as $tag_name) {
                        $tag = Tag::findOne(['name' => $tag_name]);
                        if ($tag!==null) {
                            $bookTag = new BookTag();
                            $bookTag->book_id = $model->id;
                            $bookTag->tag_id = $tag->id;
                            $bookTag->save(false);
                        }
                        else {
                            $tag = new Tag();
                            $tag->name = $tag_name;
                            $tag->save();
                            $bookTag = new BookTag();
                            $bookTag->book_id = $model->id;
                            $bookTag->tag_id = $tag->id;
                            $bookTag->save(false);
                        }                          
                    }
                }                   
             return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }

    /**
     * Updates an existing Books model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $image = $model->img;
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            $model->img = \yii\web\UploadedFile::getInstance($model, 'img');
            if ($model->upload()) {
                if($image !== null){
                if (file_exists(Yii::getAlias('@frontend') . '/web/uploads/books/' . $image)) {
                    if (is_file(Yii::getAlias('@frontend') . '/web/uploads/books/' . $image)) {
                    unlink(Yii::getAlias('@frontend') . '/web/uploads/books/' . $image);
                    }
                }
            }
                $model->img = time() . '.' . $model->img->extension;
                $model->save();
            }
            else {
                $model->img = $image;
                $model->save();
            }

            BookTag::deleteAll(['book_id' => $model->id]);
            if(isset($model->book_tag_join ) && !empty($model->book_tag_join)){
                $model->book_tag_join = explode(',', $model->book_tag_join);
                foreach ($model->book_tag_join as $tag_name) {
                    $tag = Tag::findOne(['name' => $tag_name]);
                    if ($tag!==null) {
                        $bookTag = new BookTag();
                        $bookTag->book_id = $model->id;
                        $bookTag->tag_id = $tag->id;
                        $bookTag->save(false);
                    }
                    else {
                        $tag = new Tag();
                        $tag->name = $tag_name;
                        $tag->save();
                        $bookTag = new BookTag();
                        $bookTag->book_id = $model->id;
                        $bookTag->tag_id = $tag->id;
                        $bookTag->save(false);
                    }                          
                }
            }
            BookAuthor::deleteAll(['book_id' => $model->id]);
            if(isset($model->book_author_join)&& !empty($model->book_author_join)){
                $model->book_author_join = explode(',', $model->book_author_join);
                foreach ($model->book_author_join as $author_name) {
                    $author = Author::findOne(['full_name' => $author_name]);
                    if ($author!==null) {
                        $bookAuthor = new BookAuthor();
                        $bookAuthor->book_id = $model->id;
                        $bookAuthor->author_id = $author->id;
                        $bookAuthor->save(false);
                    }
                    else {
                        $author = new Author();
                        $author->full_name = $author_name;
                        $author->save();
                        $bookAuthor = new BookAuthor();
                        $bookAuthor->book_id = $model->id;
                        $bookAuthor->author_id = $author->id;
                        $bookAuthor->save(false);
                    }                        
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionInventory($id)
    {
       
        $bookCount = Books::findOne($id)->count;
        $oldBookInventory = BookInventory::find()->where(['book_id' => $id])->all();
        if($oldBookInventory== null){
            for ($i=0; $i < $bookCount; $i++) {
                $bookInventory = new BookInventory(); 
                $bookInventory->book_id = $id;
                $bookInventory->inventory_number = $i + 1;
                $bookInventory->save();
            }
        }
        
        $model = BookInventory::find()->where(['book_id' => $id])->all();
        return $this->render('inventory', [
            'model' => $model,
        ]);    
    }

    // public function actionList($query)
    // {

    //     \Yii::$app->response->format = Response::FORMAT_JSON;
    //     $items = [];
    //     $query = urldecode(mb_convert_encoding($query, 'UTF-8'));
    //     foreach (Books::find()->where(['like', 'name', $query])->orWhere(['like', 'isbn', $query])->orWhere(['like', 'udk', $query])->asArray()->all() as $book) {
    //     $items[] = ['book' => $author['name'], 'id' => $author['id']];
    //     }
    //     return $items;
    // }

    public function actionList($query)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $items = [];
        $query = urldecode(mb_convert_encoding($query, 'UTF-8'));
        $item = Books::find()->where(['like', 'name', $query])->orWhere(['like', 'isbn', $query])->orWhere(['like', 'udk', $query])->one();
        if ($item) {
        $item = ['name' => $item->name, 'authors'=>$item->authors, 'category'=>$item->type->name, 'language'=>$item->language->name, 'publish_year'=>$item->year_id, 'pages'=>$item->page, 'img'=>$item->img];
            return $item;
        } else {
            return HTTP_NOT_FOUND;
        }
    }

    /**
     * Deletes an existing Books model.
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
     * Finds the Books model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Books the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Books::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}


