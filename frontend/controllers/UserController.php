<?php
namespace frontend\controllers;
use common\models\Customer;
use common\models\Books;
use yii\web\Controller;
use Yii\web\Response;
use yii\web\NotFoundHttpException;
use Yii;


class UserController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::class,
                'only'  => ['get-me'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ]
        ];
    }
    public function actionGetMe(){
        $user = Yii::$app->user->identity;
        $books = Customer::find()->where(['user_id' => 347231103638])->all();
        return $this->render('get-me', 
        [
            'user' => $user,
            'books' => $books,
        ]);
    }

    public function actionGetBook($id){
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $item = Books::findOne($id);
        $items = [];
        if ($item) {
            $item = ['name' => $item->name, 'authors'=>$item->authors, 'category'=>$item->type->name, 'language'=>$item->language->name, 'publish_year'=>$item->year_id, 'pages'=>$item->page, 'img'=>$item->img];
                return $item;
            } else {
                throw new NotFoundHttpException('The requested item could not be found.');
            }
        }
}