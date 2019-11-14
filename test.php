<?php
namespace app\components\test;
use app\components\TBaseWidget;
use imanilchaudhari\CurrencyConverter\CurrencyConverter;

use Yii;
class test extends \yii\base\Widget{
    public $currently = true;
    public $hourly = null;
    public $daily = null;
    public $unit = 'si';
    
    public $url = "https://api.darksky.net/forecast/d4d71efd80cba5452d7ecdc87a942601/30.7046486,76.71787259999999?units=";
    public function init(){
        parent::init();
    }
    public function run(){
        parent::run();
        $weather = file_get_contents($this->url.$this->unit);
        $weatherDecode = json_decode($weather);
        //print_r($weatherDecode); die;
        return $this->render('index', [
            'weather'       =>  $weatherDecode,
            'currently'     =>  $this->currently,
            'unit'          =>  $this->unit,
            'hourly'        =>  $this->hourly,
            'daily'         =>  $this->daily
        ]);
        
    }
}