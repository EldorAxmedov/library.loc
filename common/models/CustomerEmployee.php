<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "customer_employee".
 *
 * @property int $id
 * @property int $book_id
 * @property int $user_id
 * @property int $get_date
 * @property int $final_date
 * @property int $submission
 * @property int $inventory_number
 * @property int $created_at
 * @property int $updated_at
 */
class CustomerEmployee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer_employee';
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
