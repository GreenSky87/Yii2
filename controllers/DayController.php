<?php
namespace app\controllers;

use app\base\BaseController;
use app\controllers\actions\DayCreateAction;
use app\models\Day;
use yii\web\Controller;


class DayController extends BaseController
{ 
   
    public function actions(){
        return[
            'create'=>['class'=>DayCreateAction::class, 'myName'=>'Dmitriy']
        ];
    }
}