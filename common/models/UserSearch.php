<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * UserSearch represents the model behind the search form about `common\models\User`.
 */
class UserSearch extends User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'regionID', 'status', 'role', 'priceDown', 'addressBookID'], 'integer'],
            [
                [
                    'created_at',
                    'updated_at',
                    'username',
                    'email',
                    'phone',
                    'image',
                    'address',
                    'authKey',
                    'passwordHash',
                    'passwordResetToken',
                    'smsCode',
                    'emailCode'
                ],
                'safe'
            ],
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
        $query = User::find();

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
            'ID' => $this->ID,
            'regionID' => $this->regionID,
            'status' => $this->status,
            'role' => $this->role,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'priceDown' => $this->priceDown,
            'addressBookID' => $this->addressBookID,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'authKey', $this->authKey])
            ->andFilterWhere(['like', 'passwordHash', $this->passwordHash])
            ->andFilterWhere(['like', 'passwordResetToken', $this->passwordResetToken])
            ->andFilterWhere(['like', 'smsCode', $this->smsCode])
            ->andFilterWhere(['like', 'emailCode', $this->emailCode]);

        return $dataProvider;
    }
}
