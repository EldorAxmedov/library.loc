<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "language_book".
 *
 * @property int $id
 * @property string $name
 *
 * @property Books[] $books
 */
class LanguageBook extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'language_book';
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
        return $this->hasMany(Books::class, ['language_id' => 'id']);
    }

    public static function getLanguageBooks()
    {
        return self::find()->select(['name', 'id'])->indexBy('id')->column();
    }
}
