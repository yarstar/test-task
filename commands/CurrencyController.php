<?php
namespace app\commands;

use Yii;
use yii\console\Controller;
use app\models\Currency;
use app\models\ExchangeRate;
use yii\helpers\Json;


/**
 *
 * @author Yaroslav Starovirets <yarstar@mail.ua>
 */
class CurrencyController extends Controller
{
    protected $url = 'http://api.fixer.io/';
    protected $daysCnt = 10;
    /**
     * This command imports history of currency exchange rates for 10 days until current day from http://fixer.io
     * To perform it from command line use 'yii currency/import'
     */
    public function actionImport()
    {
        Yii::$app->db->createCommand()->truncateTable('exchange_rates')->execute();

        $date = date("Y-m-d");
        $currencies = Currency::find()->all();

        $currenciesAbbr = [];
        foreach ($currencies as $currency){
            $currenciesAbbr[$currency->id] = $currency->abbreviation;
        }

        $addedRowsCnt = 0;
        for($i=1; $i<=$this->daysCnt; $i++){

            foreach($currencies as $currency){

                $url = $this->url.$date.'?base='.$currency->abbreviation;
                $data = Json::decode(file_get_contents($url));
                if(!is_array($data)) continue;
                foreach($currenciesAbbr as $id => $abbr){
                    if($abbr == $currency->abbreviation) continue;
                    $exchangeRate = new ExchangeRate();
                    $exchangeRate->date = $date;
                    $exchangeRate->base_currency_id = $currency->id;
                    $exchangeRate->quoted_currency_id = $id;
                    $exchangeRate->rate = $data['rates'][$abbr];
                    if($exchangeRate->save()) $addedRowsCnt++;
                }
            }
            echo $date." is processed\n";
            $date = date("Y-m-d", strtotime($date) - 60*60*24);
        }
        echo $addedRowsCnt." rows added to database.";
    }
}
