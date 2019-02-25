<?php
namespace app\controllers\actions;
use yii\base\Action;
use app\models\Day;
use app\components\DayComponent;


class DayCreateAction extends Action
{ 
    public $myName;
    public function run(){
        
     
        /** @var DayComponent $comp */
           $comp=\Yii::createObject([
            'class'=>DayComponent::class,
            'day_class'=>Day::class
            ]);
        if(\Yii::$app->request->isPost){
         
            $day = $comp->getModel(\Yii::$app->request->post());
            $comp->createDay($day);
           
        } else {
            $day = $comp->getModel();
        }
    //
        
        return $this->controller->render('create',['day'=>$day]);
    }
}