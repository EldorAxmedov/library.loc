<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii\web\Response;
use common\models\Students;
use common\models\Customer;
use yii\filters\AccessControl;

class StudentController extends Controller{

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
                    'only' => ['get-me'],
                    'rules' => [
                        [
                            'actions' => ['get-me'],
                            'allow' => true,
                            'roles' => ['admin'],
                        ],
                    ],

                ],       

            ]
        );
    }

    public function actionGetMe($query)
    {
        // cors filter
        $headers = Yii::$app->response->headers;
        $headers->add('Access-Control-Allow-Origin', '*');
        $headers->add('Access-Control-Allow-Headers', 'X-Requested-With');
        $headers->add('Access-Control-Allow-Methods', 'GET');

        \Yii::$app->response->format = Response::FORMAT_JSON;
        $items = [];
        $query = urldecode(mb_convert_encoding($query, 'UTF-8'));
        $item = Students::find()->where(['student_id' => $query])->one();

        if ($item) {
            $debt = Customer::find()->where(['user_id' => $item->student_id])->all();
            $all_debts = [];

            foreach ($debt as $key => $value) {
                if ($value->submission == 0) {
                    $all_debts[] = $value;
                }
            }

            if ($all_debts) {
                return ['error' => 'Foydalanuvchida qarzdorlik mavjud'];
            }

            return $item;
        } else {
            return ['error' => 'Foydalanuvchi topilmadi'];
        }
    }

}

