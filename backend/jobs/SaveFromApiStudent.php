<?php

namespace backend\jobs;
use common\models\Students;
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
            $curl->setUrl('https://student.samdchti.uz/rest/v1/data/student-list?page=' . $i);
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
        //Yii::$app->db->createCommand('SET SESSION wait_timeout = 5000;')->execute();
        
        foreach ($data as $key => $item) {
            $modelUpdate = Students::find()->where(['student_id' => $item['student_id_number']])->one();
            if ($modelUpdate) {
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
                $modelUpdate->avg_gpa = 1;
                $modelUpdate->total_credit = $item['total_credit'];
                $modelUpdate->address = $item['province']['name'] . ' ' . $item['district']['name'];;
                $modelUpdate->province_code = $item['province']['code'];
                $modelUpdate->province_name = $item['province']['name'];
                $modelUpdate->district_code = $item['district']['code'];
                $modelUpdate->district_name = $item['district']['name'];
                $modelUpdate->student_status_code = $item['studentStatus']['code'];
                $modelUpdate->student_status_name = $item['studentStatus']['name'];
                $modelUpdate->education_form_code = $item['educationForm']['code'];
                $modelUpdate->education_form_name = $item['educationForm']['name'];
                $modelUpdate->education_type_code = $item['educationType']['code'];
                $modelUpdate->education_type_name = $item['educationType']['name'];
                $modelUpdate->payment_form_code = $item['paymentForm']['code'];
                $modelUpdate->payment_form_name = $item['paymentForm']['name'];
                $modelUpdate->student_type_code = $item['studentType']['code'];
                $modelUpdate->student_type_name = $item['studentType']['name'];
                $modelUpdate->social_category_code = $item['socialCategory']['code'];
                $modelUpdate->social_category_name = $item['socialCategory']['name'];
                $modelUpdate->department_id = $item['department']['id'];
                $modelUpdate->department_name = $item['department']['name'];
                $modelUpdate->department_code = $item['department']['code'];
                $modelUpdate->department_type_code = $item['department']['structureType']['code'];
                $modelUpdate->department_type_name = $item['department']['structureType']['name'];
                $modelUpdate->speciality_id = $item['specialty']['id'];
                $modelUpdate->speciality_code = $item['specialty']['code'];
                $modelUpdate->speciality_name = $item['specialty']['name'];
                $modelUpdate->group_id = $item['group']['id'];
                $modelUpdate->group_name = $item['group']['name'];
                $modelUpdate->level_code = $item['level']['code'];
                $modelUpdate->level_name = $item['level']['name'];
                $modelUpdate->semester_id = $item['semester']['id'];
                $modelUpdate->semester_code = $item['semester']['code'];
                $modelUpdate->semester_name = $item['semester']['name'];
                $modelUpdate->semester_current = intval($item['semester']['current']);
                $modelUpdate->semester_education_year_code = $item['semester']['education_year']['code'];
                $modelUpdate->semester_education_year_name = $item['semester']['education_year']['name'];
                $modelUpdate->semester_education_year_current = intval($item['semester']['education_year']['current']);
                $modelUpdate->education_year_code = $item['educationYear']['code'];
                $modelUpdate->education_year_name = $item['educationYear']['name'];
                $modelUpdate->education_year_current = intval($item['educationYear']['current']);
                $modelUpdate->created_at = $item['created_at'];
                $modelUpdate->updated_at = $item['updated_at'];
                $modelUpdate->save();
                if ($modelUpdate->hasErrors()) {
                    print_r($item['student_id_number']);
                    print_r($modelUpdate->getErrors());
                }
            } else {
                $model = new Students();
                $model->full_name = $item['full_name'];
                $model->short_name = $item['short_name'];
                $model->first_name = $item['first_name'];
                $model->second_name = $item['second_name'];
                $model->third_name = $item['third_name'];
                $model->gender_code = $item['gender']['code'];
                $model->gender_name = $item['gender']['name'];
                $model->birth_date = $item['birth_date'];
                $model->student_id = $item['student_id_number'];
                $model->image = $item['image'];
                $model->avg_gpa = 1;
                $model->total_credit = $item['total_credit'];
                $model->address = $item['province']['name'] . ' ' . $item['district']['name'];;
                $model->province_code = $item['province']['code'];
                $model->province_name = $item['province']['name'];
                $model->district_code = $item['district']['code'];
                $model->district_name = $item['district']['name'];
                $model->student_status_code = $item['studentStatus']['code'];
                $model->student_status_name = $item['studentStatus']['name'];
                $model->education_form_code = $item['educationForm']['code'];
                $model->education_form_name = $item['educationForm']['name'];
                $model->education_type_code = $item['educationType']['code'];
                $model->education_type_name = $item['educationType']['name'];
                $model->payment_form_code = $item['paymentForm']['code'];
                $model->payment_form_name = $item['paymentForm']['name'];
                $model->student_type_code = $item['studentType']['code'];
                $model->student_type_name = $item['studentType']['name'];
                $model->social_category_code = $item['socialCategory']['code'];
                $model->social_category_name = $item['socialCategory']['name'];
                $model->department_id = $item['department']['id'];
                $model->department_name = $item['department']['name'];
                $model->department_code = $item['department']['code'];
                $model->department_type_code = $item['department']['structureType']['code'];
                $model->department_type_name = $item['department']['structureType']['name'];
                $model->speciality_id = $item['specialty']['id'];
                $model->speciality_code = $item['specialty']['code'];
                $model->speciality_name = $item['specialty']['name'];
                $model->group_id = $item['group']['id'];
                $model->group_name = $item['group']['name'];
                $model->level_code = $item['level']['code'];
                $model->level_name = $item['level']['name'];
                $model->semester_id = $item['semester']['id'];
                $model->semester_code = $item['semester']['code'];
                $model->semester_name = $item['semester']['name'];
                $model->semester_current = intval($item['semester']['current']);
                $model->semester_education_year_code = $item['semester']['education_year']['code'];
                $model->semester_education_year_name = $item['semester']['education_year']['name'];
                $model->semester_education_year_current = intval($item['semester']['education_year']['current']);
                $model->education_year_code = $item['educationYear']['code'];
                $model->education_year_name = $item['educationYear']['name'];
                $model->education_year_current = intval($item['educationYear']['current']);
                $model->created_at = $item['created_at'];
                $model->updated_at = $item['updated_at'];
                $model->save();
                if ($model->getErrors()) {
                    print_r($item['student_id_number']);
                    print_r($model->getErrors());
                }
            }
        }
    }
}