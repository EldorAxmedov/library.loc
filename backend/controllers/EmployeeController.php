<?php
namespace backend\controllers;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii\web\Response;
use yii\base\Yii;
use common\models\Employee;
use common\models\CustomerEmployee;
use yii\filters\AccessControl;

class EmployeeController extends Controller{

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
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $items = [];
        $query = urldecode(mb_convert_encoding($query, 'UTF-8'));
        $item = Employee::find()->where(['employee_id_number'=>$query])->one();
        $debt = CustomerEmployee ::find()->where(['user_id'=>$item->employee_id_number])->all();
        $all_debts = [];
            foreach ($debt as $key => $value) {
                    if ($value->submission == 0) {
                       $all_debts[] = $value;
                    }                   
                }  
        if ($item) {
            if ($all_debts) {
                return ['error' => 'Xodimda qarzdorlik mavjud'];            
             } 
                return $item;
                
           } else{
            return ['error' => 'Xodim topilmadi'];
        }    
       
    }

}

?>