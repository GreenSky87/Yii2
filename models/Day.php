<?php

namespace app\models;
use yii\base\Model;

class Day extends Model
{
    public $date;
    public $weekend;

    function rules()
    {
        return [
            ['date', 'string'],
            ['date','required'],
            ['weekend', 'boolean']
        ];
    }
    function attributeLabels()
    {
        return [
            'date'=>'Дата',
            'weekend'=>'Выходной день'
        ];
    }

}