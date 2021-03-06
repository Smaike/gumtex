<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ServiceTime as ServiceTimeModel;

/**
 * ServiceTime represents the model behind the search form about `app\models\ServiceTime`.
 */
class ServiceTimeSearch extends ServiceTimeModel
{
    public $type_id;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_service', 'type_id'], 'integer'],
            [['date_start', 'date_end'], 'safe'],
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

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ServiceTimeModel::find();

        $query->joinWith(['service']);

        

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->andWhere([
            'services.type_id' => $this->type_id,
        ]);
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_service' => $this->id_service,
            'date_start' => $this->date_start,
            'date_end' => $this->date_end,
        ]);

        return $dataProvider;
    }
}
