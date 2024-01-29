<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Books;

/**
 * BooksSearch represents the model behind the search form of `common\models\Books`.
 */
class BooksSearch extends Books
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'year_id', 'page', 'exemplary', 'language_id', 'type_id', 'count', 'location_id', 'created_at', 'updated_at'], 'integer'],
            [['isbn', 'udk', 'bbk', 'name', 'another_name', 'annotation', 'inventory_number'], 'safe'],
            [['price'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Books::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'year_id' => $this->year_id,
            'page' => $this->page,
            'exemplary' => $this->exemplary,
            'language_id' => $this->language_id,
            'type_id' => $this->type_id,
            'price' => $this->price,
            'count' => $this->count,
            'location_id' => $this->location_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'isbn', $this->isbn])
            ->andFilterWhere(['like', 'udk', $this->udk])
            ->andFilterWhere(['like', 'bbk', $this->bbk])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'another_name', $this->another_name])
            ->andFilterWhere(['like', 'annotation', $this->annotation])
            ->andFilterWhere(['like', 'inventory_number', $this->inventory_number]);

        return $dataProvider;
    }
}
