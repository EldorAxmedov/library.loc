<?php

namespace backend\jobs;
use common\models\Employee;
use common\components\CurlComponent;
use yii\base\BaseObject;
use Yii;

class SaveFromApiStudent extends BaseObject implements \yii\queue\Job
{
    public $chunk;

    public function execute($queue)
    { 
        foreach ($this->chunk as $key => $i) {
            $curl = new CurlComponent();
            $curl->setUrl('https://student.samdchti.uz/rest/v1/data/employee-list?page=' . $i);
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

    public function saveToDatabase($data)
    {
        foreach ($data as $key => $item) {

            $modelUpdate = Employee::find()->where(['employee_id_number' => $item['employee_id_number']])->one();
            //if ($modelUpdate) {
                $modelUpdate->full_name = $item['full_name'];
                $modelUpdate->short_name = $item['short_name'];
                $modelUpdate->first_name = $item['first_name'];
                $modelUpdate->second_name = $item['second_name'];
                $modelUpdate->third_name = $item['third_name'];
                $modelUpdate->gender_code = $item['gender']['code'];
                $modelUpdate->gender_name = $item['gender']['name'];
                $modelUpdate->birth_date = $item['birth_date'];
                $modelUpdate->student_id = $item['student_id_number'];
                $modelUpdate->image = $item['image'];
                $modelUpdate->year_of_enter = $item['year_of_enter'];
                $modelUpdate->academic_degree_code = $item['academicDegree']['code'];
                $modelUpdate->academic_degree_name = $item['academicDegree']['name'];
                $modelUpdate->academic_rank_code = $item['academic_rank']['code'];
                $modelUpdate->academic_rank_name = $item['academic_rank']['name'];
                $modelUpdate->tutor_groups = $item['tutor_groups'];
                $modelUpdate->department_id = $item['department']['id'];
                $modelUpdate->department_name = $item['department']['name'];
                $modelUpdate->department_code = $item['department']['code'];
                $modelUpdate->department_structure_code = $item['department']['structure']['code'];
                $modelUpdate->department_structure_name = $item['department']['structure']['name'];
                $modelUpdate->department_locality_code = $item['department']['locality']['code'];
                $modelUpdate->department_locality_name = $item['department']['locality']['name'];
                $modelUpdate->department_parent = $item['department']['parent'];
                $modelUpdate->employment_form_code = $item['employment_form']['code'];
                $modelUpdate->employment_form_name = $item['employment_form']['name'];
                $modelUpdate->employment_staff_code = $item['employment_staff']['code'];
                $modelUpdate->employment_staff_name = $item['employment_staff']['name'];
                $modelUpdate->staff_position_code = $item['staff_position']['code'];
                $modelUpdate->staff_position_name = $item['staff_position']['name'];
                $modelUpdate->employee_status_code = $item['employee_status']['code'];
                $modelUpdate->employee_status_name = $item['employee_status']['name'];
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
                    print_r($item['employee_id_number']);
                    print_r($modelUpdate->getErrors());
                }
            }
        }
    }
           



