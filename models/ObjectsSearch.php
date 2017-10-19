<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Objects;

/**
 * ObjectsSearch represents the model behind the search form about `app\models\Objects`.
 */
class ObjectsSearch extends Objects
{
    /**
     * @inheritdoc
     */
    public $serviceName;

    public function rules()
    {
        return [
            [['id', 'active', 'sort', 'service_id'], 'integer'],
            [['name', 'reg_date','service'], 'safe'],
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
        $query = Objects::find()->joinWith(['service']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['sort'=>SORT_DESC]]
        ]);
        $dataProvider->setSort([
            'defaultOrder' => [ 'sort' => SORT_DESC],
            'attributes' => [
                'id',
                'name',
                'active',
                'sort',
                'reg_date',
                'serviceName' => [
                    'asc' => ['uslugi.name' => SORT_ASC],
                    'desc' => ['uslugi.name' => SORT_DESC],
                    'label' => 'Название услуги'
                ],

            ]
        ]);
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'objects.id' => $this->id,
            'objects.active' => $this->active,
            'objects.sort' => $this->sort,
            'objects.service_id' => $this->service_id,
            'objects.reg_date' => $this->reg_date,
        ]);


        $query->andFilterWhere(['like', 'objects.name', $this->name]);

        return $dataProvider;
    }
}
