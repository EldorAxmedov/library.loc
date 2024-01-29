<?php

namespace backend\modules\synch\controllers;

use yii\web\Controller;
use backend\jobs\SaveFromApiEmployee;
use common\models\Employee;
use common\components\CurlComponent;
use yii\filters\VerbFilter;
use Yii;

/**
 * EmployeeController implements the CRUD actions for Employee model.
 */
class EmployeeController extends Controller
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
     * Lists all Employee models.
     *
     * @return string
     */
    public function actionIndex()
    {   
        
        $paginationCount = $this->paginationCount();       
        
        for($i = 1; $i <= $paginationCount; $i++) {
            $curl = new CurlComponent();
            $curl->setUrl('https://student.samdchti.uz/rest/v1/data/employee-list?type=all&page='.$i);
            $curl->setMethod('GET');
            $curl->setHeaders([
                'Authorization: Bearer OX6BZ7ZtnnNnZLDn8E1n_VFfQUxNjCRG',
            ]);
            // set per page
            $response = $curl->send(); 
            $response = json_decode($response, true);
            $data = $response['data']['items'];
            $this->saveToDatabase($data);
        }
      
    }

    public function paginationCount()
    {
        $curl = new CurlComponent();
        $curl->setUrl('https://student.samdchti.uz/rest/v1/data/employee-list?type=all');
        $curl->setMethod('GET');
        $curl->setHeaders([
            'Authorization: Bearer OX6BZ7ZtnnNnZLDn8E1n_VFfQUxNjCRG',
        ]);
        $response = $curl->send();
        $response = json_decode($response, true);
        return $response['data']['pagination']['pageCount'];
    }
   

  public function saveToDatabase($data)
    {
        foreach ($data as $key => $item) {

            $modelUpdate = new Employee();
            //if ($modelUpdate) {
                $modelUpdate->full_name = $item['full_name'];
                $modelUpdate->short_name = $item['short_name'];
                $modelUpdate->first_name = $item['first_name'];
                $modelUpdate->second_name = $item['second_name'];
                $modelUpdate->third_name = $item['third_name'];
                $modelUpdate->gender_code = $item['gender']['code'];
                $modelUpdate->gender_name = $item['gender']['name'];
                $modelUpdate->birth_date = $item['birth_date'];
                $modelUpdate->employee_id_number = $item['employee_id_number'];
                $modelUpdate->image = $item['image'];
                $modelUpdate->year_of_enter = $item['year_of_enter'];
                $modelUpdate->academic_degree_code = $item['academicDegree']['code'];
                $modelUpdate->academic_degree_name = $item['academicDegree']['name'];
                $modelUpdate->academic_rank_code = $item['academicRank']['code'];
                $modelUpdate->academic_rank_name = $item['academicRank']['name'];
                $modelUpdate->tutor_groups = $item['tutor_groups'];
                $modelUpdate->department_id = $item['department']['id'];
                $modelUpdate->department_name = $item['department']['name'];
                $modelUpdate->department_code = $item['department']['code'];
                $modelUpdate->department_structure_code = $item['department']['structureType']['code'];
                $modelUpdate->department_structure_name = $item['department']['structureType']['name'];
                $modelUpdate->department_locality_code = $item['department']['localityType']['code'];
                $modelUpdate->department_locality_name = $item['department']['localityType']['name'];
                $modelUpdate->department_parent = $item['department']['parent'];
                $modelUpdate->employment_form_code = $item['employmentForm']['code'];
                $modelUpdate->employment_form_name = $item['employmentForm']['name'];
                $modelUpdate->employment_staff_code = $item['employmentStaff']['code'];
                $modelUpdate->employment_staff_name = $item['employmentStaff']['name'];
                $modelUpdate->staff_position_code = $item['staffPosition']['code'];
                $modelUpdate->staff_position_name = $item['staffPosition']['name'];
                $modelUpdate->employee_status_code = $item['employeeStatus']['code'];
                $modelUpdate->employee_status_name = $item['employeeStatus']['name'];
                $modelUpdate->employee_type_code = $item['employeeType']['code'];
                $modelUpdate->employee_type_name = $item['employeeType']['name'];
                $modelUpdate->contract_number = $item['contract_number'];
                $modelUpdate->decree_number = $item['decree_number'];
                $modelUpdate->contract_date = $item['contract_date'];
                $modelUpdate->decree_date = $item['decree_date'];
                $modelUpdate->created_at = $item['created_at'];
                $modelUpdate->updated_at = $item['updated_at'];
                $modelUpdate->hash = $item['hash'];
                $modelUpdate->save();
                if ($modelUpdate->hasErrors()) {
                    echo '<pre>';
                    print_r($item['employee_id_number']);
                    print_r($modelUpdate->getErrors());
                }
            }
        }

}
