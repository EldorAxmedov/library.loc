<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "book_inventory".
 *
 * @property int $id
 * @property int $book_id
 * @property int $inventory_number
 */
class BookInventory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'book_inventory';
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
            [['book_id', 'inventory_number'], 'required'],
            [['book_id', 'inventory_number', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['inventory_number'], 'unique'],
            [['status'], 'default', 'value' => 0],
        ];
    }

    public function getBook()
    {
        return $this->hasOne(Books::class, ['id' => 'book_id']);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'book_id' => 'Kitob ID raqami',
            'inventory_number' => 'Inventar raqami',
        ];
    }
}
