<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\LoginForm;
use app\models\Currency;
use app\models\ExchangeRate;

/**
 *
 * @author Yaroslav Starovirets <yarstar@mail.ua>
 */
class SiteController extends Controller
{
    /**
     * 404 Error action
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Login action.
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect('index.php?r=site/graph');
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect('index.php?r=site/index');
    }

    /**
     * Shows graph
     */
    public function actionGraph(){

        if(Yii::$app->user->isGuest) $this->redirect('index.php?r=site/index');

        //searching for the active currency
        if(!($currencyId = Yii::$app->request->post('currency_id'))) {
            $activeCurrency = Currency::find()->limit(1)->one();
            $currencyId = $activeCurrency->id;
        } else {
            $activeCurrency = Currency::findOne(['id' => $currencyId]);
        }

        //getting of the list of other currencies
        $currencies = Currency::find()->where(['<>', 'id', $currencyId])->all();

        //exchange rates getting
        $rates = ExchangeRate::find()->where(['base_currency_id' => $currencyId])->orderBy(['date' => SORT_ASC, 'quoted_currency_id' => SORT_ASC])->all();

        //forming of data array for graph
        $data = $this->formDataForGraph($rates, $currencies);

        return $this->render('graph', [
            'currencies' => $currencies,
            'activeCurrency' => $activeCurrency,
            'data' => $data
        ]);
    }

    protected function formDataForGraph($rates, $currencies){

        $checkDate = '';
        $data[] = ['Date', $currencies[0]->abbreviation, $currencies[1]->abbreviation];
        $i = 0;
        foreach($rates as $rate){
            if($rate->date != $checkDate){
                $i++;
                $checkDate = $rate->date;
                $data[$i][] = date("d.m", strtotime($rate->date));
            }

            $data[$i][] = round($rate->rate, 3);
        }

        return $data;
    }
}
