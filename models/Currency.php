<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "currencies".
 *
 * @property integer $id
 * @property string $name
 * @property string $abbreviation
 *
 * @property ExchangeRates[] $exchangeRates
 * @property ExchangeRates[] $exchangeRates0
 */
class Currency extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'currencies';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'abbreviation'], 'required'],
            [['name'], 'string', 'max' => 100],
            [['abbreviation'], 'string', 'max' => 3],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExchangeRates()
    {
        return $this->hasMany(ExchangeRates::className(), ['base_currency_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExchangeRatesQuoted()
    {
        return $this->hasMany(ExchangeRates::className(), ['quoted_currency_id' => 'id']);
    }
}
