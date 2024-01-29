<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "employee".
 *
 * @property int $id
 * @property string $full_name
 * @property string $short_name
 * @property string $first_name
 * @property string $second_name
 * @property string|null $third_name
 * @property int $gender_code
 * @property string|null $gender_name
 * @property int $birth_date
 * @property string|null $image
 * @property int|null $year_of_enter
 * @property int|null $academic_degree_code
 * @property string|null $academic_degree_name
 * @property int|null $academic_rank_code
 * @property string|null $academic_rank_name
 * @property string|null $tutor_groups
 * @property int|null $department_id
 * @property string|null $department_name
 * @property string|null $department_code
 * @property int|null $department_structure_code
 * @property string|null $department_structure_name
 * @property int|null $department_locality_code
 * @property string|null $department_locality_name
 * @property int|null $department_parent
 * @property int|null $employment_form_code
 * @property string|null $employment_form_name
 * @property int|null $employment_staff_code
 * @property string|null $employment_staff_name
 * @property int|null $staff_position_code
 * @property string|null $staff_position_name
 * @property int|null $employee_status_code
 * @property string|null $employee_status_name
 * @property int|null $employee_type_code
 * @property string|null $employee_type_name
 * @property string|null $contract_number
 * @property string|null $decree_number
 * @property int|null $contract_date
 * @property int|null $decree_date
 * @property int $created_at
 * @property int $updated_at
 * @property string|null $hash
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employee';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['full_name', 'short_name', 'first_name', 'second_name', 'gender_code', 'employee_id_number', 'birth_date', 'created_at', 'updated_at'], 'required'],
            [['gender_code', 'birth_date', 'year_of_enter', 'academic_degree_code', 'academic_rank_code', 'department_id', 'department_structure_code', 'department_locality_code', 'department_parent', 'employment_form_code', 'employment_staff_code', 'staff_position_code', 'employee_status_code', 'employee_type_code', 'contract_date', 'decree_date', 'created_at', 'updated_at'], 'integer'],
            [['full_name'], 'string', 'max' => 300],
            [['short_name', 'first_name', 'second_name', 'third_name', 'employee_id_number', 'gender_name', 'academic_degree_name', 'academic_rank_name', 'tutor_groups', 'department_name', 'department_code', 'department_structure_name', 'department_locality_name', 'employment_form_name', 'employment_staff_name', 'staff_position_name', 'employee_status_name', 'employee_type_name', 'contract_number', 'decree_number', 'hash'], 'string', 'max' => 255],
            [['image'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'full_name' => 'Full Name',
            'short_name' => 'Short Name',
            'first_name' => 'First Name',
            'second_name' => 'Second Name',
            'third_name' => 'Third Name',
            'gender_code' => 'Gender Code',
            'gender_name' => 'Gender Name',
            'birth_date' => 'Birth Date',
            'image' => 'Image',
            'year_of_enter' => 'Year Of Enter',
            'academic_degree_code' => 'Academic Degree Code',
            'academic_degree_name' => 'Academic Degree Name',
            'academic_rank_code' => 'Academic Rank Code',
            'academic_rank_name' => 'Academic Rank Name',
            'tutor_groups' => 'Tutor Groups',
            'department_id' => 'Department ID',
            'department_name' => 'Department Name',
            'department_code' => 'Department Code',
            'department_structure_code' => 'Department Structure Code',
            'department_structure_name' => 'Department Structure Name',
            'department_locality_code' => 'Department Locality Code',
            'department_locality_name' => 'Department Locality Name',
            'department_parent' => 'Department Parent',
            'employment_form_code' => 'Employment Form Code',
            'employment_form_name' => 'Employment Form Name',
            'employment_staff_code' => 'Employment Staff Code',
            'employment_staff_name' => 'Employment Staff Name',
            'staff_position_code' => 'Staff Position Code',
            'staff_position_name' => 'Staff Position Name',
            'employee_status_code' => 'Employee Status Code',
            'employee_status_name' => 'Employee Status Name',
            'employee_type_code' => 'Employee Type Code',
            'employee_type_name' => 'Employee Type Name',
            'contract_number' => 'Contract Number',
            'decree_number' => 'Decree Number',
            'contract_date' => 'Contract Date',
            'decree_date' => 'Decree Date',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'hash' => 'Hash',
        ];
    }
}
