<?php
namespace app\controllers\actions;
use yii\base\Action;
use app\models\Activity;
use app\components\ActivityComponent;


class ActivityCreateAction extends Action
{ 
    public $myName;
    public function run(){
        
      //  $activity = \Yii::$app->activity->getModel();

       //$activity->title='1';
       //$activity->is_blocked=1;
    
      /*  if(!$activity->validate()){
            echo 'error validate';
            print_r($activity->getErrors());
            exit;
        }*/
           
        /** @var ActivityComponent $comp */
           $comp=\Yii::createObject([
            'class'=>ActivityComponent::class,
            'activity_class'=>Activity::class
            ]);
        if(\Yii::$app->request->isPost){
         
            $activity = $comp->getModel(\Yii::$app->request->post());
            $comp->createActivity($activity);
           // $activity->load(\Yii::$app->request->post());
            
            //$activity->validate();
        } else {
            $activity = $comp->getModel();
        }
    //
        
        return $this->controller->render('create',['activity'=>$activity]);
    }
}