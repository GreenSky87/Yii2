<?php
namespace app\components;

use yii\base\Component;
use app\models\Day;

class DayComponent extends Component
{
    /** @var string class of activity entity */
    public $day_class;

    public function init(){
        parent::init();

        if(empty($this->day_class)){
            throw_new \Exception('Need attribute day_class');
        }
    }

    

    /**
     * @return Day
     */
    public function getModel($params=null){
        /** @var Day $model  */ 
        $model=new $this->day_class;
         if ($params && is_array($params)){
             $model->load($params);
         }

         return $model;
    }

    /** @param $model
     *  @return bool 
     */
    public function createDay($model){
        return $model->validate();
    }
}