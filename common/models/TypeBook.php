<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "type_book".
 *
 * @property int $id
 * @property string $name
 *
 * @property Books[] $books
 */
class TypeBook extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'type_book';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[Books]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Books::class, ['type_id' => 'id']);
    }

    public static function getTypeBooks()
    {
        return self::find()->select(['name', 'id'])->indexBy('id')->column();
    }
}
