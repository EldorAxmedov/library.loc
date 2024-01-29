<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property int $book_id
 * @property int $customer_id
 * @property int $get_date
 * @property int $finish_date
 * @property int $submission_date
 * @property int $created_at
 * @property int $updated_at
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
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

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['book_id', 'customer_id', 'get_date', 'finish_date', 'submission_date', 'created_at', 'updated_at'], 'required'],
            [['book_id', 'customer_id', 'get_date', 'finish_date', 'submission_date', 'created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'book_id' => 'Book ID',
            'customer_id' => 'Customer ID',
            'get_date' => 'Get Date',
            'finish_date' => 'Finish Date',
            'submission_date' => 'Submission Date',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
