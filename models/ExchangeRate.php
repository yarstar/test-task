<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "exchange_rates".
 *
 * @property integer $id
 * @property string $date
 * @property integer $base_currency_id
 * @property integer $quoted_currency_id
 * @property double $rate
 *
 * @property Currencies $baseCurrency
 * @property Currencies $quotedCurrency
 */
class ExchangeRate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'exchange_rates';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'base_currency_id', 'quoted_currency_id', 'rate'], 'required'],
            [['date'], 'safe'],
            [['base_currency_id', 'quoted_currency_id'], 'integer'],
            [['rate'], 'number'],
            [['date', 'base_currency_id', 'quoted_currency_id'], 'unique', 'targetAttribute' => ['date', 'base_currency_id', 'quoted_currency_id'], 'message' => 'The combination of Date, Base Currency ID and Quoted Currency ID has already been taken.'],
            [['base_currency_id'], 'exist', 'skipOnError' => true, 'targetClass' => Currency::className(), 'targetAttribute' => ['base_currency_id' => 'id']],
            [['quoted_currency_id'], 'exist', 'skipOnError' => true, 'targetClass' => Currency::className(), 'targetAttribute' => ['quoted_currency_id' => 'id']],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseCurrency()
    {
        return $this->hasOne(Currency::className(), ['id' => 'base_currency_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuotedCurrency()
    {
        return $this->hasOne(Currency::className(), ['id' => 'quoted_currency_id']);
    }
}
