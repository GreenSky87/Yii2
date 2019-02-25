<?php
namespace app\components;

use yii\base\Component;
use app\models\Activity;

class ActivityComponent extends Component
{
    /** @var string class of activity entity */
    public $activity_class;

    public function init(){
        parent::init();

        if(empty($this->activity_class)){
            throw_new \Exception('Need attribute activity_class');
        }
    }

    

    /**
     * @return Activity
     */
    public function getModel($params=null){
        /** @var Activity $model  */ 
        $model=new $this->activity_class;
         if ($params && is_array($params)){
             $model->load($params);
         }

         return $model;
    }

    /** @param $model
     *  @return bool 
     */
    public function createActivity($model){
        return $model->validate();
    }
}