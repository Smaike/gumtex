<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EmailsHistory;

/**
 * EmailsHistorySearch represents the model behind the search form about `app\models\EmailsHistory`.
 */
class EmailsHistorySearch extends EmailsHistory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'emails_send_id', 'recipient', 'user_id'], 'integer'],
            [['date_send'], 'safe'],
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
        $query = EmailsHistory::find();

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
            'emails_send_id' => $this->emails_send_id,
            'recipient' => $this->recipient,
            'date_send' => $this->date_send,
            'user_id' => $this->user_id,
        ]);

        return $dataProvider;
    }
}
