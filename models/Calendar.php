<?php 
namespace app\models;
use yii\base\Model;

class Calendar extends Model
{
    public $dateAct; 
    public $activities; 
    public function rules(){
        return [
            ['dateAct', 'required'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'dateAct' => 'Выберите дату',
        ];
    }
}
?>