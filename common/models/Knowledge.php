<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "knowledge".
 *
 * @property int $id
 * @property string $name
 *
 * @property BookKnowledge[] $bookKnowledges
 */
class Knowledge extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'knowledge';
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
     * Gets query for [[BookKnowledges]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBookKnowledges()
    {
        return $this->hasMany(BookKnowledge::class, ['knowledge_id' => 'id']);
    }

    public static function getKnowledgeList()
    {
        return ArrayHelper::map(Knowledge::find()->all(), 'id', 'name');
    }
}
