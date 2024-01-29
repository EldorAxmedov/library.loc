<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "students".
 *
 * @property int $id
 * @property string $full_name
 * @property string $short_name
 * @property string $first_name
 * @property string $second_name
 * @property string $third_name
 * @property int $gender_code
 * @property string $gender_name
 * @property int $birth_date
 * @property string $student_id
 * @property string $image
 * @property int $avg_gpa
 * @property int $total_credit
 * @property string $address
 * @property int $province_code
 * @property string $province_name
 * @property int $district_code
 * @property string $district_name
 * @property int $student_status_code
 * @property string $student_status_name
 * @property int $education_form_code
 * @property string $education_form_name
 * @property int $education_type_code
 * @property string $education_type_name
 * @property int $payment_form_code
 * @property string $payment_form_name
 * @property int $student_type_code
 * @property string $student_type_name
 * @property int $social_category_code
 * @property string $social_category_name
 * @property int $department_id
 * @property string $department_name
 * @property string $department_code
 * @property int $department_type_code
 * @property string $department_type_name
 * @property int $speciality_id
 * @property int $speciality_code
 * @property string $speciality_name
 * @property int $group_id
 * @property string $group_name
 * @property int $level_code
 * @property string $level_name
 * @property int $semester_id
 * @property string $semester_code
 * @property string $semester_name
 * @property int $semester_current
 * @property int $semester_education_year_code
 * @property string $semester_education_year_name
 * @property int $semester_education_year_current
 * @property int $education_year_code
 * @property string $education_year_name
 * @property int $education_year_current
 * @property int $created_at
 * @property int $updated_at
 */
class Students extends \yii\db\ActiveRecord
{

    CONST SOCIAL_CATEGORY_NOT_IN = 10;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'students';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['full_name', 'short_name', 'first_name', 'second_name', 'gender_code', 'gender_name', 'birth_date', 'student_id', 'avg_gpa', 'total_credit', 'address', 'province_code', 'province_name', 'district_code', 'district_name', 'student_status_code', 'student_status_name', 'education_form_code', 'education_form_name', 'education_type_code', 'education_type_name', 'payment_form_code', 'payment_form_name', 'student_type_code', 'student_type_name', 'social_category_code', 'social_category_name', 'department_id', 'department_name', 'department_code', 'group_id', 'group_name', 'level_code', 'level_name', 'semester_code', 'semester_name', 'education_year_code', 'education_year_name'], 'required'],
            [['gender_code', 'birth_date', 'avg_gpa', 'total_credit', 'province_code', 'district_code', 'student_status_code', 'education_form_code', 'education_type_code', 'payment_form_code', 'student_type_code', 'social_category_code', 'department_id', 'department_type_code', 'speciality_id', 'speciality_code', 'group_id', 'level_code', 'semester_id', 'semester_current', 'semester_education_year_code', 'semester_education_year_current',  'education_year_current', 'created_at', 'updated_at'], 'integer'],
            [['full_name', 'province_name', 'district_name', 'speciality_name'], 'string', 'max' => 300],
            [['short_name', 'first_name', 'second_name', 'third_name', 'gender_name', 'student_status_name', 'student_id', 'education_form_name', 'education_type_name', 'payment_form_name', 'student_type_name', 'social_category_name', 'department_name', 'department_code', 'department_type_name', 'group_name', 'level_name', 'semester_code', 'semester_name', 'semester_education_year_name', 'education_year_name'], 'string', 'max' => 255],
            [['image', 'address'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'full_name' => 'F.I.O',
            'short_name' => 'F.I.O qisqacha',
            'first_name' => 'Ismi',
            'second_name' => 'Familiyasi',
            'third_name' => 'Otasining ismi',
            'gender_code' => 'Gender Code',
            'gender_name' => 'Jinsi',
            'birth_date' => "Tug'ilgan sana",
            'student_id' => 'Talaba ID raqami',
            'image' => 'Rasmi',
            'avg_gpa' => 'Gpa bali',
            'total_credit' => 'Jami kredit',
            'address' => 'Manzil',
            'province_code' => 'Province Code',
            'province_name' => 'Viloyat',
            'district_code' => 'District Code',
            'district_name' => 'Tuman',
            'student_status_code' => 'Student Status Code',
            'student_status_name' => 'Student Status Name',
            'education_form_code' => 'Education Form Code',
            'education_form_name' => 'Education Form Name',
            'education_type_code' => 'Education Type Code',
            'education_type_name' => 'Education Type Name',
            'payment_form_code' => 'Payment Form Code',
            'payment_form_name' => 'Payment Form Name',
            'student_type_code' => 'Student Type Code',
            'student_type_name' => 'Student Type Name',
            'social_category_code' => 'Social Category Code',
            'social_category_name' => 'Ijtimoiy holati',
            'department_id' => 'Department ID',
            'department_name' => 'Fakultet',
            'department_code' => 'Department Code',
            'department_type_code' => 'Department Type Code',
            'department_type_name' => 'Department Type Name',
            'speciality_id' => 'Speciality ID',
            'speciality_code' => 'Speciality Code',
            'speciality_name' => 'Mutaxassisligi',
            'group_id' => 'Group ID',
            'group_name' => 'Guruh',
            'level_code' => 'Level Code',
            'level_name' => 'Level Name',
            'semester_id' => 'Semester ID',
            'semester_code' => 'Semester Code',
            'semester_name' => 'Semester',
            'semester_current' => 'Semester Current',
            'semester_education_year_code' => 'Semester Education Year Code',
            'semester_education_year_name' => 'Semester Education Year Name',
            'semester_education_year_current' => 'Semester Education Year Current',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    /**
     * {@inheritdoc}
     */


    public static function getRegionList($district_name = false){
        $query = Students::find()->select('province_name')->distinct()->orderBy('province_name')->all();
        $result = ArrayHelper::map($query, 'province_name', 'province_name');
        return $result;
    }
    public static function getFacultyList($department_name = false){
        $query = Students::find()->select('department_name')->distinct()->all();
        $result = ArrayHelper::map($query, 'department_name', 'department_name');
        return $result;
    }

    public static function getSocialCategoryList(){
        $query = Students::find()->where(['not in', 'social_category_code', self::SOCIAL_CATEGORY_NOT_IN])->distinct()->asArray()->all();
        $result = ArrayHelper::map($query, 'social_category_code', 'social_category_name');
        return $result;
    }

    public static function getSocialCategoryIdList(){
        return array_keys(self::getSocialCategoryList());

    }


}
