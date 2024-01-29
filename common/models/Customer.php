<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property int $id
 * @property int $book_id
 * @property int $user_id
 * @property int $get_date
 * @property int $final_date
 * @property int $submission
 * @property int $inventory_number
 * @property string $created_at
 * @property string $updated_at
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer';
    }


    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => \yii\behaviors\TimestampBehavior::class,
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    // before save get date to timestamp
    public function beforeSave($insert)
    {

          if (parent::beforeSave($insert)) {
            if ($this->isNewRecord){
            $this->get_date = strtotime($this->get_date);
            $this->final_date = strtotime($this->final_date);
            }
            return true;
          }
        return false;
    }

 
    /**
     * {@inheritdoc}
     */

    // public function init()
    // {
    //     parent::init();

    //     // Set the default value to today's date
    //     $this->get_date = date('Y-m-d'); // Change the date format as needed

    //     // final date is 7 days after get date
    //     $this->final_date = date('Y-m-d', strtotime($this->get_date. ' + 10 days'));
    // }
    public function rules()
    {
        return [
            [['book_id', 'user_id', 'get_date', 'final_date', 'inventory_number'], 'required'],
            [['book_id', 'user_id', 'submission', 'inventory_number'], 'integer'],
            // field submission is not required
            [['submission'], 'default', 'value' => 0],
            //['get_date', 'compare', 'compareAttribute' => 'final_date', 'operator' => '<'],
            [['get_date', 'final_date'], 'date', 'format' => 'php:Y-m-d'],           
            [['created_at', 'updated_at', 'get_date', 'final_date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'book_id' => 'Kitob IDsi',
            'user_id' => 'Foydalanuvchi IDsi',
            'get_date' => 'Olish vaqti',
            'final_date' => 'Qaytarish vaqti',
            'submission' => 'Qaytarilganmi?',
            'inventory_number' => 'Inventarizatsiya raqami',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getBook()
    {
        return $this->hasOne(Books::className(), ['id' => 'book_id']);
    }
}
