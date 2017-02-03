<?php
    use scotthuangzl\googlechart\GoogleChart;
    use yii\bootstrap\ActiveForm;
    use yii\helpers\Html;
    use yii\helpers\ArrayHelper;
    $this->title = 'Exchange Rates Graph';
?>

<div>
    <div class="marg">
    <h1><?= $activeCurrency->name?></h1>
    <br/>
    <?php
        $form = ActiveForm::begin(['id' => 'currency-form']);
        echo Html::dropDownList(
                    'currency_id', '', ArrayHelper::map($currencies, 'id', 'abbreviation'),
                    ['prompt'=> 'Select another currency...', 'onchange' => 'this.form.submit();']
        );
        ActiveForm::end();
    ?>
    </div>
    <?php echo GoogleChart::widget([
                'visualization' => 'LineChart',
                'data' => $data,
                'options' => [
                    'width' => 800,
                    'height' => 350,
                    'curveType' => 'function',
                    'vAxis' =>[
                        'title' => 'Exchange Rate',
                        'baselineColor' => 'black'
                    ],
                    'hAxis' =>[
                        'title' => 'Date'
                    ]
                ]
            ]
        );?>
</div>

