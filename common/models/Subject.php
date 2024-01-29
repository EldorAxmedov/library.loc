<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "subject".
 *
 * @property int $id
 * @property string $name
 *
 * @property BookSubject[] $bookSubjects
 */
class Subject extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subject';
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
     * Gets query for [[BookSubjects]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBookSubjects()
    {
        return $this->hasMany(BookSubject::class, ['subject_id' => 'id']);
    }

    public static function getSubjectList()
    {
        return ArrayHelper::map(Subject::find()->all(), 'id', 'name');
    }
}
