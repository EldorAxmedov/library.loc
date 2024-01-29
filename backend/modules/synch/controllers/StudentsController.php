<?php

namespace backend\modules\synch\controllers;

use yii\web\Controller;
use backend\jobs\SaveFromApiStudent;
use common\components\CurlComponent;
use yii\filters\VerbFilter;
use Yii;

/**
 * StudentsController implements the CRUD actions for Students model.
 */
class StudentsController extends Controller
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
     * Lists all Students models.
     *
     * @return string
     */
    public function actionIndex()
    {       
        $paginationCount = $this->paginationCount();
        $chunkedData  = array_chunk(range(1, $paginationCount), 10);
        foreach ($chunkedData as $chunk) {            
            $queue = Yii::$app->queue->push(new SaveFromApiStudent(['chunk' => $chunk]), 0);
        }
    }

    public function paginationCount()
    {
        $curl = new CurlComponent();
        $curl->setUrl('https://student.samdchti.uz/rest/v1/data/student-list');
        $curl->setMethod('GET');
        $curl->setHeaders([
            'Authorization: Bearer OX6BZ7ZtnnNnZLDn8E1n_VFfQUxNjCRG',
        ]);
        $response = $curl->send();
        $response = json_decode($response, true);
        return $response['data']['pagination']['pageCount'];
    }
   

    public function actionUpdateDb(){

        echo dirname(__FILE__);
    }

}
