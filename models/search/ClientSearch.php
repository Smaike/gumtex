<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Client;

/**
 * ClientSearch represents the model behind the search form about `app\models\Client`.
 */
class ClientSearch extends Client
{
    public $service;
    public $time_start;
    public $time_end;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type', 'category', 'age', 'service'], 'integer'],
            [['first_name', 'last_name', 'middle_name', 'birthday', 'mobile', 'p_mobile', 'comment', 'where_know', 'fio_mother', 'fio_father', 'fio_sup', 's_mobile', 'gender', 'time_end', 'time_start', 'email'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'time_start' => 'Время начала',
            'time_end' => 'Время конца',
            'service' => 'Услуга'
        ]);
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
        $query = Client::find();

        // add conditions that should always apply here

        $query->joinWith(['event', 'event.services']);

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
            'birthday' => $this->birthday,
            'type' => $this->type,
            'category' => $this->category,
            'age' => $this->age,
            'services.id' => $this->service,
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'middle_name', $this->middle_name])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'p_mobile', $this->p_mobile])
            ->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'where_know', $this->where_know])
            ->andFilterWhere(['like', 'fio_mother', $this->fio_mother])
            ->andFilterWhere(['like', 'fio_father', $this->fio_father])
            ->andFilterWhere(['like', 'fio_sup', $this->fio_sup])
            ->andFilterWhere(['like', 's_mobile', $this->s_mobile])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['>=', 'events.date', $this->time_start])
            ->andFilterWhere(['<=', 'events.date', $this->time_end]);

        return $dataProvider;
    }
}
